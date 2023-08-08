<?php

namespace App\Http\Livewire\Profile\Agent;

use App\Models\User;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;
use Livewire\WithFileUploads;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class ProfileForm extends Component
{
    use WithFileUploads;

    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];

    /**
     * The user.
     *
     * @var array
     */
    public ?User $user;

    /**
     * The new avatar for the user.
     *
     * @var mixed
     */
    public $photo;

    /**
     * The new bio video for agent.
     *
     * @var mixed
     */
    public $video;

    protected $listeners = [
        'profile-refresh' => '$refresh',
    ];

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount($user)
    {
        $this->user = $user;

        $this->state = $user->withoutRelations()->toArray();

        if (youtube_video_id_from_url($this->state['video']) !== null) {
            $this->state['video_url'] = $this->state['video'];
        }
    }

    /**
     * Update the user's profile information.
     *
     * @param \Laravel\Fortify\Contracts\UpdatesUserProfileInformation $updater
     *
     * @return void
     */
    public function updateProfileInformation(UpdatesUserProfileInformation $updater)
    {
        $this->resetErrorBag();

        $input = $this->state;

        if ($this->video) {
            $input = array_merge($input, ['video' => $this->video]);
        } else {
            $input = array_merge($input, ['video' => null]);
        }

        if ($this->photo) {
            $input = array_merge($input, ['photo' => $this->photo]);
        }
        $updater->update(
            $this->user,
            $input
        );

        $reloadPageOnVideoSave = false;

        if ($this->video) {

            $this->user->upload($this->video, 'video');

            $pathInfoExt = pathinfo($this->user->video, PATHINFO_EXTENSION);

            if ($pathInfoExt !== 'mp4') {

                FFMpeg::open("public/{$this->user->video}")
                    ->export()
                    ->inFormat((new X264('aac', 'libx264'))->setKiloBitrate(500))
                    ->save("public/" . str_replace($pathInfoExt, 'mp4', $this->user->video));

                if (Storage::disk('public')->exists($this->user->video)) {
                    Storage::disk('public')->delete($this->user->video);
                }

                $this->user->video = str_replace($pathInfoExt, 'mp4', $this->user->video);
                $this->user->save();
            }

            // Generate video thumbnail
            FFMpeg::fromDisk('public')
                ->open($this->user->video)
                ->getFrameFromSeconds(1)
                ->export()
                ->save(str_replace('.mp4', '.png', $this->user->video));

            $this->state['video_url'] = '';

            $reloadPageOnVideoSave = true;
        }

        if (!isset($this->state['video_url']) || (isset($this->state['video_url']) && $this->state['video_url'] !== '')) $reloadPageOnVideoSave = true;

        $team = $this->user->ownedTeams()->first();

        if ($team) {
            $team->name = $this->user->other_inputs['team_name'] ?? $this->user->full_name;
            $team->code = strtoupper(str_replace(' ', '',
                    $this->user->other_inputs['team_name'] ?? $this->user->full_name) . substr(preg_replace("/\s+/", "",
                    $this->user->phone ?? rand(10000, 20000)), -4));
            $team->save();

            $this->emit('team-manager', route('dash.teams.manager', $team->code));
        }


        $this->user->save();
        $this->video = null;

        if ($reloadPageOnVideoSave) {
            $this->redirect(route('dash.settings'));
        }
        $this->emit('saved');

    }


    /**
     * Update the user's email.
     *
     * @param \Laravel\Fortify\Contracts\UpdatesUserProfileInformation $updater
     *
     * @return void
     */
    public function updateEmail(UpdatesUserProfileInformation $updater)
    {
        $this->resetErrorBag();

        $updater->updateEmail($this->user, $this->state);

        $this->emit('email-updated');
    }

    /**
     * Update the agent's transaction coordinator email.
     *
     * @param UpdatesUserProfileInformation $updater
     *
     * @return void
     */
    public function updateTransactionCoordinatorEmail(UpdatesUserProfileInformation $updater)
    {
        $this->resetErrorBag();

        $updater->updateTransactionCoordinatorEmail(
            $this->user, $this->state
        );

        $this->emit('transaction-coordinator-email-updated');
    }

    /**
     * On upload bio video validate.
     *
     * @return mixed
     */
    public function onUploadVideo()
    {
        $this->resetErrorBag();

        Validator::make(['video' => $this->video], [
            'video' => ['required', 'file', 'mimes:mp4,avi,mov,mkv,mpg,mpeg,webm', 'max:512000'],
        ])->validateWithBag('updateProfileInformation');

    }

    /**
     * Render the component.
     *
     * @return mixed
     */
    public function render()
    {
        return view('profile.agent.profile-form');
    }
}
