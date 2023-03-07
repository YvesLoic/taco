<?php

namespace App\Providers;

use App\Events\UserTracking;
use App\Listeners\UpdatePosition;
use App\Listeners\UserIsOnline;
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
        ],
        UserTracking::class => [
            UserIsOnline::class,
            UpdatePosition::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(
            UserTracking::class,
            [
                UserIsOnline::class, 'handle',
                UpdatePosition::class, 'handle'
            ]
        );
    }
}
