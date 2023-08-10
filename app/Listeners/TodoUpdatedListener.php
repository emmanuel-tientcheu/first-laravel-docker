<?php

namespace App\Listeners;

use App\Events\TodoUpdatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TodoUpdatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\TodoUpdatedEvent  $event
     * @return void
     */
    public function handle(TodoUpdatedEvent $event)
    {
        //
        var_dump('todo created '.$event->todo);
    }
}
