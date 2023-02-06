<?php

namespace App\Listeners;

use App\Events\videoViewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class increaseCounter
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct( )
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(videoViewer $event)
    {
        //
        $this->updateViewer($event->video);
    }

    public  function updateViewer($video){

        $video ->viewers = $video ->viewers  + 1;
        $video -> save();
    }
}
