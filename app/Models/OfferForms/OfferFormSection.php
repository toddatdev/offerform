<?php

namespace App\Models\OfferForms;

use App\Models\Category;
use App\Models\Traits\Scopes\ActiveOrInactive;
use App\Models\Traits\Scopes\DisplayOrder;
use App\Models\Traits\Sluggable;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfferFormSection extends Model
{
    use HasFactory;
    use DisplayOrder;
    use ActiveOrInactive;
    use Sluggable;
//    use SoftDeletes;

    public const TYPES_CONFIG = [
        'inputs' => [
            'short-answer' => [
                'text' => 'Short Answer',
                'short_description' => '<h3>Short answer <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span></h3>',
                'description' => '<p>Use this field to ask a question that has a short answer. <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span>',
                'view' => 'short-answer',
                'icon' => '<img  class="w-18 svg-hover-list me-2" src="/img/dash/offer-forms/icons/short-answer.svg" />',
            ],
            'first-name' => [
                'text' => 'First Name',
                'short_description' => '<h3>First Name <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span></h3>',
                'description' => '<p>Use this field to gather your clients first name. The name entered into this field will be used throughout the form to identify your client <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span>',
                'view' => 'first-name',
                'icon' => '<img  class="w-18 svg-hover-list me-2" src="/img/dash/offer-forms/icons/first-name.svg" />',
                'variable' => 1,
            ],
            'last-name' => [
                'text' => 'Last Name',
                'short_description' => '<h3>Last Name <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span></h3>',
                'description' => '<p>Use this field to gather your clients last name. The name entered into this field will be used throughout the form to identify your client <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span>',
                'view' => 'last-name',
                'icon' => '<img  class="w-18 svg-hover-list me-2" src="/img/dash/offer-forms/icons/last-name.svg" />',
                'variable' => 1,
            ],
            'phone-number' => [
                'text' => 'Phone Number',
                'short_description' => '<h3>Phone Number <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span></h3>',
                'description' => '<p>Use this field to ask for your clients phone number. <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span>',
                'view' => 'phone-number',
                'icon' => '<img  class="w-18 svg-hover-list me-2" src="/img/dash/offer-forms/icons/phone-number.svg" />',
            ],
            'email' => [
                'text' => 'Email Address',
                'short_description' => '<h3>Email Address <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span></h3>',
                'description' => '<p>Use this field to ask for your clients email address. <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span>',
                'view' => 'email',
                'icon' => '<img  class="w-18 svg-hover-list me-2" src="/img/dash/offer-forms/icons/email.svg" />',
            ],
            'percentage' => [
                'text' => 'Percentage',
                'short_description' => '<h3>Percentage <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span></h3>',
                'description' => '<p>Use this field to ask for your clients a question that needs to be answered with a percentage. <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span>',
                'view' => 'percentage',
                'icon' => '<img  class="w-18 svg-hover-list me-2" src="/img/dash/offer-forms/icons/percentage.svg" />',
            ],
            'paragraph' => [
                'text' => 'Long Answer',
                'short_description' => '<h3>Long Answer  <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span></h3>',
                'description' => '<p>Use this field to ask details. <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span>',
                'view' => 'paragraph',
                'icon' => '<img  class="w-18 svg-hover-list me-2" src="/img/dash/offer-forms/icons/short-answer.svg" />',
            ],
            'dollar-amount' => [
                'text' => 'Dollar Amount',
                'short_description' => '<h3>Dollar amount  <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span></h3>',
                'description' => '<p>Use this field to ask for your clients a question that needs to be answered with a dollar amount. <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span>',
                'view' => 'dollar-amount',
                'icon' => '<img  class="w-18 svg-hover-list me-2" src="/img/dash/offer-forms/icons/dollar-amount.svg" />',
            ],
            'date' => [
                'text' => 'Date',
                'short_description' => '<h3>Date Input <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span></h3>',
                'description' => '<p>Use this input for gathering a specific date info from your client. <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span>',
                'view' => 'date',
                'icon' => '<img  class="w-18 svg-hover-list me-2" src="/img/dash/offer-forms/icons/date.svg" />',
            ],
            'time' => [
                'text' => 'Time',
                'short_description' => '<h3>Time Input <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span></h3>',
                'description' => '<p>Use this input for gathering a specific time from your client. <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span>',
                'view' => 'time',
                'icon' => '<img  class="w-18 svg-hover-list me-2" src="/img/dash/offer-forms/icons/time.svg" />',
            ],
            'multiple-choice' => [
                'text' => 'Multiple Choice',
                'short_description' => '<h3>Multiple Choice Input <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span></h3>',
                'description' => '<p>Use this input for asking a client to select one option from a number of different choices. <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span>',
                'view' => 'multiple-choice',
                'icon' => '<img  class="w-18 svg-hover-list me-2" src="/img/dash/offer-forms/icons/multiple-choice.svg" />',
            ],
            'checkboxes' => [
                'text' => 'Checkboxes',
                'short_description' => '<h3>Checkboxes Input <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span></h3>',
                'description' => '<p>Use this input for asking a client to select one or multiple options. <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span>',
                'view' => 'checkboxes',
                'icon' => '<img  class="w-18 svg-hover-list me-2" src="/img/dash/offer-forms/icons/checkboxes.svg" />',
            ],
            'dropdown' => [
                'text' => 'Dropdown',
                'short_description' => '<h3>Dropdown Selection <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span></h3>',
                'description' => '<p>Use this input for a dropdown of options. <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span>',
                'view' => 'dropdown',
                'icon' => '<img  class="w-18 svg-hover-list me-2" src="/img/dash/offer-forms/icons/dropdown.svg" />',
            ],
            'address' => [
                'text' => 'Address',
                'short_description' => '<h3>Address <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span></h3>',
                'description' => '<p>Use this field to gather your clients address. The address entered into this field will be used throughout the form <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span>',
                'view' => 'address',
                'icon' => '<img  class="w-14 svg-hover-list me-2" src="/img/dash/offer-forms/icons/address.svg" />',
                'variable' => 1,
            ],
            'yes-or-no' => [
                'text' => 'Yes or No',
                'short_description' => '<h3>Yes or No Input<span style="color:#c67eff !important"><span style="color:black">&nbsp;&nbsp;</span>- CLICK ME TO CHANGE TEXT</span>',
                'description' => '<p>Use this input for asking a client a Yes or No Question<span style="color:#c67eff !important"><span style="color:black">&nbsp;&nbsp;</span>- CLICK ME TO CHANGE TEXT</span>',
                'view' => 'yes-or-no',
                'icon' => '<img  class="w-18 svg-hover-list me-2" src="/img/dash/offer-forms/icons/yesorno.svg" />',
            ],
            'lead-activation' => [
                'text' => 'Lead Activation',
                'short_description' => '<h3>Would you like to be a lead?<span style="color:#c67eff !important"><span style="color:black">&nbsp;&nbsp;</span>- CLICK ME TO CHANGE TEXT</span>',
                'description' => '<p>This is where we ask the questions if they want to be introduced to a referral partner.<span style="color:#c67eff !important"><span style="color:black">&nbsp;&nbsp;</span>- CLICK ME TO CHANGE TEXT</span>',
                'view' => 'lead-activation',
                'icon' => '<img  class="w-18 svg-hover-list me-2" src="/img/dash/offer-forms/icons/yesorno.svg" />',
            ],
            'logic' => [
                'text' => 'Logic',
                'short_description' => '<h3>Logic Input <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span>',
                'description' => '<p>Use this input for displaying different sections based upon your buyer’s response.</p>',
                'view' => 'logic',
                'icon' => '<img  class="w-18 svg-hover-list me-2" src="/img/dash/offer-forms/icons/logic.svg" />',
            ],
            'file-upload' => [
                'text' => 'File Upload',
                'short_description' => '<h3>File Upload <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span></h3>',
                'description' => '<p>Use this input for gathering a file from a client. <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span>',
                'view' => 'file-upload',
                'icon' => '<img  class="w-18 svg-hover-list me-2" src="/img/dash/offer-forms/icons/file-upload.svg" />',
            ],
            'e-signature' => [
                'text' => 'Signature',
                'short_description' => '<h3>Sign here <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span></h3>',
                'description' => '<p>Use this field to ask for your clients to sign. <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span>',
                'view' => 'e-signature',
                'icon' => '<img  class="w-18 svg-hover-list me-2" src="/img/dash/offer-forms/icons/e-signature.svg" />',
            ],
            'cost-calculator' => [
                'text' => 'Add Cost Calculator',
                'short_description' => '<h3>Closing Cost Calculator</h3>',
                'description' => '<p>The closing cost calculator works in conjuction with the mortgage calculator. You must first have the mortgage calculator input used before this module to display results.</p>',
                'view' => 'cost-calculator',
                'icon' => '<img  class="w-18 svg-hover-list me-2" src="/img/dash/offer-forms/icons/closing-cost-calc.svg" / >',
            ],
            'mortgage-calculator' => [
                'text' => 'Mortgage Calculator',
                'short_description' => '<h3>Mortgage calculator module</h3>',
                'description' => '<p>This mortgage calculator will  give an estemated monthly payment. Your clients can click advanced screen to set their own taxes, insurance,ect.</p>',
                'view' => 'mortgage-calculator',
                'icon' => '<img  class="w-18 svg-hover-list me-2" src="/img/dash/offer-forms/icons/mortgage-calc.svg" />',
            ],
            'seller-financing' => [
                'text' => 'Seller Financing',
                'short_description' => '<h3>Seller Carry module</h3>',
                'description' => '<p>This module will help your clients make an offer and ask for seller financing.</p>',
                'view' => 'seller-financing',
                'icon' => '<img  class="w-18 svg-hover-list me-2" src="/img/dash/offer-forms/icons/seller-finance-calc.svg" />',
            ],
        ],
        'medias' => [
            'image' => [
                'text' => 'Image',
                'short_description' => '',
                'description' => '',
                'view' => 'image',
                'icon' => '<img  class="w-18 svg-hover-list me-2" src="/img/dash/offer-forms/icons/seller-finance-calc.svg" />',
            ],
            'video' => [
                'text' => 'Video',
                'short_description' => '',
                'description' => '',
                'view' => 'video',
                'icon' => '<img  class="w-18 svg-hover-list me-2" src="/img/dash/offer-forms/icons/seller-finance-calc.svg" />',
            ],
        ],
        'infos' => [
            'display-text' => [
                'text' => 'Display Text Only Heading & Description',
                'short_description' => '<h3> Click here to add text <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span></h3>',
                'description' => '<p> Click here to add text to the paragraph field <span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span>',
                'view' => 'display-text',
                'icon' => '<img  class="w-18 svg-hover-list me-2" src="/img/dash/offer-forms/icons/seller-finance-calc.svg" />',
            ],
        ],
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'offer_form_id',
        'image',
        'title',
        'type', // inputs, display-text, image, video, cost-calculator, mortgage-calculator, seller-financing
        'type_config',
        'slug',
        'short_description',
        'description',
        'display_order',
        'required',
        'active',
        'go_to_the_next',
        'category_id',
        'placeholder',
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
        'required' => 'boolean',
        'active' => 'boolean',
        'type_config' => 'array',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getSubType()
    {
        return $this->type_config['type'] ?? '';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function offerForm()
    {
        return $this->belongsTo(OfferForm::class, 'offer_form_id');
    }

    public function logics() {
        return $this->hasMany(OfferFormSectionLogic::class);
    }

    public function linkedToLogic() {
        return $this->belongsTo(OfferFormSectionLogic::class);
    }

    public function submittedSection() {
        return $this->hasOne(OfferFormSubmittedSection::class);
    }
}
