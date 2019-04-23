<?php

namespace App\Http\Controllers;

use App\BoardMember;
use App\Player;
use App\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{

    public function teamCreate(){

        return view('admin.teams.create_team');
    }

    public function store(Request $request){
        $team = new Team([
           'name' => $request->teamName,
           'totalWins' => $request->totalWins,
            'totalMatches' => $request->totalMatches,
            'totalLoses' => $request->totalLosses,
            'totalDraws' => $request->totalDraws,
        ]);

        $team->save();
        return redirect()->back();
    }

    public function teamManage(){
        $teams = Team::all();
        return view('admin.teams.manage_teams' , compact('teams'));
    }

    public function update(Request $request){

        if ($request->updateBtn != null){
            $team = Team::find($request->teamId);
            $team->name = $request->name;
            $team->totalWins = $request->totalWins;
            $team->totalMatches = $request->totalMatches;
            $team->totalLoses = $request->totalLoses;
            $team->totalDraws = $request->totalDraws;

            $team->update();

            return redirect()->back();

        } else if ($request->deleteBtn != null){
            $team = Team::find($request->teamId);
            $team->delete();
            return redirect()->back();
        }
    }

    public function show($team){

       if ($team === "first-team"){

           $firstTeamUnformatted = Player::where('team_id', '=', 1)->get();
           $firstTeamUnformattedCount = 0;

           foreach ($firstTeamUnformatted as $player){
               $firstTeamUnformatted->forget($firstTeamUnformattedCount);
               $playerMod = Player::find($player->id);
               $playerMod->image =  $playerMod->getMedia('playersImages');
               $firstTeamUnformatted->add($playerMod);
               $firstTeamUnformattedCount ++;
           }

           return  view('team')->with('firstTeamUnformatted', $firstTeamUnformatted);
       } else if ($team === 'junior-c'){

           $juniorC = Player::where('team_id', '=', 2)->get();
           $juniorCCount = 0;

           foreach ($juniorC as $player){
               $juniorC->forget($juniorCCount);
               $playerMod = Player::find($player->id);
               $playerMod->image =  $playerMod->getMedia('playersImages');
               $juniorC->add($playerMod);
               $juniorCCount++;
           }

           return view('team', compact('juniorC'));
       }
       else if ($team === 'junior-d'){
           $juniorD = Player::where('team_id', '=', 3)->get();
           $juniorDCount = 0;
           foreach ($juniorD as $player){
               $juniorD->forget($juniorDCount);
               $playerMod = Player::find($player->id);
               $playerMod->image =  $playerMod->getMedia('playersImages');
               $juniorD->add($playerMod);
               $juniorDCount++;
           }

           return view('team', compact('juniorD'));
       }
       else if ($team === 'junior-e'){
           $juniorE = Player::where('team_id', '=', 4)->get();
           $juniorECount = 0;
           foreach ($juniorE as $player){
               $juniorE->forget($juniorECount);
               $playerMod = Player::find($player->id);
               $playerMod->image =  $playerMod->getMedia('playersImages');
               $juniorE->add($playerMod);
               $juniorECount++;
           }

           return view('team', compact('juniorE'));
       }
       else if ($team === 'junior-f'){
           $juniorF = Player::where('team_id', '=', 5)->get();
           $juniorFCount = 0;
           foreach ($juniorF as $player){
               $juniorF->forget($juniorFCount);
               $playerMod = Player::find($player->id);
               $playerMod->image =  $playerMod->getMedia('playersImages');
               $juniorF->add($playerMod);
               $juniorFCount++;
           }

           return view('team', compact('juniorF'));
       } else if ($team === 'board-of-directors'){

           $boardOfDirectors = BoardMember::all();
           $boardMembersCount = 0;
           foreach ($boardOfDirectors as $member){

               $boardOfDirectors->forget($boardMembersCount);
               $memberMod = BoardMember::find($member->id);
               $memberMod->image =  $memberMod->getMedia('boardMembersImages');
               $boardOfDirectors->add($memberMod);
               $boardMembersCount++;
           }

           return view('team', compact('boardOfDirectors'));
       }

    }

}
