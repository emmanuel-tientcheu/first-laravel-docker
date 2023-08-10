<?php

namespace App\Listeners;

use App\Events\TodoCreatingEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TodoCreatingListener
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
     * @param  \App\Events\TodoCreatingEvent  $event
     * @return void
     */
    public function handle(TodoCreatingEvent $event)
    {
        //
        var_dump('creating todo'.$event->todo);
    }
}
