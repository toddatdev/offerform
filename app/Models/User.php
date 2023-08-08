<?php

namespace App\Models;

use App\Models\Blog;
use App\Models\OfferForms\OfferForm;
use App\Models\OfferForms\OfferFormOffer;
use App\Models\Pages\Demo;
use App\Models\Traits\Uploadable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Laravel\Cashier\Billable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Mailjet\LaravelMailjet\Facades\Mailjet;
use Mailjet\Resources;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use function Illuminate\Events\queueable;

//use Spatie\MediaLibrary\HasMedia\HasMedia;
//use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasTeams;
    use HasApiTokens,
        HasFactory,
        Notifiable,
        HasRoles,
        HasPermissions,
        Uploadable,
        HasProfilePhoto,
        Billable;

    /**
     *
     */
    const SUBSCRIPTION_STRIPE_PLANS = [
        'premium-personal-monthly' => 'price_1LBbuzK1X78ynNweRJwudrbw',
        'premium-personal-yearly' => 'price_1LBbvlK1X78ynNwezjlQkIIV',
        'premium-team-monthly' => 'price_1KblFcK1X78ynNwejnS8xeJ8',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::updated(queueable(function ($customer) {
            if ($customer->hasStripeId()) {
                $customer->syncStripeCustomerDetails();
            }
        }));
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image',
        'video',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'password',
        'links',
        'other_inputs',
        'last_login_at',
        'email_verified_at',
        'last_activity_at',
        'integrations',
        'address_components',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'links' => 'array',
        'other_inputs' => 'array',
        'notification_preferences' => 'array',
        'integrations' => 'array',
        'address_components' => 'array',
    ];

    /**
     * @return Attribute
     */
    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => ucwords("$this->first_name $this->last_name"),
        );
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultProfilePhotoUrl()
    {
        return asset($this->defaultProfilePhotoPath());
    }

    protected function defaultProfilePhotoPath()
    {
        return 'img/dash/dummy-img.jpg';
    }

    public function getProfilePhotoPathForPdfAttribute()
    {
        return $this->profile_photo_path
            ? storage_path('app/public/' . $this->profile_photo_path)
            : public_path($this->defaultProfilePhotoPath());
    }

    /**
     * Get the customer name that should be synced to Stripe.
     *
     * @return string|null
     */
    public function stripeName()
    {
        return $this->fullName;
    }

    /**
     * @return Attribute
     */
    public function videoURL(): Attribute
    {
        return Attribute::make(
            get: fn() => strpos($this->video, 'http://') !== false || strpos($this->video, 'https://') !== false ? preg_replace(
                "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
                "https://www.youtube.com/embed/$2",
                $this->video
            ) : asset("storage/$this->video"),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function company()
    {
        return $this->hasOne(Company::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function socialProviders()
    {
        return $this->hasMany(SocialProvider::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offerForms()
    {
        return $this->hasMany(OfferForm::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany(Category::class)
            ->orWhereNull('user_id')
            ->orderBy('user_id')
            ->orderBy('display_order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function demos()
    {
        return $this->hasMany(Demo::class);
    }

    public function offers()
    {
        return $this->hasMany(OfferFormOffer::class)->where('status', 1);
    }

    public function getIsPartOfATeamAttribute()
    {
        $ownedTeam = $this->ownedTeams()->first();
        $associatedTeam = $this->teams()->first();
        return ($ownedTeam && !is_null($this->current_team_id) && $ownedTeam->id === $this->current_team_id) || !is_null($associatedTeam);
    }

    public function sendEmailVerificationNotification()
    {
        mailjet_send_email_by_template([
            'Email' => $this->email,
            'Name' => $this->full_name,
        ], 3785637, [
            'email_verification_link' => URL::temporarySignedRoute(
                'verification.verify',
                Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                [
                    'id' => $this->getKey(),
                    'hash' => sha1($this->getEmailForVerification()),
                ]
            )
        ]);
    }
}
