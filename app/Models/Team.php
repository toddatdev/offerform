<?php

namespace App\Models;

use App\Models\OfferForms\OfferForm;
use App\Models\Traits\Uploadable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;

class Team extends JetstreamTeam
{
    use HasFactory;
    use Uploadable;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'personal_team' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'image',
        'name',
        'user_id',
        'code',
        'no_of_agents',
        'contact_name',
        'contact_email',
        'contact_phone',
        'address',
        'notes',
        'personal_team',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => TeamCreated::class,
        'updated' => TeamUpdated::class,
        'deleted' => TeamDeleted::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function offerForms()
    {
        return $this->belongsToMany(OfferForm::class, 'team_offer_form');
    }
}
