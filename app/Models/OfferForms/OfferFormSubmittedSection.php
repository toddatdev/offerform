<?php

namespace App\Models\OfferForms;

use App\Models\Category;
use App\Models\Traits\Scopes\ActiveOrInactive;
use App\Models\Traits\Scopes\DisplayOrder;
use App\Models\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfferFormSubmittedSection extends Model
{
    use HasFactory;
    use DisplayOrder;
    use ActiveOrInactive;
    use Sluggable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'offer_form_id',
        'offer_form_offer_id',
        'offer_form_section_id',
        'image',
        'title',
        'type', // inputs, display-text, image, video, cost-calculator, mortgage-calculator, seller-financing
        'type_config',
        'user_response',
        'slug',
        'short_description',
        'description',
        'display_order',
        'required',
        'active',
        'go_to_the_next',
        'category_id',
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
        'type_config' => 'array',
        'user_response' => 'array',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function offerForm()
    {
        return $this->belongsTo(OfferForm::class, 'offer_form_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function offerFormOffer()
    {
        return $this->belongsTo(OfferFormOffer::class);
    }

    public function getSubType()
    {
        return $this->type_config['type'] ?? '';
    }

    public function offerFormSection()
    {
        return $this->belongsTo(OfferFormSection::class);
    }
}
