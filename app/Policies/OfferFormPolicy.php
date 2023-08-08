<?php

namespace App\Policies;

use App\Models\OfferForms\OfferForm;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfferFormPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OfferForms\OfferForm  $offerForm
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, OfferForm $offerForm)
    {
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasRole(['super-admin', 'admin', 'agent']);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OfferForms\OfferForm  $offerForm
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, OfferForm $offerForm)
    {
        if ($user->hasRole(['super-admin', 'admin'])) {
            return true;
        } elseif ($user->hasRole(['agent']) && $offerForm->user_id === $user->id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OfferForms\OfferForm  $offerForm
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, OfferForm $offerForm)
    {
        if ($user->hasRole(['super-admin', 'admin'])) {
            return true;
        } elseif ($user->hasRole(['agent']) && $offerForm->user_id === $user->id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OfferForms\OfferForm  $offerForm
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, OfferForm $offerForm)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OfferForms\OfferForm  $offerForm
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, OfferForm $offerForm)
    {
        //
    }
}
