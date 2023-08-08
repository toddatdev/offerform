<?php

namespace App\Http\Livewire\Traits;

use App\Models\OfferForms\OfferForm;

trait CopyOFLink
{

    public function getListeners()
    {
        return $this->listeners + [
            'copy-offerform-link' => 'copyLink',
        ];
    }

    public function copyLink($slug) {
        $offerForm = OfferForm::where('slug', $slug)->first();

        if ($offerForm) {
            $link = $offerForm->getlink();
            $this->emit('copy-to-clipboard', $link);
            $this->emit('showToast', 'Clipboard!', "OfferForm link copied successfully to clipboard!");
        }
    }
}
