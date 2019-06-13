<?php

namespace App\Http\Controllers;

use App\Player;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PlayerController extends Controller
{
    public function playersCreate(){
        $teams = Team::all();
        return view('admin.players.create_player', compact('teams'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            "image" => "required|image|mimes:jpeg,png,jpg,webp|dimensions:ratio=1/1,min_width=320,min_height=320|max:300000",
        ]);

        if($validator->fails()){
            return redirect()->back()->with('message', 'Image must be .jpeg, .png, .jpg type, under 30MB, minimum width and height 320, aspect ratio 1:1')->withInput();
        } else {
            if ($request->image === null){
                $player = new Player([
                    'name' => $request->playerName,
                    'playerNumber' => $request->playerNumber,
                    'playerPosition' => $request->playerPosition,
                    'team_id' => $request->team,
                    'age' => $request->playerAge,
                    'total_goals' => $request->totalGoals,
                    'yellow_cards' => $request->yellowCards,
                    'red_cards' => $request->redCards,
                    'assists' => $request->assists,
                    'image' => $request->image,
                    'date_joined' => $request->dateJoined,
                ]);
                $player->save();
            } else {
                $player = new Player([
                    'name' => $request->playerName,
                    'playerNumber' => $request->playerNumber,
                    'playerPosition' => $request->playerPosition,
                    'team_id' => $request->team,
                    'age' => $request->playerAge,
                    'total_goals' => $request->totalGoals,
                    'yellow_cards' => $request->yellowCards,
                    'red_cards' => $request->redCards,
                    'assists' => $request->assists,
                    'image' => $request->image,
                    'date_joined' => $request->dateJoined,
                ]);
                $player->save();
                $player->addMedia($request->image)
                    ->withResponsiveImages()
                    ->toMediaCollection('playersImages');
            }

            return redirect()->back();
        }
    }

    public function playersManage(){
        $teams = Team::all();
        $players = Player::all();
        $newPlayers = [];

        foreach ($players as $player) {
            $playerImage = $player->getMedia('playersImages');
            $player->image = $playerImage;
            $player->team_id = Team::find($player->team_id)->name;
            array_push($newPlayers, $player);
        }

        return view('admin.players.manage_players', ['players' => $newPlayers, 'teams' => $teams] );
    }

    public function update(Request $request){

        if ($request->updateBtn != null){

            if ($request->image != null){

                $validator = Validator::make($request->all(),[
                    "image" => "required|image|mimes:jpeg,png,jpg,webp|dimensions:ratio=1/1,min_width=320,min_height=320|max:300000",
                ]);

                if($validator->fails()){
                    return redirect()->back()->with('message', 'Image must be .jpeg, .png, .jpg type, under 30MB, minimum width and height 320, aspect ratio 1:1');
                } else {

                    $player = Player::find($request->playerId);
                    $player->name = $request->name;
                    $player->playerNumber = $request->playerNumber;
                    $player->playerPosition = $request->playerPosition;
                    $player->team_id = $request->team_id;
                    $player->age = $request->playerAge;
                    $player->total_goals = $request->total_goals;
                    $player->yellow_cards = $request->yellow_cards;
                    $player->red_cards = $request->red_cards;
                    $player->assists = $request->assists;
                    $player->date_joined = $request->date_joined;
                    $player->image = $request->image;

                    $player->update();

                    $player->addMedia($request->image)
                        ->withResponsiveImages()
                        ->toMediaCollection('playersImages');

                    return redirect()->back();
                }
            } else {

                $player = Player::find($request->playerId);
                $player->name = $request->name;
                $player->playerNumber = $request->playerNumber;
                $player->playerPosition = $request->playerPosition;
                $player->team_id = $request->team_id;
                $player->age = $request->playerAge;
                $player->total_goals = $request->total_goals;
                $player->yellow_cards = $request->yellow_cards;
                $player->red_cards = $request->red_cards;
                $player->assists = $request->assists;
                $player->date_joined = $request->date_joined;
                $player->image = $player->image;

                $player->update();

                return redirect()->back();
            }

        } else if ($request->deleteBtn != null) {
            $player = Player::find($request->playerId);
            $player->delete();
            DB::table('players')->where('id', '=', $request->playerId)->delete();
            return redirect()->route('players_manage');
        }
    }
}
