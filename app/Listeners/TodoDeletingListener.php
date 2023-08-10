<?php

namespace App\Listeners;

use App\Events\TodoDeletingEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TodoDeletingListener
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
     * @param  \App\Events\TodoDeletingEvent  $event
     * @return void
     */
    public function handle(TodoDeletingEvent $event)
    {
        //
        var_dump('todo deleting ', $event->todo);
    }
}
