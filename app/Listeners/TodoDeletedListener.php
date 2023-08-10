<?php

namespace App\Listeners;

use App\Events\TodoDeletedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TodoDeletedListener
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
     * @param  \App\Events\TodoDeletedEvent  $event
     * @return void
     */
    public function handle(TodoDeletedEvent $event)
    {
        //
        var_dump('todo deleted ', $event->todo);
    }
}
