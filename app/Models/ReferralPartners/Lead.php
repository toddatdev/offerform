<?php

namespace App\Models\ReferralPartners;

use App\Models\OfferForms\OfferFormOffer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'referral_partner_id',
        'offer_form_offer_id',
        'first_name',
        'last_name',
        'email',
        'phone',
    ];

    public function referralPartner(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ReferralPartner::class);
    }

    public function offer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(OfferFormOffer::class);
    }
}
