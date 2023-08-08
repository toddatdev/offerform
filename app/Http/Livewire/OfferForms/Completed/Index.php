<?php

namespace App\Http\Livewire\OfferForms\Completed;

use App\Models\OfferForms\OfferForm;
use App\Models\OfferForms\OfferFormOffer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class Index extends Component
{
    public $search = '';

    public $archived = 0;

    public $displayAs = 'grid';

    public $sortBy = 'date_submitted';

    public $teamOffers = 'no';

    public $limitPerPage = 6;

    protected $listeners = [
        'load-more' => 'loadMore'
    ];

    public function mount()
    {
        $this->displayAs = Cookie::get('offer_forms_completed_display_as', 'grid');
        $this->sortBy = Cookie::get('offer_forms_completed_sort_by', 'date_submitted');
        $this->teamOffers = Cookie::get('offer_forms_completed_team_offers', 'no');
    }

    public function loadMore()
    {
        $this->limitPerPage = $this->limitPerPage + 6;
    }

    public function render()
    {
        $userIds = [];

//        if (($team = $this->user->teams()->first()) && $this->teamOffers === 'yes') {
//            $userIds += $team->users->pluck('id')->toArray();
//        }

//        if (($team = $this->user->ownedTeams()->first()) && $this->teamOffers === 'yes') {
//            $userIds += $team->users->pluck('id')->toArray();
//        }
//
//        if ($this->teamOffers === 'no') {
//            $userIds = [$this->user->id];
//        }

//        \Log::info('UserIds: ', [$userIds]);

        $offers = OfferFormOffer::
//            ->with('offerForm')
            when($this->teamOffers === 'no', function ($query) {
                $query->where('user_id', $this->user->id);
            })
            ->when($this->teamOffers === 'yes', function ($query) {
                $query->whereIn('team_id', $this->user->ownedTeams->pluck('id')->toArray());
            })
            ->when($this->sortBy === 'date_submitted', function ($query) {
                $query->orderBy('created_at', 'DESC');
            })
            ->when($this->sortBy === 'new', function ($query) {
                $query->whereDate('created_at', Carbon::today());
            })
            ->when($this->sortBy === 'last_opened', function ($query) {
                $query->orderBy('last_opened_at', 'DESC');
            })
            ->when($this->sortBy === 'a_z', function ($query) {
                $query->orderByRaw(\DB::raw("`variables`->>'$." . OfferFormOffer::VAR_PROPERTY_ADDRESS . "'"))
                    ->orderByRaw(\DB::raw("`variables`->>'$." . OfferFormOffer::VAR_FORM_ADDRESS . "'"));
            })
            ->where('archived', $this->archived)
            ->when($this->sortBy === 'accepted_offers', function ($query) {
                $query->where('accepted', 1);
            })
            ->when($this->search !== '', function ($query) {
                $query->where(function($query) {
                    $query->whereRaw(\DB::raw("LOWER(`variables`->>'$." . OfferFormOffer::VAR_PROPERTY_ADDRESS . "') LIKE '%" . strtolower($this->search) . "%'"))
                        ->orWhereRaw(\DB::raw("LOWER(`variables`->>'$." . OfferFormOffer::VAR_FORM_ADDRESS . "') LIKE '%" . strtolower($this->search) . "%'"))
                        ->orWhereRaw(\DB::raw("LOWER(`variables`->>'$." . OfferFormOffer::VAR_BUYER_FIRST_NAME . "') LIKE '%" . strtolower($this->search) . "%'"))
                        ->orWhereRaw(\DB::raw("LOWER(`variables`->>'$." . OfferFormOffer::VAR_BUYER_FIRST_NAME . "') LIKE '%" . strtolower($this->search) . "%'"))
                        ->orWhereRaw(\DB::raw("LOWER(`variables`->>'$." . OfferFormOffer::VAR_FORM_FIRST_NAME . "') LIKE '%" . strtolower($this->search) . "%'"))
                        ->orWhereRaw(\DB::raw("LOWER(`variables`->>'$." . OfferFormOffer::VAR_FORM_LAST_NAME . "') LIKE '%" . strtolower($this->search) . "%'"));
                });
            })
            ->whereHas('submittedSections')
            ->where('status', 1)
            ->paginate($this->limitPerPage);

        return view('livewire.offer-forms.completed.index', compact('offers'));
    }

    public function changeDisplayAs($as)
    {
        $this->displayAs = $as;
        Cookie::queue('offer_forms_completed_display_as', $as);
    }

    public function changeSortBy($sortBy)
    {
        $this->sortBy = $sortBy;
        Cookie::queue('offer_forms_completed_sort_by', $sortBy);
    }

    public function viewTeamOffers()
    {
        if ($this->teamOffers === 'no') {
            $this->teamOffers = 'yes';
        } else {
            $this->teamOffers = 'no';
        }

        Cookie::queue('offer_forms_completed_team_offers', $this->teamOffers);
    }

    public function onChangeOffer($id, $type, $val)
    {
        $offer = OfferFormOffer::find($id);

        if ($offer) {
            $offer->{$type} = $val;
            $offer->save();
        }
    }

    public function getUserProperty()
    {
        return auth()->user();
    }
}
