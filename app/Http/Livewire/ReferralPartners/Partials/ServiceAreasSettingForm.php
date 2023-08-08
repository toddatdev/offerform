<?php

namespace App\Http\Livewire\ReferralPartners\Partials;

use App\Models\ReferralPartners\ReferralPartner;
use App\Models\World\City;
use App\Models\World\Country;
use App\Models\World\State;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ServiceAreasSettingForm extends Component
{
    public ReferralPartner $referralPartner;

    public $state = [
        'only'     => 'all',
        'states'   => [],
        'cities'   => [],
        'zipcodes' => [],
    ];

    protected $listeners = [
        'service-areas-refresh' => '$refresh',
    ];

    public function mount()
    {
        $this->state = $this->referralPartner->service_areas ?? [];

        if (!array_key_exists('only', $this->state)) {
            $this->state['only'] = 'all';
        }
    }

    public function hydrate()
    {
        $this->emit('loadselectpicker');
    }

    public function render()
    {
        $us = app(Country::class)->first();

        $states = State::where('country_id', $us->id)->where('type', 'state')->get();

        $cities = City::whereIn('state_id', $this->state['states'] ?? [])->where('country_id', $us->id)->get();

        $zipcodes = \DB::table('zipcodes')->whereIn('zipcode', $this->state['zipcodes'] ?? [])->limit(500)->get();
        return view('livewire.referral-partners.partials.service-areas-setting-form',
            compact('us', 'states', 'cities', 'zipcodes'));
    }

    public function saveServiceAreas()
    {
        Validator::make($this->state, [
            'only'     => [
                'nullable',
                'in:states,cities,zipcodes,all',
            ],
            'states.*' => ['required', 'exists:states,id'],
            'cities.*' => ['required', 'exists:cities,id'],
        ])->validateWithBag('saveServiceAreas');

        $this->referralPartner->fill([
            'service_areas' => $this->state,
        ])->save();

        $this->emit('showToast', 'Success!', 'Service areas setting saved successfully.');
    }
}
