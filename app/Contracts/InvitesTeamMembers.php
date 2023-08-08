<?php

namespace App\Contracts;

interface InvitesTeamMembers
{
    /**
     * Invite a new team member to the given team.
     *
     * @param  mixed  $user
     * @param  mixed  $team
     * @param  string  $name
     * @param  string  $email
     * @return void
     */
    public function invite($user, $team, string $name, string $email, string $role = null);
}
