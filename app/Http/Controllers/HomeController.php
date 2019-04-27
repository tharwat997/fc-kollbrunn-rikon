<?php

namespace App\Http\Controllers;

use App\Event;
use App\Match;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $eventsUnformatted = Event::all();
        $events = [];
        $dates =[];

        foreach ($eventsUnformatted as $event) {
            $input  = $event->start_date;
            $format = 'Y-m-d';

            $oldDate = date("d/m/Y", strtotime($input));
            array_push($dates, $oldDate);

            $newDate = Carbon::createFromFormat($format, $input)->toRfc1123String();

            $unFormattedDate = explode(" ", $newDate);
            $formattedDate = $unFormattedDate[1] .' '. $unFormattedDate[2];

            $event->start_date = $formattedDate;
            array_push($events, $event);
        }

        $posts4Unformatted = Post::orderBy('created_at', 'desc')->take(4)->get();

        $posts4 = [];

        foreach($posts4Unformatted as $posts){
            $post = Post::find($posts->id);
            array_push($posts4, $post);
        }

        $unFormattedMatches = Match::where('start_date_time', '>', Carbon::now()->setTimezone('Europe/Zurich'))->take(4)->get();
        $matches = [];

        foreach ($unFormattedMatches as $match){
            $input  = $match->start_date_time;
            $format = 'Y-m-d H:i:s';

            $newDate = Carbon::createFromFormat($format, $input)->toRfc1123String();
            $unFormattedDate = explode(" ", $newDate);

            $formattedDate = $unFormattedDate[2] .' '. $unFormattedDate[1] .', '. $unFormattedDate[3];
            $match->start_date_time = $formattedDate;

            array_push($matches, $match);

        }

        $unFormattedMatches2 = Match::where('created_at', '<=', Carbon::now()->setTimezone('Europe/Zurich'))->take(3)->get();
        $matches2 = [];

        foreach ($unFormattedMatches2 as $match2){

            $start = Carbon::parse($match2->start_date_time);
            $now = Carbon::now()->setTimezone('Europe/Zurich');

            $match2->start_date_time = $start->diffInMinutes($now);

            array_push($matches2, $match2);
        }


        return view('home', compact('events', 'dates', 'posts4', 'matches', 'matches2'));
    }

    public function redirectToDashboard(){
       return redirect()->route('dashboard');
    }
}
