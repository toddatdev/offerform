<?php

namespace App\Console\Commands;

use App\Models\Team;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateTeam extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:team';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask('What is your team name?');
        $userId = $this->ask('What is user id for you want to create team?');

        $user = User::find($userId);

        $team = Team::create([
            'name' => $name,
            'user_id' => $userId,
            'code' => Str::slug($name),
            'no_of_agents' => 30,
            'contact_name' => $user->full_name,
            'contact_email' => $user->email,
            'contact_phone' => $user->phone ?? '313231321321',
            'personal_team' => false,
        ]);

        $user->current_team_id = $team->id;
        $user->save();

        return 0;
    }
}
