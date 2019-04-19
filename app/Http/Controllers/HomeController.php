<?php

namespace App\Http\Controllers;

use App\Event;
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

        return view('home', compact('events', 'dates'));
    }

    public function redirectToDashboard(){
       return redirect()->route('dashboard');
    }
}
