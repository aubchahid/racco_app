<?php

namespace App\Providers;

use App\Models\Affectation;
use App\Models\Blocage;
use App\Observers\AffectationObserver;
use App\Observers\BlocageObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            AffectationObserver::class,
            BlocageObserver::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Affectation::observe(AffectationObserver::class);
        Blocage::observe(BlocageObserver::class);
    }
}
