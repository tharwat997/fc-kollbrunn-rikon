<?php

namespace App\Http\Controllers;

use App\Match;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LiveTickerController extends Controller
{
    public function index(){
        return view('live_ticker');
    }

    public function show($id){
        $match = Match::find($id);
        return view ('live_ticker_details')->with('match', $match);
    }

    public function matches(){
        $previousMatches = Match::where('start_date_time', '<' , Carbon::now()->toDateTimeString())->paginate(5);
        $currentMatches = Match::where('start_date_time', '=' , Carbon::now()->toDateTimeString())->paginate(5);
        $upComingMatches = Match::where('start_date_time', '>' , Carbon::now()->toDateTimeString())->paginate(5);
        $matches = Match::orderBy('created_at', 'desc')->paginate(5);

        return response()->json([
            'matches' => $matches,
            'previous' => $previousMatches,
            'current' => $currentMatches,
            'upcoming' => $upComingMatches
        ]);
    }
}
