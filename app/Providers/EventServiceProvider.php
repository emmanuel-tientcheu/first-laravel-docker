<?php

namespace App\Providers;

use App\Events\TodoCreatedEvent;
use App\Events\TodoCreatingEvent;
use App\Events\TodoDeletedEvent;
use App\Events\TodoDeletingEvent;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Models\Todo;
use App\Observers\TodoObserver;
use App\Events\TodoEvent;
use App\Events\TodoStoredEvent;
use App\Events\TodoUpdatedEvent;
use App\Events\TodoUpdatingEvent;
use App\Listeners\TodoCreatedListener;
use App\Listeners\TodoCreatingListener;
use App\Listeners\TodoDeletedListener;
use App\Listeners\TodoDeletingListener;
use App\Listeners\TodoListener;
use App\Listeners\TodoStoredListener;
use App\Listeners\TodoUpdatedListener;
use App\Listeners\TodoUpdatingListener;
use App\Models\Comment;
use App\Observers\CommentObserver;

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
        TodoEvent::class => [
            TodoListener::class,
        ],
        TodoCreatingEvent::class => [
            TodoCreatingListener::class,
        ],
        TodoCreatedEvent::class => [
            TodoCreatedListener::class,
        ],
        TodoUpdatingEvent::class => [
            TodoUpdatingListener::class,
        ],
        TodoUpdatedEvent::class => [
            TodoUpdatedListener::class
        ],
        TodoDeletingEvent::class => [
            TodoDeletingListener::class,
        ],
        TodoDeletedEvent::class => [
            TodoDeletedListener::class,
        ],
        TodoStoredEvent::class => [
            TodoStoredListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
        Todo::observe(TodoObserver::class);
        Comment::observe(CommentObserver::class);
    }
}
