<?php

namespace App\Models\OfferForms;

use App\Models\ReferralPartners\ReferralPartner;
use App\Models\ReferralPartners\ReferralPartnerType;
use App\Models\Team;
use App\Models\Traits\Scopes\ActiveOrInactive;
use App\Models\Traits\Scopes\DisplayOrder;
use App\Models\Traits\Sluggable;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class OfferForm extends Model
{
    use HasFactory;
    use DisplayOrder;
    use ActiveOrInactive;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image',
        'user_id',
        'created_by_id',
        'last_updated_by_id',
        'user_id',
        'parent_id',
        'team_id',
        'library_step_id',
        'name',
        'slug',
        'description',
        'display_order',
        'active',
        'locked',
        'source',
        'library',
        'standard',
        'universally_shared',
        'universally_shared_at',
        'referral_partner_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'universally_shared_at' => 'date',
        'library' => 'boolean',
        'standard' => 'boolean',
        'locked' => 'boolean',
        'active' => 'boolean',
        'universally_shared' => 'boolean',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get & Set Step Card Header Image.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function stepCardHeaderImage(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->image === null ? asset('img/offer-form-step/card-header-bg.jpeg') : asset("storage/$this->image"),
        );
    }

    /**
     * Check if offerform is standard step library.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function isStandardStepLibraryForm(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->slug === 'standard-step-library',
        );
    }

    /**
     * Check if user need to upgrade.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function needToUpgrade(): Attribute
    {
        $needTo = 0;

        if (auth()->check()) {
            $user = auth()->user();
            if ($user->hasRole(['agent'])) {
                if ($this->library && $this->user_id === $user->id && $this->locked) {
                    if (!($user->subscribed('premium-personal-monthly') ||
                        $user->subscribed('premium-personal-yearly') ||
                        $user->subscribed('premium-team-monthly')
                    )) {
                        $needTo = 1;
                    }

                } elseif ($this->source === 'custom' && $this->user_id === $user->id) {
                    // Custom can't lock
                }
            }
        }

        return Attribute::make(
            get: fn() => $needTo,
        );
    }

    /**
     * Get & Set Step Card Header Image.
     *
     * @return string
     */
    public function getPreviewLink($step = null, $backTo = null)
    {
        if (!$step) {
            $step = $this->getOfferFormStepsQuery()->first();
        }
        return $step ? route('dash.offer-forms.step.preview', [$this->slug, $step->slug, 'backTo' => $backTo ?? \url()->current()]) : '#';

    }

    /**
     * Get link for view form.
     *
     * @return string
     */
    public function getViewFormLink($shared = false, $backTo = null)
    {
        $step = $this->getOfferFormStepsQuery($shared)->first();
        return $step ? route('guest.offer-form', [$this->slug, $step->slug, "view-form-$this->id", 'backTo' => $backTo ?? \url()->current()]) : '#';

    }

    /**
     * Get & Set Step Card Header Image.
     *
     * @return string
     */
    public function getLink($offer = null, $parameters = [])
    {
        if (!$offer) {
            $offer = $this->getNewOffer();
        }

        return $this->steps->count() > 0 ? route('guest.offer-form', [$this->slug, $this->steps()->displayOrder()->first()->slug, $offer->slug] + $parameters) : '#';
    }

    public function getLinkToTakeScreenshot(): ?string
    {
        $offer = OfferFormOffer::where('slug', "screenshot-{$this->id}")->where('offer_form_id', $this->id)->first();
        if (!$offer) return null;
        return route('guest.offer-form', [$this->offerForm->slug, $this->slug, $offer->slug, 'hide' => 'footer']);
    }

    /**
     * Get & Set Step Card Header Image.
     *
     * @return string
     */
    public function getNewOffer($buyer = [])
    {
        $team_id = optional(auth()->user()->teams()->first())->id;
        $offer = new OfferFormOffer(array_merge([
            'slug' => Str::slug(auth()->user()->full_name) . '-' . uniqid(),
            'offer_form_id' => $this->id,
            'team_id' => $team_id, // $this->>team_id
            'user_id' => auth()->user()->id,
            'address_components' => auth()->user()->address_components,
        ], $buyer));

        $offer->save();

        return $offer;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lastUpdatedBy()
    {
        return $this->belongsTo(User::class, 'last_updated_by_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function offerForm()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function steps()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function sections()
    {
        return $this->hasMany(OfferFormSection::class);
    }

    public function submittedSections()
    {
        return $this->hasMany(OfferFormSubmittedSection::class);
    }

    public function oferFormOffers()
    {
        return $this->hasMany(OfferFormOffer::class);
    }

    public function offers()
    {
        return $this->hasMany(OfferFormOffer::class)->where('status', 1);
    }

    public function getOfferFormStepsQuery($shared = false, $offer = null)
    {
        $query = OfferForm::whereNotNull('parent_id');

        if ($offer && !is_null($offer->address_components) && $this->referralPartnerTypes->count() > 0) {
            // User address components
            $addressComponents = $offer->address_components ?? [];

            // Address component state
            $stateId = \App\Models\World\State::where(function ($query) use ($addressComponents) {
                $query->where('name', $addressComponents['state'] ?? '')
                    ->orWhere('iso2', $addressComponents['state'] ?? '');
            })->where('type', 'state')->first()?->id;

            // Address component city
            $cityId = \App\Models\World\City::where('name', $addressComponents['city'] ?? '')->first()?->id;

            // Address component zipcode
            $zipcode = $addressComponents['zipcode'] ?? '';

            $referralPartnerIds = \App\Models\ReferralPartners\ReferralPartner::whereHas('referralPartnerType', function ($query) {
                $query->whereIn('id', $this->referralPartnerTypes->pluck('id')->toArray());
            })->where(function ($query) use ($stateId, $cityId, $zipcode) {
                $query
                    // Where states only
                    ->where(function ($query) use ($stateId) {
                        $query->whereRaw("`service_areas`->>'$.only' = 'states'")
                            ->whereRaw("JSON_SEARCH(service_areas->>'$.states', 'one', '$stateId') is not null");
                    })

                    // Where cities only
                    ->orWhere(function ($query) use ($cityId) {
                        $query->whereRaw("`service_areas`->>'$.only' = 'cities'")
                            ->whereRaw("JSON_SEARCH(service_areas->>'$.cities', 'one', '$cityId') is not null");
                    })

                    // Where zipcodes only
                    ->orWhere(function ($query) use ($zipcode) {
                        $query->whereRaw("`service_areas`->>'$.only' = 'zipcodes'")
                            ->whereRaw("JSON_SEARCH(service_areas->>'$.zipcodes', 'one', '$zipcode') is not null");
                    })

                    // Service Areas from all
                    ->orWhere(function ($query) use ($stateId, $cityId, $zipcode) {
                        $query
                            ->whereRaw("`service_areas`->>'$.only' is null OR `service_areas`->>'$.only' = 'all'")
                            ->where(function ($query) use ($stateId, $cityId, $zipcode) {
                                $query->whereRaw("JSON_SEARCH(service_areas->>'$.states', 'one', '$stateId') is not null")
                                    ->orWhereRaw("JSON_SEARCH(service_areas->>'$.cities', 'one', '$cityId') is not null")
                                    ->orWhereRaw("JSON_SEARCH(service_areas->>'$.zipcodes', 'one', '$zipcode') is not null");
                            });
                    });
            })
                ->distinct('referral_partner_type_id')->pluck('id')->toArray();


            $query->where(function ($query) use ($referralPartnerIds) {
                $query->where('parent_id', $this->id)
                    ->orWhere(function ($query) use ($referralPartnerIds) {
                        $query->where('parent_id', 1)->whereIn('referral_partner_id', $referralPartnerIds);
                    });

            })->orderByRaw("getDisplayOrder($this->id, display_order, referral_partner_id)");
        } else {
            $query = $query->where('parent_id', $this->id)->displayOrder();
        }

        if (request()->routeIs('guest.offer-form')) {
            if ($this->slug !== 'standard-step-library' && !$this->standard) $query = $query->active();
        } else {
            $user = auth()->user();
            if ($user) {
                if ($user->hasRole('agent')) {
                    $query = $query->where(function ($query) use ($shared) {
                        $query->where(function ($query) use ($shared) {
                            $query
                                ->where('user_id', $shared ? '<>' : '=', auth()->user()->id);
                        })
                            ->orWhere('standard', 1);
                    })->active();
                } else {
                    $query = $query->when($this->slug === 'standard-step-library', function ($query) {
                        $query->whereNull('referral_partner_id');
                    });
                }
            }

        }

        return $query;
    }

    public function getFormTotalStepsCount()
    {
        return $this->getOfferFormStepsQuery()->count();
    }

    public function getOfferFormAgent()
    {
        if (auth()->check()) {
            return auth()->user();
        } else {
            return $this->user ?? $this->createdBy;
        }
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_offer_form');
    }

    public function referralPartner()
    {
        return $this->belongsTo(ReferralPartner::class);
    }

    public function referralPartnerTypes()
    {
        return $this->belongsToMany(ReferralPartnerType::class, 'offer_form_referral_partner_type')->withPivot('display_order');
    }
}
