<?php

namespace App\Actions\Fortify;

class UpdateUserNotificationPreferences
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
            'notification_preferences' => $input,
        ])->save();
    }
}
