<?php

namespace App\Actions\Fortify;

class UpdateUserSocialMediaLinks
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        $user->forceFill([
            'links' => array_filter($input),
        ])->save();
    }
}
