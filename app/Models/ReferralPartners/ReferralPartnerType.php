<?php

namespace App\Models\ReferralPartners;

use App\Models\OfferForms\OfferForm;
use App\Models\Traits\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralPartnerType extends Model
{
    use HasFactory;
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'locked'
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
        'locked' => 'boolean'
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
                if ($this->locked) {
                    if (!($user->subscribed('premium-personal-monthly') ||
                        $user->subscribed('premium-personal-yearly') ||
                        $user->subscribed('premium-team-monthly')
                    )) {
                        $needTo = 1;
                    }

                }
            }
        }

        return Attribute::make(
            get: fn() => $needTo,
        );
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function referralPartners()
    {
        return $this->hasMany(ReferralPartner::class);
    }

    public function offerForms() {
        return $this->belongsToMany(OfferForm::class, 'offer_form_referral_partner_type')->withPivot('display_order');
    }
}
