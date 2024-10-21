<?php

namespace App\Http\Controllers;
use App\Events\YoutubeViewer;
use App\Video;

use Illuminate\Http\Request;

class EventController extends Controller
{
   public function viewPage(){

 $video= Video::first();

 event(new YoutubeViewer($video));

    return view('events.youtubeviewer')->with(['video'=>$video]);
   }
}
