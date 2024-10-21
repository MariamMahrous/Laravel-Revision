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
        $this->updateViewer($event -> video);
    }

    function updateViewer($video){
     $video->viewer =  $video -> viewer + 1;
     $video->save();
    }
}
