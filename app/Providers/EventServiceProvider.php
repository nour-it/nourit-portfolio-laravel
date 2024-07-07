<?php

namespace App\Providers;

use App\Events\Admin\UpdateCategoryEvent;
use App\Events\Admin\UpdateProfileEvent;
use App\Events\Admin\UpdateProjectEvent;
use App\Events\Admin\UpdateQualificationEvent;
use App\Events\Admin\UpdateServiceEvent;
use App\Events\Admin\UpdateSkillEvent;
use App\Events\ViewSkillPageEvent;
use App\Listeners\Admin\UpdateCategoryEventListener;
use App\Listeners\Admin\UpdateProfileEventListener;
use App\Listeners\Admin\UpdateProjectEventListener;
use App\Listeners\Admin\UpdateQualificationEventListener;
use App\Listeners\Admin\UpdateServiceEventListener;
use App\Listeners\Admin\UpdateSkillEventListener;
use App\Listeners\ViewSkillPageListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ViewSkillPageEvent::class => [
            ViewSkillPageListener::class
        ],
        UpdateSkillEvent::class => [
            UpdateSkillEventListener::class
        ],
        UpdateProjectEvent::class => [
            UpdateProjectEventListener::class
        ],
        UpdateServiceEvent::class => [
            UpdateServiceEventListener::class
        ],
        UpdateQualificationEvent::class => [
            UpdateQualificationEventListener::class
        ],
        UpdateProfileEvent::class => [
            UpdateProfileEventListener::class
        ],
        UpdateCategoryEvent::class => [
            UpdateCategoryEventListener::class
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
