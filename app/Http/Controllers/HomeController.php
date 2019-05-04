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

        $unFormattedMatches = Match::orderBy('start_date_time', 'desc')->take(4)->get();
        $matches = [];

        foreach ($unFormattedMatches as $match){

            $start = Carbon::parse($match->start_date_time);
            $now = Carbon::now()->setTimezone('Europe/Zurich');

            $matchArray = ([
                'id' => $match->id,
                'match_type' => $match->match_type,
                'type_name' => $match->type_name,
                'teamA_name' => $match->teamA_name,
                'teamA_score' => $match->teamA_score,
                'teamB_name' => $match->teamB_name,
                'teamB_score' => $match->teamB_score,
                'start_date_time' => $match->start_date_time,
                'reporter_id' => $match->reporter_id,
                'completed' => $match->completed,
                'created_at' => $match->created_at,
                'updated_at' => $match->updated_at,
                'start_date_time2' => $match->start_date_time,
                'start_date_time3' => $start->diffInMinutes($now),
            ]);
            $input  = $match->start_date_time;
            $format = 'Y-m-d H:i:s';

            $newDate = Carbon::createFromFormat($format, $input)->toRfc1123String();
            $unFormattedDate = explode(" ", $newDate);

            $formattedDate = $unFormattedDate[2] .' '. $unFormattedDate[1] .', '. $unFormattedDate[3];
            $matchArray['start_date_time'] = $formattedDate;

            array_push($matches, $matchArray);

        }


        $unFormattedMatches2 = Match::orderBy('start_date_time', 'desc')->take(4)->get();
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
