<?php

namespace App\Models\OfferForms;

use App\Models\ReferralPartners\Lead;
use App\Models\Traits\Scopes\ActiveOrInactive;
use App\Models\Traits\Scopes\DisplayOrder;
use App\Models\Traits\Sluggable;
use App\Models\Traits\Uploadable;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Knp\Snappy\Pdf;

class OfferFormOffer extends Model
{
    use HasFactory;
    use Notifiable;
    use Uploadable;

    /**
     * Buyer or Additional buyer variables
     */
    const VAR_PROPERTY_ADDRESS = 'property_address';
    const VAR_BUYER_FIRST_NAME = 'buyer_first_name';
    const VAR_BUYER_LAST_NAME = 'buyer_last_name';
    const VAR_ADDITIONAL_BUYER_FIRST_NAME = 'additional_buyer_first_name';
    const VAR_ADDITIONAL_BUYER_LAST_NAME = 'additional_buyer_last_name';

    /**
     * Form Editor variables
     */
    const VAR_FORM_FIRST_NAME = 'form_first_name';
    const VAR_FORM_LAST_NAME = 'form_last_name';
    const VAR_FORM_ADDRESS = 'form_address';

    /**
     * Form Editor Calculator variables
     */
    const VAR_FORM_CALCULATOR_OFFER_AMOUNT = 'form_calculator_offer_amount';
    const VAR_FORM_CALCULATOR_DOWN_PAYMENT = 'form_calculator_down_payment';

    /**
     * Agent variables
     */
    const VAR_AGENT_FIRST_NAME = 'agent_first_name';
    const VAR_AGENT_LAST_NAME = 'agent_last_name';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'offer_form_id',
        'team_id',
        'slug',
        'email',
        'phone',
        'status',
        'last_opened_at',
        'archived',
        'accepted',
        'referral_partner_id',
        'address_components',
        'video',
        'note',
        'signature',
        'signed_at',
        'signed_at_2',
        'selected_logics'
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
        'variables' => 'array',
        'selected_logics' => 'array',
        'address_components' => 'array',
        'status' => 'boolean',
        'archived' => 'boolean',
        'accepted' => 'boolean',
        'last_opened_at' => 'datetime',
        'signed_at' => 'datetime',
        'signed_at_2' => 'datetime',
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

    public function getVariable($key)
    {
        return $this->variables ? ($this->variables[$key] ?? '') : '';
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
    public function offerForm()
    {
        return $this->belongsTo(OfferForm::class, 'offer_form_id');
    }

    public function submittedSections()
    {
        return $this->hasMany(OfferFormSubmittedSection::class);
    }

    public function getDefaultValueForInput($name, $config = [])
    {
        $default = '';
        if (isset($config['is_variable']) && !!$config['is_variable']) {
            switch ($name) {
                case 'first_name':
                    $buyer1stOr2nd = $config['buyer_1st_or_2nd'] ?? '1st';

                    $default = $this->getVariable($buyer1stOr2nd === '1st' ? self::VAR_BUYER_FIRST_NAME : self::VAR_ADDITIONAL_BUYER_FIRST_NAME);
                    break;
                case 'last_name':
                    $buyer1stOr2nd = $config['buyer_1st_or_2nd'] ?? '1st';
                    $default = $this->getVariable($buyer1stOr2nd === '1st' ? self::VAR_BUYER_LAST_NAME : self::VAR_ADDITIONAL_BUYER_LAST_NAME);
                    break;
                case 'address':
                    $default = $this->getVariable(self::VAR_PROPERTY_ADDRESS);
                    break;
                case 'email':
                    $default = $this->email ?? '';
                    break;
                case 'phone_number':
                    $default = $this->phone ?? '';
                    break;
            }
        }
        return $default;
    }

    public function toPdf()
    {
        $pdf = App::make('snappy.pdf.wrapper');
        $pdf->loadHTML(view('dash.offer-forms.export-completed-form-to-pdf', ['offerFormOffer' => $this])->render())
            ->setPaper('a4')
            ->setOptions([
                'dpi' => 96,
                'orientation' => 'portrait',
                'margin-left' => 10
            ]);
        return $pdf;
    }

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function textSignature() {
        if (!str_starts_with($this->signature, 'signatures/')) {
            return $this->signature;
        }

        return null;
    }

    public function pngSignature() {
        if (str_starts_with($this->signature, 'signatures/')) {
            return Storage::disk('public')->url($this->signature);
        }

        return null;
    }

    public function textSignature2() {
        if (!str_starts_with($this->signature_2, 'signatures/')) {
            return $this->signature_2;
        }

        return null;
    }

    public function pngSignature2() {
        if (str_starts_with($this->signature_2, 'signatures/')) {
            return Storage::disk('public')->url($this->signature_2);
        }

        return null;
    }

    public function variablesReplaceToValues() {

            $variables = $this->variables ?? [];

            return [
                $variables[self::VAR_AGENT_FIRST_NAME] ?? '',
                $variables[self::VAR_AGENT_LAST_NAME] ?? '',

                isset($variables[self::VAR_AGENT_FIRST_NAME]) && isset($variables[self::VAR_AGENT_LAST_NAME])
                    ? "{$variables[self::VAR_AGENT_FIRST_NAME]} {$variables[self::VAR_AGENT_LAST_NAME]}"
                    : '',

                $variables[self::VAR_FORM_FIRST_NAME] ?? $variables[self::VAR_BUYER_FIRST_NAME] ?? '',
                $variables[self::VAR_FORM_LAST_NAME] ?? $variables[self::VAR_BUYER_LAST_NAME] ?? '',

                isset($variables[self::VAR_FORM_FIRST_NAME]) && isset($variables[self::VAR_FORM_LAST_NAME])
                    ? "{$variables[self::VAR_FORM_FIRST_NAME]} {$variables[self::VAR_FORM_LAST_NAME]}"

                    : (
                isset($variables[self::VAR_BUYER_FIRST_NAME]) && isset($variables[self::VAR_BUYER_LAST_NAME])
                    ? "{$variables[self::VAR_BUYER_FIRST_NAME]} {$variables[self::VAR_BUYER_LAST_NAME]}"
                    : ''
                ),

                $variables[self::VAR_ADDITIONAL_BUYER_FIRST_NAME] ?? $variables[self::VAR_ADDITIONAL_BUYER_FIRST_NAME] ?? '',
                $variables[self::VAR_ADDITIONAL_BUYER_LAST_NAME] ?? $variables[self::VAR_ADDITIONAL_BUYER_LAST_NAME] ?? '',
                isset($variables[self::VAR_ADDITIONAL_BUYER_FIRST_NAME]) && isset($variables[self::VAR_ADDITIONAL_BUYER_LAST_NAME])
                    ? "{$variables[self::VAR_ADDITIONAL_BUYER_FIRST_NAME]} {$variables[self::VAR_ADDITIONAL_BUYER_LAST_NAME]}"
                    : '',

                $variables[self::VAR_PROPERTY_ADDRESS] ?? $variables[self::VAR_FORM_ADDRESS] ?? '',
                isset($variables[self::VAR_FORM_CALCULATOR_OFFER_AMOUNT]) ? '$' . $variables[self::VAR_FORM_CALCULATOR_OFFER_AMOUNT] : '',
                isset($variables[self::VAR_FORM_CALCULATOR_DOWN_PAYMENT]) ? '$' . $variables[self::VAR_FORM_CALCULATOR_DOWN_PAYMENT] : '',
            ];

    }
}
