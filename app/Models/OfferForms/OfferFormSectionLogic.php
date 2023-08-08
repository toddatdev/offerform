<?php

namespace App\Models\OfferForms;

use App\Models\Traits\Scopes\DisplayOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferFormSectionLogic extends Model
{
    use HasFactory;
    use DisplayOrder;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'offer_form_section_logic_id',
        'name',
        'display_order',
    ];

    /**
     * @param array $options
     * @return bool
     */
    public function save(array $options = [])
    {
        if (!$this->display_order) {
            $this->display_order = next_display_order(
                app(self::class)
            );
        }

        return parent::save();
    }

    public function section() {
        return $this->belongsTo(OfferFormSection::class);
    }

    public function linkedSections() {
        return $this->hasMany(OfferFormSection::class);
    }
}
