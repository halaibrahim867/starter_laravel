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
        if(!session()->has('videoIsVisited')) {
            $this->updateViewer($event->video);
        }
        return false;
    }

    public  function updateViewer($video){

        $video ->viewers = $video ->viewers  + 1;
        $video -> save();

        session()->put('videoIsVisited',$video->id);
    }
}
