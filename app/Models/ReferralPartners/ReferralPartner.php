<?php

namespace App\Models\ReferralPartners;

use App\Models\OfferForms\OfferForm;
use App\Models\OfferForms\OfferFormOffer;
use App\Models\Traits\Uploadable;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Laravel\Cashier\Billable;

class ReferralPartner extends Model
{
    use HasFactory;
    use Uploadable;
    use Billable;
    const SUBSCRIPTION_STRIPE_PLAN = 'price_1LAVtEK1X78ynNwegcNOrIO2';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'referral_partner_type_id',
        'image',
        'company_name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'date_of_first_service',
        'address',
        'notes',
        'service_areas',
        'billing_preferences',
        'payment_methods',
        'integrations',
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
        'service_areas' => 'array',
        'billing_preferences' => 'array',
        'payment_methods' => 'array',
        'integrations' => 'array',
    ];

    public function getImageUrlAttribute(): string
    {
        return $this->image ? Storage::disk('public')->url($this->image) : asset('img/dash/dummy-img.jpg');
    }

    public function getStepEditUrlAttribute(): string
    {
        $form = $this->offerForm;
        return $form && $form->offerForm ? route('dash.offer-forms.step.edit', [$form->offerForm->slug, $form->slug]) : '#';
    }

    public function getStepPreviewUrlAttribute(): string
    {
        $form = $this->offerForm;
        return $form && $form->offerForm ? route('dash.offer-forms.step.preview', [$form->offerForm->slug, $form->slug]) : '#';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function referralPartnerType()
    {
        return $this->belongsTo(ReferralPartnerType::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function offerForm()
    {
        return $this->hasOne(OfferForm::class)->where('parent_id', 1);
    }

    public function offers()
    {
        return $this->hasMany(OfferFormOffer::class);
    }

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}
