<?php

namespace App\Actions\Fortify;

use App\Rules\YoutubeUrlIsValid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input, array $validations = [])
    {
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:5000'],
            'video' => ['nullable', 'mimes:mp4,avi,mov,mkv,mpg,mpeg,webm', 'max:512000'],
            'video_url' => ['nullable', 'url', new YoutubeUrlIsValid],
            'address' => ['nullable', 'string', 'max:255'],
        ] + $validations)->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if (isset($input['video'])) {
            $user->upload($input['video'], 'video');
        }

        $user->forceFill([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'phone' => $input['phone'],
            'address' => $input['address'],
            'other_inputs' => array_filter($input['other_inputs'] ?? []),
            'video' => $input['video_url'] ?? $user->video,
            'address_components' => $input['address_components'] ?? [],
        ])->save();

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        }
    }

    /**
     * Validate and update the given user's email.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function updateEmail($user, array $input, array $validations = [])
    {
        Validator::make($input, [
                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)]
            ] + $validations)->validateWithBag('updateProfileInformation');

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        }
    }

    /**
     * Validate and update the given agent's transaction coordinator email.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function updateTransactionCoordinatorEmail($user, array $input, array $validations = [])
    {
        Validator::make($input, [
                'other_inputs.transaction_coordinator_email' => ['required', 'email'],

            ],
            [
                'other_inputs.transaction_coordinator_email.required' => 'Transaction coordinator email is required.'
            ]

            + $validations)->validateWithBag('updateProfileInformation');

        $otherInputs = $input['other_inputs'] ?? [];
        $userOtherInputs = $user->other_inputs;

        $otherInputs = array_merge($userOtherInputs, $otherInputs);

        $user->forceFill([
            'other_inputs' => array_filter($otherInputs),
        ])->save();
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
