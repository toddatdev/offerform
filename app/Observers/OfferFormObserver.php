<?php

namespace App\Observers;

use App\Models\OfferForms\OfferForm;
use App\Models\OfferForms\OfferFormOffer;

class OfferFormObserver
{
    /**
     * Handle the OfferForm "creating" event.
     *
     * @param  \App\Models\OfferForms\$offerForm  $offerForm
     * @return void
     */
    public function creating(OfferForm $offerForm)
    {
        $user = auth()->user();

        if ($user && $user->hasRole(['super-admin', 'admin'])) {
            $offerForm->standard = true;
            $offerForm->active = 0;
            if (is_null($offerForm->locked)) {
                $offerForm->locked = 1;
            }
        } elseif($user && $user->hasRole(['agent'])) {
            $offerForm->active = 1;
            if (is_null($offerForm->locked)) {
                $offerForm->locked = 0;
            }
        }

        $offerForm->user_id = $offerForm->created_by_id = $offerForm->last_updated_by_id = $user ? $user->id : 1;

        if (is_null($offerForm->display_order)) {
            $offerForm->display_order = next_display_order(
                OfferForm::when($user && $user->hasRole(['super-admin', 'admin', 'agent']), function ($query) use ($offerForm) {
                    $query->where('user_id', auth()->user()->id);
                    if (!is_null($offerForm->parent_id)) {
                        $query->where('parent_id', $offerForm->parent_id);
                    }
                })
//                    ->when($user && $user->hasRole(['super-admin', 'admin']), function ($query) use ($offerForm)  {
//                    $query->whereNull('user_id');
//                    if (!is_null($offerForm->parent_id)) {
//                        $query->where('parent_id', $offerForm->parent_id);
//                    }
//                })
            );
        }

        $offerForm->slug = $offerForm->slug ?? \Str::slug($offerForm->name) . '-' . uniqid();
    }

    /**
     * Handle the OfferForm "created" event.
     *
     * @param  \App\Models\OfferForms\OfferForm  $offerForm
     * @return void
     */
    public function created(OfferForm $offerForm)
    {
        if ($offerForm->offerForm && $offerForm->offerForm->is_standard_step_library_form) {
            $offerForm->source = 'library';
            $offerForm->library = true;
            $offerForm->save();
        }
        $offerForm->fresh();

        $offerForm->oferFormOffers()->save(new OfferFormOffer([
            'slug' => 'screenshot-' . $offerForm->id,
        ]));

        $offerForm->oferFormOffers()->save(new OfferFormOffer([
            'slug' => 'view-form-' . $offerForm->id,
        ]));

        if($offerForm->offerForm) {
            $offerForm->active = $offerForm->offerForm->active;
            $offerForm->save();
        }
    }

    /**
     * Handle the OfferForm "updated" event.
     *
     * @param  \App\Models\OfferForms\OfferForm  $offerForm
     * @return void
     */
    public function updated(OfferForm $offerForm)
    {
    }

    /**
     * Handle the OfferForm "updated" event.
     *
     * @param  \App\Models\OfferForms\OfferForm  $offerForm
     * @return void
     */
    public function updating(OfferForm $offerForm)
    {
        if(!$offerForm->isDirty('last_opened_at') && !$offerForm->isDirty('display_order')) {
            $offerForm->last_updated_by_id = auth()->user() ? auth()->user()->id : null;
        }
    }

    /**
     * Handle the OfferForm "updated" event.
     *
     * @param  \App\Models\OfferForms\OfferForm  $offerForm
     * @return void
     */
    public function saving(OfferForm $offerForm)
    {
        if(!$offerForm->isDirty('last_opened_at') && !$offerForm->isDirty('display_order')) {
            $offerForm->last_updated_by_id = auth()->user() ? auth()->user()->id : null;
        }
    }

    /**
     * Handle the OfferForm "deleted" event.
     *
     * @param  \App\Models\OfferForms\OfferForm  $offerForm
     * @return void
     */
    public function deleted(OfferForm $offerForm)
    {
        //
    }

    /**
     * Handle the OfferForm "restored" event.
     *
     * @param  \App\Models\OfferForms\OfferForm  $offerForm
     * @return void
     */
    public function restored(OfferForm $offerForm)
    {
        //
    }

    /**
     * Handle the OfferForm "force deleted" event.
     *
     * @param  \App\Models\OfferForms\OfferForm  $offerForm
     * @return void
     */
    public function forceDeleted(OfferForm $offerForm)
    {
        //
    }
}
