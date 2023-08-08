<?php

namespace App\Models;

use App\Models\OfferForms\OfferForm;
use App\Models\OfferForms\OfferFormSection;
use App\Models\OfferForms\OfferFormSubmittedSection;
use App\Models\Traits\Scopes\DisplayOrder;
use App\Models\Traits\Uploadable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use DisplayOrder;
    use Uploadable;

    public static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $user = auth()->check() ? auth()->user() : new User(['id' => 1]);
            \Log::info('Checking Category: ', [$user]);
            $model->userDisplayOrder()->save(new CategoryUserDisplayOrder([
                'user_id' => $model->user_id ?? $user->id,
                'display_order' => next_display_order(CategoryUserDisplayOrder::where('user_id', $model->user_id ?? $user->id))
            ]));
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image',
        'name',
        'slug',
        'display_order',
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
    ];

    /**
     * @param array $options
     * @return bool
     */
    public function save(array $options = [])
    {
        if (!$this->display_order) {
            $this->display_order = next_display_order(
                self::when(auth()->check(), function ($query) {
                    if (auth()->user()->hasRole('agent')) {
                        $query->where('user_id', auth()->user()->id);
                    } else {
                        $query->whereNull('user_id');
                    }
                })
            );
        }

        return parent::save();
    }

    public function sections()
    {
        return $this->hasMany(OfferFormSection::class);
    }

    public function submittedSections()
    {
        return $this->hasMany(OfferFormSubmittedSection::class);
    }

    public static function getQuery($user = null)
    {
        if (auth()->check() && $user === null) {
            $user = auth()->user();
        }

        $adminCategories = self::whereNull('user_id');
//        $agentCategories = self::where('user_id', $user->id)->orderBy('display_order')->get();

        if ($user->hasRole('agent')) {
            $list = $adminCategories->whereDoesntHave('categoryUserDisplayOrder', function ($query) use ($user){
                $query->where('user_id', $user->id);
            })->get();

            if (count($list) > 0) {
                foreach ($list as $item) {
                    $item->userDisplayOrder()->save(new CategoryUserDisplayOrder([
                        'user_id' => $user->id,
                        'display_order' => next_display_order(CategoryUserDisplayOrder::where('user_id', $user->id))
                    ]));
                }
            }
            return self::leftJoin('category_user_display_orders', 'category_user_display_orders.category_id', '=', 'categories.id')
                ->where(function ($query) use ($user) {
                    $query->where('categories.user_id', $user->id)->orWhereNull('categories.user_id');
                })
                ->where('category_user_display_orders.user_id', $user->id)
                ->orderBy('category_user_display_orders.display_order')
                ->select([
                    'categories.*',
                    'category_user_display_orders.display_order as display_order',
                ])
                ->get();
        } else {
            return $adminCategories->orderBy('display_order')->get();
        }
    }

    public function userDisplayOrder()
    {
        return $this->hasOne(CategoryUserDisplayOrder::class)->where('user_id', $this->user_id);
    }

    public function categoryUserDisplayOrder()
    {
        return $this->hasOne(CategoryUserDisplayOrder::class);
    }
}
