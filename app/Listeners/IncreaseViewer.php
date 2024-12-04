<?php

namespace App\Listeners;
 
use App\Events\YoutubeViewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseViewer
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
     * @param  object  $event
     * @return void
     */
    public function handle(YoutubeViewer $event)
    {
        if(!session()->has('videoIsVisited'))
        $this->updateViewer($event -> video);
    else
    return false;
    }

    function updateViewer($video){
     $video->viewer =  $video -> viewer + 1;
     $video->save();
     session()->put('videoIsVisited',$video->id);
    }
}
