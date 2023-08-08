<?php

namespace App\Providers;

use App\Actions\Jetstream\InviteTeamMember;
use App\Contracts\InvitesTeamMembers;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Stevebauman\Location\Facades\Location;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(InvitesTeamMembers::class, InviteTeamMember::class);
    }
}
