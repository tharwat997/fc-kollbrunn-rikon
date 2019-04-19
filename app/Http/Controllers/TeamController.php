<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function show($team){

        $firstTeam = "firstTeam";
        $juniorC = "juniorC";
        $juniorD = "juniorD";
        $juniorE = "juniorE";
        $juniorF = "juniorF";
        $boardOfDirectors = "boardOfDirectors";


       if ($team === "first-team"){
           return  view('team', compact('firstTeam'));
       } else if ($team === 'junior-c'){
           return view('team', compact('juniorC'));
       }
       else if ($team === 'junior-d'){
           return view('team', compact('juniorD'));
       }
       else if ($team === 'junior-e'){
           return view('team', compact('juniorE'));
       }
       else if ($team === 'junior-f'){
           return view('team', compact('juniorF'));
       } else if ($team === 'board-of-directors'){
           return view('team', compact('boardOfDirectors'));
       }
    }

}
