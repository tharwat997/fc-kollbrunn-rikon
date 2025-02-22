<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Match;
use App\Player;
use App\Team;
use App\TickerEvents;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LiveTickerController extends Controller
{
    public function index(){
        return view('live_ticker');
    }

    public function show($id){
        $matchUnformatted = Match::find($id);

        $start = Carbon::parse($matchUnformatted->start_date_time);
        $now = Carbon::now()->setTimezone('Europe/Zurich');

        $match = ([
            'id' => $matchUnformatted->id,
            'match_type' => $matchUnformatted->match_type,
            'type_name' => $matchUnformatted->type_name,
            'teamA_name' => $matchUnformatted->teamA_name,
            'teamA_score' => $matchUnformatted->teamA_score,
            'teamB_name' => $matchUnformatted->teamB_name,
            'teamB_score' => $matchUnformatted->teamB_score,
            'start_date_time' => $matchUnformatted->start_date_time,
            'reporter_id' => $matchUnformatted->reporter_id,
            'completed' => $matchUnformatted->completed,
            'created_at' => $matchUnformatted->created_at,
            'updated_at' => $matchUnformatted->updated_at,
            'start_date_time2' => $start->diffInMinutes($now),
        ]);


        $eventsUnformatted = DB::table('ticker_events')->where('match_id', '=', $match['id'])
            ->orderBy('minute_of_event', 'desc')->get();

        $events = [];

        foreach ($eventsUnformatted as $event){
            $playerName = Player::find($event->player_idHome);
            $playerName = $playerName['name'];
            $event->player_idHome = $playerName;

            array_push($events, $event);
        }

        $reporterId = $match['reporter_id'];
        $reporterName = User::find($reporterId)->name;
        $reporterEmail = User::find($reporterId)->email;

        $comments = Comment::where('match_id', '=', $match['id'])->orderBy('created_at', 'desc')->get();

        return view ('live_ticker_details', compact('match', 'events', 'reporterName', 'reporterEmail', 'comments'));
    }

    public function matches(){

        $previousMatches = Match::where('start_date_time', '<' , Carbon::today()->toDateTimeString())->paginate(5);
        
        $currentMatches = Match::where('start_date_time', '<' , Carbon::tomorrow()->toDateTimeString())
        ->paginate(5);

        $upComingMatches = Match::where('start_date_time', '>', Carbon::today()->modify('+23 hours')->modify('+59 minutes')->toDateTimeString())
        ->paginate(5);
        $matches = Match::orderBy('start_date_time', 'desc')->paginate(5);
//Check the filtering
        return response()->json([
            'matches' => $matches,
            'previous' => $previousMatches,
            'current' => $currentMatches,
            'upcoming' => $upComingMatches
        ]);
    }

    public function matchCreate(){
        $teams = Team::all();
        $reporters = User::all();

        return view('admin.ticker.create_match', compact('teams', 'reporters'));
    }


    public function matchStore(Request $request){

        if (isset($request->reportId)){

            DB::table('matches')->insert([
                ['match_type' => $request->matchType,
                    'type_name' => $request->title,
                    'teamA_name' => $request->homeTeam,
                    'teamA_score' => $request->homeTeamScore,
                    'teamB_name' => $request->awayTeam,
                    'teamB_score' => $request->awayTeamScore,
                    'start_date_time' => $request->startDateTime,
                    'completed' => 0,
                    'reporter_id' => $request->reportId
                ]
            ]);

            return redirect()->back();
        } else {

            DB::table('matches')->insert([
                ['match_type' => $request->matchType,
                    'type_name' => $request->title,
                    'teamA_name' => $request->homeTeam,
                    'teamA_score' => $request->homeTeamScore,
                    'teamB_name' => $request->awayTeam,
                    'teamB_score' => $request->awayTeamScore,
                    'start_date_time' => $request->startDateTime,
                    'completed' => 0,
                    'reporter_id' => Auth::user()->id,
                ]
            ]);

            return redirect()->back();
        }
    }
    public function matchesManage(){
        $teams = Team::all();
        $matchesUnformatted = Match::all();
        $matches = [];
        foreach ($matchesUnformatted as $match){
            $match->start_date_time = date("Y-m-d\TH:i:s", strtotime($match->start_date_time));
            array_push($matches , $match);
        }

        $reporters = User::all();
        return view('admin.ticker.matches_management', compact('matches', 'reporters', 'teams'));
    }
    public function matchUpdate(Request $request){
        if ($request->updateBtn != null){
            if (isset($request->reportId) && Auth::user()->hasRole('admin')){

                $match = Match::find($request->matchId);

                $match->match_type = $request->matchType;
                $match->type_name = $request->matchTitle;
                $match->teamA_name = $request->homeTeam;
                $match->teamA_score = $request->homeTeamScore;
                $match->teamB_name = $request->awayTeam;
                $match->teamB_score = $request->awayTeamScore;
                $match->start_date_time = $request->start_date_time;
                $match->reporter_id = $request->reportId;

                $match->update();

                return redirect()->back();

            } else if(Auth::user()->hasRole('reporter')) {

                $match = Match::find($request->matchId);

                $match->match_type = $request->matchType;
                $match->type_name = $request->matchTitle;
                $match->teamA_name = $request->homeTeam;
                $match->teamA_score = $request->homeTeamScore;
                $match->teamB_name = $request->awayTeam;
                $match->teamB_score = $request->awayTeamScore;
                $match->start_date_time = $request->start_date_time;
                $match->reporter_id = Auth::user()->id;

                $match->update();

                return redirect()->back();
            }

        } else if ($request->deleteBtn != null){
            $match = Match::find($request->matchId);
            $match->delete();
            return redirect()->back();
        }
    }
    public function matchesView(){
        $teams = Team::all();
        $matches = Match::orderBy('completed')->get();
        $reporters = User::all();
        return view('admin.ticker.manage_matches', compact('matches', 'reporters', 'teams'));
    }

    public function matchEventCreate($id){
        $match = Match::find($id);
        $players = Player::where('team_id', '=' , 1)->get();

        return view('admin.ticker.create_match_event', compact('match', 'players'));
    }
    public function matchEventStore(Request $request){
        $match = Match::find($request->matchId);
        
        $start = Carbon::parse($match->start_date_time);
        $now = Carbon::now()->setTimezone('Europe/Zurich');

        $minute_of_event = $start->diffInMinutes($now);


        if ($request->eventType === "goal"){

            if ($request->homePlayer === "on"){

                TickerEvents::create([
                   'match_id' => $request->matchId,
                    'title' => $request->title,
                    'description' => $request->description,
                    'minute_of_event' => $minute_of_event,
                    'player_idHome' => $request->homePlayerName,
                    'goal' => 1
                ]);

                $player = Player::find($request->homePlayerName);
                $player->total_goals = $player->total_goals + 1;
                $player->update();

                $match = Match::find($request->matchId);
                $match->teamA_score = $match->teamA_score + 1;
                $match->update();

                return redirect()->back();

            } else if ($request->awayPlayer === "on"){

                TickerEvents::create([
                    'match_id' => $request->matchId,
                    'title' => $request->title,
                    'description' => $request->description,
                    'minute_of_event' => $minute_of_event,
                    'playerNameAway' => $request->awayPlayerName,
                    'goal' => 1
                ]);

                $match = Match::find($request->matchId);
                $match->teamB_score = $match->teamB_score + 1;
                $match->update();

                return redirect()->back();
            }
        } else if ($request->eventType === "assist"){

            if ($request->homePlayer === "on"){

                TickerEvents::create([
                    'match_id' => $request->matchId,
                    'title' => $request->title,
                    'description' => $request->description,
                    'minute_of_event' => $minute_of_event,
                    'player_idHome' => $request->homePlayerName,
                    'assist' => 1
                ]);

                $player = Player::find($request->homePlayerName);
                $player->assists = $player->assists + 1;
                $player->update();

                return redirect()->back();

            } else if ($request->awayPlayer === "on"){

                TickerEvents::create([
                    'match_id' => $request->matchId,
                    'title' => $request->title,
                    'description' => $request->description,
                    'minute_of_event' => $minute_of_event,
                    'playerNameAway' => $request->awayPlayerName,
                    'assist' => 1
                ]);
                return redirect()->back();
            }

        } else if ($request->eventType === "yellowCard"){

            if ($request->homePlayer === "on"){

                TickerEvents::create([
                    'match_id' => $request->matchId,
                    'title' => $request->title,
                    'description' => $request->description,
                    'minute_of_event' => $minute_of_event,
                    'player_idHome' => $request->homePlayerName,
                    'yellow_card' => 1
                ]);

                $player = Player::find($request->homePlayerName);
                $player->yellow_cards = $player->yellow_cards + 1;
                $player->update();

                return redirect()->back();

            } else if ($request->awayPlayer === "on"){

                TickerEvents::create([
                    'match_id' => $request->matchId,
                    'title' => $request->title,
                    'description' => $request->description,
                    'minute_of_event' => $minute_of_event,
                    'playerNameAway' => $request->awayPlayerName,
                    'yellow_card' => 1
                ]);
                return redirect()->back();
            }

        } else if ($request->eventType === "redCard"){

            if ($request->homePlayer === "on"){

                TickerEvents::create([
                    'match_id' => $request->matchId,
                    'title' => $request->title,
                    'description' => $request->description,
                    'minute_of_event' => $minute_of_event,
                    'player_idHome' => $request->homePlayerName,
                    'red_card' => 1
                ]);

                $player = Player::find($request->homePlayerName);
                $player->red_cards = $player->red_cards + 1;
                $player->update();
                return redirect()->back();

            } else if ($request->awayPlayer === "on"){
                TickerEvents::create([
                    'match_id' => $request->matchId,
                    'title' => $request->title,
                    'description' => $request->description,
                    'minute_of_event' => $minute_of_event,
                    'playerNameAway' => $request->awayPlayerName,
                    'red_card' => 1
                ]);
                return redirect()->back();
            }

        } else if ($request->eventType === "injury"){

            if ($request->homePlayer === "on"){

                TickerEvents::create([
                    'match_id' => $request->matchId,
                    'title' => $request->title,
                    'description' => $request->description,
                    'minute_of_event' => $minute_of_event,
                    'player_idHome' => $request->homePlayerName,
                    'injury' => 1
                ]);

                return redirect()->back();

            } else if ($request->awayPlayer === "on"){
                TickerEvents::create([
                    'match_id' => $request->matchId,
                    'title' => $request->title,
                    'description' => $request->description,
                    'minute_of_event' => $minute_of_event,
                    'playerNameAway' => $request->awayPlayerName,
                    'injury' => 1
                ]);
                return redirect()->back();
            }

        } else if ($request->eventType === "substitution"){

            if ($request->homePlayer === "on"){

                TickerEvents::create([
                    'match_id' => $request->matchId,
                    'title' => $request->title,
                    'description' => $request->description,
                    'minute_of_event' => $minute_of_event,
                    'player_idHome' => $request->homePlayerName,
                    'substitute' => 1
                ]);
                
            } else if ($request->awayPlayer === "on"){

                TickerEvents::create([
                    'match_id' => $request->matchId,
                    'title' => $request->title,
                    'description' => $request->description,
                    'minute_of_event' => $minute_of_event,
                    'playerNameAway' => $request->awayPlayerName,
                    'substitute' => 1
                ]);
            }

            return redirect()->back();

        } else if ($request->eventType === "blank"){
            
            if ($request->homePlayer === "on"){

                TickerEvents::create([
                    'match_id' => $request->matchId,
                    'title' => $request->title,
                    'description' => $request->description,
                    'minute_of_event' => $minute_of_event,
                    'player_idHome' => $request->homePlayerName,
                    'blank_event' => 1,
                ]);

            } else if ($request->awayPlayer === "on"){

                TickerEvents::create([
                    'match_id' => $request->matchId,
                    'title' => $request->title,
                    'description' => $request->description,
                    'minute_of_event' => $minute_of_event,
                    'playerNameAway' => $request->awayPlayerName,
                    'blank_event' => 1,
                ]);

            }

            return redirect()->back();
        }
    }

    public function matchEvents($id){
        $match = Match::find($id);
        $eventsUnformatted = TickerEvents::where('match_id', '=', $match->id)->get();
        $events = [];

        foreach ($eventsUnformatted as $event){
            $playerName = Player::find($event->player_idHome);
            $playerName = $playerName['name'];
            $event->player_idHome = $playerName;

            array_push($events, $event);
        }

        return view('admin.ticker.manage_match_events', compact('events', 'match'));
    }

    public function matchEventsManage($matchId, $eventId){
        $match = Match::find($matchId);
        $event = TickerEvents::find($eventId);
        $players = Player::all();

        return view('admin.ticker.manage_match_events_detail', compact('match', 'event', 'players'));
    }

    public function matchEventsDelete($matchId, $eventId){
        $event = TickerEvents::find($eventId);

        if ($event->player_idHome != null && $event->goal === 1){
            $player = Player::find($event->player_idHome);
            $player->total_goals = $player->total_goals - 1;
            $player->update();

            $match = Match::find($matchId);
            $match->teamA_score = $match->teamA_score - 1;
            $match->update();
        } else {

            $match = Match::find($matchId);
            $match->teamB_score = $match->teamB_score - 1;
            $match->update();
        }

        if($event->player_idHome != null && $event->assist === 1){
            $player = Player::find($event->player_idHome);
            $player->assists = $player->assists - 1;
            $player->update();
        }

        if($event->player_idHome != null && $event->yellow_card === 1){
            $player = Player::find($event->player_idHome);
            $player->yellow_cards = $player->yellow_cards - 1;
            $player->update();
        }

        if($event->player_idHome != null && $event->red_card === 1){
            $player = Player::find($event->player_idHome);
            $player->red_cards = $player->red_cards - 1;
            $player->update();
        }

        $event->delete();
        return redirect()->back();
    }

    public function matchEventsUpdate(Request $request){
        if ($request->btnUpdate != null){

            if ($request->eventType === "goal"){

                if ($request->homePlayer === "on"){

                    $event = TickerEvents::find($request->eventId);
                    $event->title = $request->title;
                    $event->description = $request->description;
                    $event->minute_of_event =  $event->minute_of_event;

                    $event->goal = null;
                    $event->goal = 1;

                    $playerOld = Player::find($event->player_idHome);
                    $playerNew = Player::find($request->homePlayerName);
                    $match = Match::find($request->matchId);

                    if ($event->assist === 1 && $event->playerNameAway  === null){
                        $playerOld->assists = $playerOld->assists - 1 ;
                        $playerOld->update();

                        $playerNew->total_goals = $playerNew->total_goals + 1;
                        $playerNew->update();

                        $match->teamA_score = $match->teamA_score + 1;
                        $match->update();

                    } else if ($event->assist === 1 && $event->playerNameAway  != null){
                        $playerNew->total_goals = $playerNew->total_goals + 1;
                        $playerNew->update();

                        $match->teamA_score = $match->teamA_score + 1;
                        $match->update();

                    } else {
                        $event->assist = null;
                    }

                    if ($event->yellow_card === 1 && $event->playerNameAway  === null){
                        $playerOld->yellow_cards = $playerOld->yellow_cards - 1 ;
                        $playerOld->update();

                        $playerNew->total_goals = $playerNew->total_goals + 1;
                        $playerNew->update();

                        $match->teamA_score = $match->teamA_score + 1;
                        $match->update();

                    } else if ($event->yellow_card === 1 && $event->playerNameAway  != null){
                        $playerNew->total_goals = $playerNew->total_goals + 1;
                        $playerNew->update();

                        $match->teamA_score = $match->teamA_score + 1;
                        $match->update();

                    } else {
                        $event->yellow_card = null;
                    }

                    if ($event->red_card === 1 && $event->playerNameAway  === null){
                        $playerOld->red_cards = $playerOld->red_cards - 1;
                        $playerOld->update();

                        $playerNew->total_goals = $playerNew->total_goals + 1;
                        $playerNew->update();

                        $match->teamA_score = $match->teamA_score + 1;
                        $match->update();

                    } else if ($event->red_card === 1 && $event->playerNameAway  != null){
                        $playerNew->total_goals = $playerNew->total_goals + 1;
                        $playerNew->update();

                        $match->teamA_score = $match->teamA_score + 1;
                        $match->update();

                    } else {
                        $event->red_card = null;
                    }

                    if ($event->substitute === 1 && $event->playerNameAway  === null){

                        $playerNew->total_goals = $playerNew->total_goals + 1;
                        $playerNew->update();

                        $match->teamA_score = $match->teamA_score + 1;
                        $match->update();

                    } else if ($event->substitute === 1 && $event->playerNameAway  != null){

                        $playerNew->total_goals = $playerNew->total_goals + 1;
                        $playerNew->update();

                        $match->teamA_score = $match->teamA_score + 1;
                        $match->update();
                    } else {
                        $event->substitute = null;
                    }

                    if ($event->blank_event == "1" && $event->playerNameAway  === null){

                        $playerNew->total_goals = $playerNew->total_goals + 1;
                        $playerNew->update();

                        $match->teamA_score = $match->teamA_score + 1;
                        $match->update();

                    } else if ($event->blank_event == "1" && $event->playerNameAway  != null){

                        $playerNew->total_goals = $playerNew->total_goals + 1;
                        $playerNew->update();

                        $match->teamA_score = $match->teamA_score + 1;
                        $match->update();
                    } else {
                        $event->blank_event = null;
                    }

                    if ($event->injury === 1 && $event->playerNameAway  === null){

                        $playerNew->total_goals = $playerNew->total_goals + 1;
                        $playerNew->update();

                        $match->teamA_score = $match->teamA_score + 1;
                        $match->update();

                    } else if ($event->injury === 1 && $event->playerNameAway  != null){

                        $playerNew->total_goals = $playerNew->total_goals + 1;
                        $playerNew->update();

                        $match->teamA_score = $match->teamA_score + 1;
                        $match->update();
                    } else {
                        $event->injury = null;
                    }

                    if ($event->player_idHome != $request->homePlayerName && $event->playerNameAway === null
                        && $event->assist === null && $event->yellow_card === null && $event->red_card === null
                        && $event->injury === null && $event->substitute === null && $event->blank_event === null){
                        $playerOld->total_goals =  $playerOld->total_goals - 1;
                        $playerOld->update();


                        $playerNew->total_goals = $playerNew->total_goals + 1;
                        $playerNew->update();

                    } else if ($event->player_idHome != $request->homePlayerName && $event->playerNameAway != null
                        && $event->assist === null && $event->yellow_card === null && $event->red_card === null
                        && $event->injury === null && $event->substitute === null && $event->blank_event === null){
                        $player = Player::find($request->homePlayerName);
                        $player->total_goals = $player->total_goals + 1;
                        $player->update();
                    }

                    if($event->playerNameAway != null  && $event->assist === null && $event->yellow_card === null && $event->red_card === null
                        && $event->injury === null && $event->substitute === null && $event->blank_event === null){
                        $match->teamB_score = $match->teamB_score - 1;
                        $match->teamA_score = $match->teamA_score + 1;
                        $match->update();
                    }

                    $event->substitute = null;
                    $event->blank_event = null;
                    $event->injury = null;
                    $event->assist = null;
                    $event->yellow_card = null;
                    $event->red_card = null;
                    $event->player_idHome = null;
                    $event->player_idHome = $request->homePlayerName;

                    $event->playerNameAway = null;

                    $event->update();

                    return redirect()->back();

                } else if ($request->awayPlayer === "on"){

                    $event = TickerEvents::find($request->eventId);
                    $event->title = $request->title;
                    $event->description = $request->description;
                    $event->minute_of_event =  $event->minute_of_event;


                    if($event->player_idHome != null){

                        $match = Match::find($request->matchId);
                        $player = Player::find($event->player_idHome);

                        if ($event->goal === 1){
                            $player->total_goals = $player->total_goals - 1;
                            $player->update();

                            $match->teamA_score = $match->teamA_score - 1;
                            $match->teamB_score = $match->teamB_score + 1;
                            $match->update();

                        } else {
                            $event->goal = null;
                            $event->goal = 1;
                        }

                        if ($event->assist === 1){
                            $player->assists = $player->assists - 1 ;
                            $player->update();

                            $match->teamB_score = $match->teamB_score + 1;
                            $match->update();

                            $event->assist = null;
                        } else {
                            $event->assist = null;
                        }

                        if ($event->yellow_card === 1){
                            $player->yellow_cards = $player->yellow_cards - 1 ;
                            $player->update();

                            $match->teamB_score = $match->teamB_score + 1;
                            $match->update();

                            $event->yellow_card = null;
                        } else {
                            $event->yellow_card = null;
                        }

                        if ($event->red_card === 1){
                            $player->red_cards = $player->red_cards - 1 ;
                            $player->update();

                            $match->teamB_score = $match->teamB_score + 1;
                            $match->update();

                            $event->red_card = null;
                        } else {
                            $event->red_card = null;
                        }

                        if ($event->injury === 1){
                            $match->teamB_score = $match->teamB_score + 1;
                            $match->update();
                        }

                        if ($event->substitute === 1){
                            $match->teamB_score = $match->teamB_score + 1;
                            $match->update();
                        }

                        if ($event->blank_event == "1"){
                            $match->teamB_score = $match->teamB_score + 1;
                            $match->update();
                        }

                    } else if ($event->player_idHome === null) {
                        $match = Match::find($request->matchId);

                        if ($event->goal === 1){
                            $match->teamB_score = $match->teamB_score + 1;
                            $match->update();
                        }

                        if ($event->assist === 1){
                            $match->teamB_score = $match->teamB_score + 1;
                            $match->update();

                        }

                        if ($event->yellow_card === 1){
                            $match->teamB_score = $match->teamB_score + 1;
                            $match->update();

                        }

                        if ($event->red_card === 1){
                            $match->teamB_score = $match->teamB_score + 1;
                            $match->update();

                        }

                        if ($event->injury === 1){
                            $match->teamB_score = $match->teamB_score + 1;
                            $match->update();
                        }

                        if ($event->substitute === 1){
                            $match->teamB_score = $match->teamB_score + 1;
                            $match->update();
                        }

                        if ($event->blank_event == "1"){
                            $match->teamB_score = $match->teamB_score + 1;
                            $match->update();
                        }
                    }

                    $event->playerNameAway = null;
                    $event->playerNameAway = $request->awayPlayerName;
                    $event->injury = null;
                    $event->substitute = null;
                    $event->goal = null;
                    $event->goal = 1;
                    $event->yellow_card = null;
                    $event->blank_event = null;
                    $event->red_card = null;
                    $event->assist = null;
                    $event->player_idHome = null;

                    $event->update();

                    return redirect()->back();
                }
            } else if ($request->eventType === "assist"){

                if ($request->homePlayer === "on"){

                    $event = TickerEvents::find($request->eventId);
                    $event->title = $request->title;
                    $event->description = $request->description;
                    $event->minute_of_event =  $event->minute_of_event;


                    $event->assist = null;
                    $event->assist = 1;

                    $playerOld = Player::find($event->player_idHome);
                    $playerNew = Player::find($request->homePlayerName);
                    $match = Match::find($request->matchId);

                    if ($event->goal === 1 && $event->playerNameAway  === null){
                        $playerOld->total_goals = $playerOld->total_goals - 1 ;
                        $playerOld->update();

                        $playerNew->assists = $playerNew->assists + 1;
                        $playerNew->update();

                        $match->teamA_score = $match->teamA_score - 1;
                        $match->update();

                    } else if ($event->goal === 1 && $event->playerNameAway  != null){

                        $playerNew->assists = $playerNew->assists + 1;
                        $playerNew->update();

                        $match->teamB_score = $match->teamB_score - 1;
                        $match->update();

                    } else {
                        $event->goal = null;
                    }

                    if ($event->yellow_card === 1 && $event->playerNameAway  === null){
                        $playerOld->yellow_cards = $playerOld->yellow_cards - 1 ;
                        $playerOld->update();

                        $playerNew->assists = $playerOld->assists + 1;
                        $playerNew->update();

                    } else if ($event->yellow_card === 1 && $event->playerNameAway  != null){

                        $playerNew->assists = $playerOld->assists + 1;
                        $playerNew->update();
                    } else {
                        $event->yellow_card = null;
                    }

                    if ($event->red_card === 1 && $event->playerNameAway  === null){
                        $playerOld->red_cards = $playerOld->red_cards - 1 ;
                        $playerOld->update();

                        $playerNew->assists = $playerNew->assists + 1;
                        $playerNew->update();

                    } else if ($event->red_card === 1 && $event->playerNameAway  != null){
                        $playerNew->assists = $playerNew->assists + 1;
                        $playerNew->update();
                    } else {
                        $event->red_card = null;
                    }

                    if ($event->substitute === 1 && $event->playerNameAway  === null){

                        $playerNew->assists = $playerNew->assists + 1;
                        $playerNew->update();

                    } else if ($event->substitute === 1 && $event->playerNameAway  != null){

                        $playerNew->assists = $playerNew->assists + 1;
                        $playerNew->update();
                    } else {
                        $event->substitute = null;
                    }

                    if ($event->blank_event == "1" && $event->playerNameAway  === null){

                        $playerNew->assists = $playerNew->assists + 1;
                        $playerNew->update();

                    } else if ($event->blank_event == "1" && $event->playerNameAway  != null){

                        $playerNew->assists = $playerNew->assists + 1;
                        $playerNew->update();
                    } else {
                        $event->blank_event = null;
                    }

                    if ($event->injury === 1 && $event->playerNameAway  === null){

                        $playerNew->assists = $playerNew->assists + 1;
                        $playerNew->update();

                    } else if ($event->injury === 1 && $event->playerNameAway  != null){

                        $playerNew->assists = $playerNew->assists + 1;
                        $playerNew->update();
                    } else {
                        $event->injury = null;
                    }

                    if ($event->player_idHome != $request->homePlayerName && $event->playerNameAway  === null
                        && $event->goal === null && $event->yellow_card === null && $event->red_card === null
                        && $event->injury === null && $event->substitute === null && $event->blank_event === null){

                        $playerOld->assists = $playerOld->assists - 1;
                        $playerOld->update();

                        $playerNew->assists = $playerNew->assists + 1;
                        $playerNew->update();

                    } else if ($event->player_idHome != $request->homePlayerName && $event->playerNameAway != null
                        && $event->goal === null && $event->yellow_card === null && $event->red_card === null
                        && $event->injury === null && $event->substitute === null && $event->blank_event === null) {
                        $player = Player::find($request->homePlayerName);
                        $player->assists = $player->assists + 1;
                        $player->update();
                    }

                    $event->substitute = null;
                    $event->injury = null;
                    $event->goal = null;
                    $event->yellow_card = null;
                    $event->red_card = null;
                    $event->blank_event = null;
                    $event->player_idHome = null;
                    $event->player_idHome = $request->homePlayerName;
                    $event->playerNameAway = null;

                    $event->update();

                    return redirect()->back();

                } else if ($request->awayPlayer === "on"){

                    $event = TickerEvents::find($request->eventId);
                    $event->title = $request->title;
                    $event->description = $request->description;
                    $event->minute_of_event =  $event->minute_of_event;

                    $event->injury = null;
                    $event->substitute = null;


                    $event->playerNameAway = $request->awayPlayerName;
                    $match = Match::find($request->matchId);

                    if($event->player_idHome != null){
                        $player = Player::find($event->player_idHome);

                        if ($event->assist === 1){
                            $player->assists = $player->assists - 1;
                            $player->update();

                            $event->assist = null;
                            $event->assist = 1;
                        } else{
                            $event->assist = null;
                            $event->assist = 1;
                        }

                        if ($event->goal === 1){
                            $player->total_goals = $player->total_goals - 1 ;
                            $player->update();

                            $match->teamA_score = $match->teamA_score - 1;
                            $match->update();

                            $event->goal = null;
                        } else {
                            $event->goal = null;
                        }

                        if ($event->yellow_card === 1){
                            $player->yellow_cards = $player->yellow_cards - 1 ;
                            $player->update();
                            $event->yellow_card = null;
                        } else {
                            $event->yellow_card = null;
                        }

                        if ($event->red_card === 1){
                            $player->red_cards = $player->red_cards - 1 ;
                            $player->update();
                            $event->red_card = null;
                        } else {
                            $event->red_card = null;
                        }

                    } else if ($event->player_idHome === null) {
                        $match = Match::find($request->matchId);

                        if ($event->goal === 1){
                            $match->teamB_score = $match->teamB_score + 1;
                            $match->update();
                        }
                    }

                    

                    $event->assist = null;
                    $event->assist = 1;
                    $event->goal = null;
                    $event->blank_event = null;
                    $event->yellow_card = null;
                    $event->red_card = null;
                    $event->player_idHome = null;

                    $event->update();

                    return redirect()->back();
                }

            } else if ($request->eventType === "yellowCard"){

                if ($request->homePlayer === "on"){

                    $event = TickerEvents::find($request->eventId);
                    $event->title = $request->title;
                    $event->description = $request->description;
                    $event->minute_of_event =  $event->minute_of_event;

                    $event->yellow_card = null;
                    $event->yellow_card = 1;

                    $playerOld = Player::find($event->player_idHome);
                    $playerNew = Player::find($request->homePlayerName);
                    $match = Match::find($request->matchId);

                    if ($event->goal === 1 && $event->playerNameAway  === null){
                        $playerOld->total_goals = $playerOld->total_goals - 1 ;
                        $playerOld->update();

                        $playerNew->yellow_cards = $playerNew->yellow_cards + 1;
                        $playerNew->update();

                        $match->teamA_score = $match->teamA_score - 1;
                        $match->update();

                    } else if ($event->goal === 1 && $event->playerNameAway  != null){

                        $playerNew->yellow_cards = $playerNew->yellow_cards + 1;
                        $playerNew->update();

                        $match->teamB_score = $match->teamB_score - 1;
                        $match->update();

                    } else {
                        $event->goal = null;
                    }

                    if ($event->assist === 1 && $event->playerNameAway  === null){
                        $playerOld->assists = $playerOld->assists - 1 ;
                        $playerOld->update();

                        $playerNew->yellow_cards = $playerNew->yellow_cards + 1;
                        $playerNew->update();

                    } else if ($event->assist === 1 && $event->playerNameAway  != null){

                        $playerNew->yellow_cards = $playerNew->yellow_cards + 1;
                        $playerNew->update();

                    } else {
                        $event->assist = null;
                    }

                    if ($event->red_card === 1 && $event->playerNameAway  === null){
                        $playerOld->red_cards = $playerOld->red_cards - 1 ;
                        $playerOld->update();

                        $playerNew->yellow_cards = $playerNew->yellow_cards + 1;
                        $playerNew->update();

                    } else if ($event->red_card === 1 && $event->playerNameAway  != null){

                        $playerNew->yellow_cards = $playerNew->yellow_cards + 1;
                        $playerNew->update();
                    } else {
                        $event->red_card = null;
                    }

                    if ($event->substitute === 1 && $event->playerNameAway  === null){

                        $playerNew->yellow_cards = $playerNew->yellow_cards + 1;
                        $playerNew->update();

                    } else if ($event->substitute === 1 && $event->playerNameAway  != null){

                        $playerNew->yellow_cards = $playerNew->yellow_cards + 1;
                        $playerNew->update();
                    } else {
                        $event->substitute = null;
                    }

                    if ($event->blank_event == "1" && $event->playerNameAway  === null){

                        $playerNew->yellow_cards = $playerNew->yellow_cards + 1;
                        $playerNew->update();

                    } else if ($event->blank_event == "1" && $event->playerNameAway  != null){

                        $playerNew->yellow_cards = $playerNew->yellow_cards + 1;
                        $playerNew->update();
                    } else {
                        $event->blank_event = null;
                    }

                    if ($event->injury === 1 && $event->playerNameAway  === null){

                        $playerNew->yellow_cards = $playerNew->yellow_cards + 1;
                        $playerNew->update();

                    } else if ($event->injury === 1 && $event->playerNameAway  != null){

                        $playerNew->yellow_cards = $playerNew->yellow_cards + 1;
                        $playerNew->update();
                    } else {
                        $event->injury = null;
                    }

                    if ($event->player_idHome != $request->homePlayerName && $event->playerNameAway  === null
                        && $event->goal === null && $event->assist === null && $event->red_card === null
                        && $event->injury === null && $event->substitute === null && $event->blank_event === null){

                        $playerOld->yellow_cards = $playerOld->yellow_cards - 1;
                        $playerOld->update();

                        $playerNew->yellow_cards = $playerNew->yellow_cards + 1;
                        $playerNew->update();


                    } else if ($event->player_idHome != $request->homePlayerName && $event->playerNameAway  != null
                        && $event->goal === null && $event->assist === null && $event->red_card === null
                        && $event->injury === null && $event->substitute === null && $event->blank_event === null){
                        $player = Player::find($request->homePlayerName);
                        $player->yellow_cards = $player->yellow_cards + 1;
                        $player->update();
                    }

                    $event->injury = null;
                    $event->substitute = null;
                    $event->goal = null;
                    $event->red_card = null;
                    $event->blank_event = null;
                    $event->assist = null;
                    $event->playerNameAway = null;
                    $event->player_idHome = $request->homePlayerName;
                    $event->update();

                    return redirect()->back();

                } else if ($request->awayPlayer === "on"){

                    $event = TickerEvents::find($request->eventId);
                    $event->title = $request->title;
                    $event->description = $request->description;
                    $event->minute_of_event =  $event->minute_of_event;


                    $event->injury = null;
                    $event->substitute = null;

                    $event->playerNameAway = $request->awayPlayerName;
                    $match = Match::find($request->matchId);

                    if($event->player_idHome != null){

                        $player = Player::find($event->player_idHome);

                        if ($event->yellow_card === 1){
                            $player->yellow_cards = $player->yellow_cards - 1;
                            $player->update();

                            $event->yellow_card = null;
                            $event->yellow_card = 1;
                        } else{
                            $event->yellow_card = null;
                            $event->yellow_card = 1;
                        }

                        if ($event->goal === 1){
                            $player->total_goals = $player->total_goals - 1 ;
                            $player->update();

                            $match->teamA_score = $match->teamA_score - 1;
                            $match->update();

                            $event->goal = null;
                        } else {
                            $event->goal = null;
                        }

                        if ($event->assist === 1){
                            $player->assists = $player->assists - 1 ;
                            $player->update();
                            $event->assist = null;
                        } else {
                            $event->assist = null;
                        }

                        if ($event->red_card === 1){
                            $player->red_cards = $player->red_cards - 1 ;
                            $player->update();
                            $event->red_card = null;
                        } else {
                            $event->red_card = null;
                        }
                    }

                    if ($event->goal === 1 && $event->player_idHome === null){
                        $match->teamB_score = $match->teamB_score - 1;
                        $match->update();
                    }

                    $event->yellow_card = null;
                    $event->yellow_card = 1;
                    $event->red_card = null;
                    $event->blank_event = null;
                    $event->assist = null;
                    $event->goal = null;
                    $event->player_idHome = null;

                    $event->update();

                    return redirect()->back();
                }

            } else if ($request->eventType === "redCard"){

                if ($request->homePlayer === "on"){

                    $event = TickerEvents::find($request->eventId);
                    $event->title = $request->title;
                    $event->description = $request->description;
                    $event->minute_of_event =  $event->minute_of_event;

                    $event->red_card = null;
                    $event->red_card = 1;

                    $playerOld = Player::find($event->player_idHome);
                    $playerNew = Player::find($request->homePlayerName);
                    $match = Match::find($request->matchId);


                    if ($event->goal === 1 && $event->playerNameAway  === null){
                        $playerOld->total_goals = $playerOld->total_goals - 1 ;
                        $playerOld->update();

                        $playerNew->red_cards = $playerNew->red_cards + 1 ;
                        $playerNew->update();

                        $match->teamA_score = $match->teamA_score - 1;
                        $match->update();

                    } else if ($event->goal === 1 && $event->playerNameAway  != null){
                        $playerNew->red_cards = $playerNew->red_cards + 1 ;
                        $playerNew->update();

                        $match->teamB_score = $match->teamB_score - 1;
                        $match->update();
                    } else {
                        $event->goal = null;
                    }

                    if ($event->assist === 1 && $event->playerNameAway  === null){
                        $playerOld->assists = $playerOld->assists - 1 ;
                        $playerOld->update();

                        $playerNew->red_cards = $playerNew->red_cards + 1 ;
                        $playerNew->update();

                    } else if ($event->assist === 1 && $event->playerNameAway  != null){
                        $playerNew->red_cards = $playerNew->red_cards + 1 ;
                        $playerNew->update();

                    } else {
                        $event->assist = null;
                    }

                    if ($event->yellow_card === 1 && $event->playerNameAway  === null){
                        $playerOld->yellow_cards = $playerOld->yellow_cards - 1 ;
                        $playerOld->update();

                        $playerNew->red_cards = $playerNew->red_cards + 1 ;
                        $playerNew->update();

                    } else if ($event->yellow_card === 1 && $event->playerNameAway  != null){
                        $playerNew->red_cards = $playerNew->red_cards + 1 ;
                        $playerNew->update();

                    } else {
                        $event->yellow_card = null;
                    }

                    if ($event->substitute === 1 && $event->playerNameAway  === null){

                        $playerNew->red_cards = $playerNew->red_cards + 1;
                        $playerNew->update();

                    } else if ($event->substitute === 1 && $event->playerNameAway  != null){

                        $playerNew->red_cards = $playerNew->red_cards + 1;
                        $playerNew->update();
                    } else {
                        $event->substitute = null;
                    }

                    if ($event->blank_event == "1" && $event->playerNameAway  === null){

                        $playerNew->red_cards = $playerNew->red_cards + 1;
                        $playerNew->update();

                    } else if ($event->blank_event == "1" && $event->playerNameAway  != null){

                        $playerNew->red_cards = $playerNew->red_cards + 1;
                        $playerNew->update();
                    } else {
                        $event->blank_event = null;
                    }

                    if ($event->injury === 1 && $event->playerNameAway  === null){

                        $playerNew->red_cards = $playerNew->red_cards + 1;
                        $playerNew->update();

                    } else if ($event->injury === 1 && $event->playerNameAway  != null){

                        $playerNew->red_cards = $playerNew->red_cards + 1;
                        $playerNew->update();
                    } else {
                        $event->injury = null;
                    }

                    if ($event->player_idHome != $request->homePlayerName && $event->playerNameAway  === null
                        && $event->goal === null && $event->assist === null && $event->yellow_card === null
                        && $event->injury === null && $event->substitute === null && $event->blank_event === null){
                        $playerOld->red_cards = $playerOld->red_cards - 1;
                        $playerOld->update();

                        $playerNew->red_cards = $playerNew->red_cards + 1;
                        $playerNew->update();

                    } else if ($event->player_idHome != $request->homePlayerName && $event->playerNameAway  != null
                        && $event->goal === null && $event->assist === null && $event->yellow_card === null
                        && $event->injury === null && $event->substitute === null && $event->blank_event === null){
                        $player = Player::find($request->homePlayerName);
                        $player->red_cards = $player->red_cards + 1;
                        $player->update();
                    }

                    $event->injury = null;
                    $event->substitute = null;
                    $event->goal = null;
                    $event->yellow_card = null;
                    $event->blank_event = null;
                    $event->assist = null;
                    $event->playerNameAway = null;
                    $event->player_idHome = $request->homePlayerName;
                    $event->update();

                    return redirect()->back();

                } else if ($request->awayPlayer === "on"){

                    $event = TickerEvents::find($request->eventId);
                    $event->title = $request->title;
                    $event->description = $request->description;
                    $event->minute_of_event =  $event->minute_of_event;

                    $event->injury = null;
                    $event->substitute = null;


                    $event->playerNameAway = $request->awayPlayerName;
                    $match = Match::find($request->matchId);

                    if($event->player_idHome != null){
                        $player = Player::find($event->player_idHome);

                        if ($event->red_card === 1){
                            $player->red_cards = $player->red_cards - 1;
                            $player->update();

                            $event->red_card = null;
                            $event->red_card = 1;
                        } else {
                            $event->red_card = null;
                            $event->red_card = 1;
                        }

                        if ($event->goal === 1){
                            $player->total_goals = $player->total_goals - 1 ;
                            $player->update();

                            $match->teamA_score = $match->teamA_score - 1;
                            $match->update();

                            $event->goal = null;
                        } else {
                            $event->goal = null;
                        }

                        if ($event->assist === 1){
                            $player->assists = $player->assists - 1 ;
                            $player->update();
                            $event->assist = null;
                        } else {
                            $event->assist = null;
                        }

                        if ($event->yellow_card === 1){
                            $player->yellow_cards = $player->yellow_cards - 1 ;
                            $player->update();
                            $event->yellow_card = null;
                        } else {
                            $event->yellow_card = null;
                        }
                    }

                    if ($event->goal === 1 && $event->player_idHome === null){
                        $match->teamB_score = $match->teamB_score - 1;
                        $match->update();
                    }

                    $event->red_card = null;
                    $event->red_card = 1;
                    $event->yellow_card = null;
                    $event->blank_event = null;
                    $event->assist = null;
                    $event->goal = null;
                    $event->player_idHome = null;
                    $event->update();

                    return redirect()->back();

                }

            } else if ($request->eventType === "injury"){

                if ($request->homePlayer === "on"){

                    $event = TickerEvents::find($request->eventId);
                    $event->title = $request->title;
                    $event->description = $request->description;
                    $event->minute_of_event =  $event->minute_of_event;

                    $playerOld = Player::find($event->player_idHome);
                    $match = Match::find($request->matchId);

                    if ($event->goal === 1 && $event->playerNameAway  === null){
                        $playerOld->total_goals = $playerOld->total_goals - 1 ;
                        $playerOld->update();

                        $match->teamA_score = $match->teamA_score - 1;
                        $match->update();

                    } else if ($event->goal === 1 && $event->playerNameAway  != null){

                        $match->teamB_score = $match->teamB_score - 1;
                        $match->update();

                        $event->goal = null;
                    }

                    if ($event->assist === 1 && $event->playerNameAway  === null){
                        $playerOld->assists = $playerOld->assists - 1 ;
                        $playerOld->update();

                    }  else {
                        $event->assist = null;
                    }

                    if ($event->yellow_card === 1 && $event->playerNameAway  === null){
                        $playerOld->yellow_cards = $playerOld->yellow_cards - 1 ;
                        $playerOld->update();

                    } else {
                        $event->yellow_card = null;
                    }

                    if ($event->red_card === 1 && $event->playerNameAway  === null){
                        $playerOld->red_cards = $playerOld->red_cards - 1 ;
                        $playerOld->update();
                    } else {
                        $event->yellow_card = null;
                    }

                    $event->playerNameAway = null;
                    $event->yellow_card = null;
                    $event->red_card = null;
                    $event->injury = null;
                    $event->assist = null;
                    $event->goal = null;
                    $event->substitute = null;
                    $event->blank_event = null;
                    $event->injury = 1;
                    $event->player_idHome = $request->homePlayerName;
                    $event->update();
                    return redirect()->back();

                } else if ($request->awayPlayer === "on"){

                    $event = TickerEvents::find($request->eventId);
                    $event->title = $request->title;
                    $event->description = $request->description;
                    $event->minute_of_event =  $event->minute_of_event;

                    if($event->player_idHome != null){
                        $player = Player::find($event->player_idHome);
                        $match = Match::find($request->matchId);


                        if ($event->red_card === 1){
                            $player->red_cards = $player->red_cards - 1;
                            $player->update();

                            $event->red_card = null;
                            $event->red_card = 1;
                        } else {
                            $event->red_card = null;
                            $event->red_card = 1;
                        }

                        if ($event->yellow_card === 1){
                            $player->yellow_cards = $player->yellow_cards - 1;
                            $player->update();

                            $event->yellow_card = null;
                            $event->yellow_card = 1;
                        } else {
                            $event->yellow_card = null;
                            $event->yellow_card = 1;
                        }

                        if ($event->goal === 1){
                            $player->total_goals = $player->total_goals - 1 ;
                            $player->update();

                            $match->teamA_score = $match->teamA_score - 1;
                            $match->update();

                            $event->goal = null;
                        } else {
                            $event->goal = null;
                        }

                        if ($event->assist === 1){
                            $player->assists = $player->assists - 1 ;
                            $player->update();
                            $event->assist = null;
                        } else {
                            $event->assist = null;
                        }

                    }

                    if ($event->goal === 1 && $event->player_idHome === null){
                        $match = Match::find($request->matchId);
                        $match->teamB_score = $match->teamB_score - 1;
                        $match->update();
                    }

                    $event->player_idHome = null;
                    $event->injury = null;
                    $event->injury = 1;
                    $event->assist = null;
                    $event->goal = null;
                    $event->yellow_card = null;
                    $event->red_card = null;
                    $event->substitute = null;
                    $event->blank_event = null;
                    $event->playerNameAway = $request->awayPlayerName;
                    $event->update();

                    return redirect()->back();
                }

            } else if ($request->eventType === "substitution"){

                if ($request->homePlayer === "on"){

                    $event = TickerEvents::find($request->eventId);
                    $event->title = $request->title;
                    $event->description = $request->description;
                    $event->minute_of_event =  $event->minute_of_event;


                    $playerOld = Player::find($event->player_idHome);
                    $match = Match::find($request->matchId);

                    if ($event->goal === 1 && $event->playerNameAway  === null){
                        $playerOld->total_goals = $playerOld->total_goals - 1 ;
                        $playerOld->update();

                        $match->teamA_score = $match->teamA_score - 1;
                        $match->update();

                    } else if ($event->goal === 1 && $event->playerNameAway  != null) {

                        $match->teamB_score = $match->teamB_score - 1;
                        $match->update();
                        $event->goal = null;
                    }

                    if ($event->assist === 1 && $event->playerNameAway  === null){
                        $playerOld->assists = $playerOld->assists - 1 ;
                        $playerOld->update();

                    }  else {
                        $event->assist = null;
                    }

                    if ($event->yellow_card === 1 && $event->playerNameAway  === null){
                        $playerOld->yellow_cards = $playerOld->yellow_cards - 1 ;
                        $playerOld->update();

                    } else {
                        $event->yellow_card = null;
                    }

                    if ($event->red_card === 1 && $event->playerNameAway  === null){
                        $playerOld->red_cards = $playerOld->red_cards - 1 ;
                        $playerOld->update();
                    } else {
                        $event->yellow_card = null;
                    }


                    $event->playerNameAway = null;
                    $event->yellow_card = null;
                    $event->red_card = null;
                    $event->injury = null;
                    $event->assist = null;
                    $event->goal = null;
                    $event->blank_event = null;
                    $event->substitute = null;
                    $event->substitute = 1;
                    $event->player_idHome = $request->homePlayerName;
                    $event->update();

                    return redirect()->back();

                } else if ($request->awayPlayer === "on"){

                    $event = TickerEvents::find($request->eventId);
                    $event->title = $request->title;
                    $event->description = $request->description;
                    $event->minute_of_event =  $event->minute_of_event;

                    if($event->player_idHome != null){
                        $player = Player::find($event->player_idHome);
                        $match = Match::find($request->matchId);

                        if ($event->red_card === 1){
                            $player->red_cards = $player->red_cards - 1;
                            $player->update();

                            $event->red_card = null;
                            $event->red_card = 1;
                        } else {
                            $event->red_card = null;
                            $event->red_card = 1;
                        }

                        if ($event->yellow_card === 1){
                            $player->yellow_cards = $player->yellow_cards - 1;
                            $player->update();

                            $event->yellow_card = null;
                            $event->yellow_card = 1;
                        } else {
                            $event->yellow_card = null;
                            $event->yellow_card = 1;
                        }

                        if ($event->goal === 1){
                            $player->total_goals = $player->total_goals - 1 ;
                            $player->update();

                            $match->teamA_score = $match->teamA_score - 1;
                            $match->update();

                            $event->goal = null;
                        } else {
                            $event->goal = null;
                        }

                        if ($event->assist === 1){
                            $player->assists = $player->assists - 1 ;
                            $player->update();
                            $event->assist = null;
                        } else {
                            $event->assist = null;
                        }

                    }

                    if ($event->goal === 1 && $event->player_idHome === null){
                        $match = Match::find($request->matchId);
                        $match->teamB_score = $match->teamB_score - 1;
                        $match->update();
                    }

                    $event->player_idHome = null;
                    $event->substitute = null;
                    $event->substitute = 1;
                    $event->injury = null;
                    $event->blank_event = null;
                    $event->assist = null;
                    $event->goal = null;
                    $event->yellow_card = null;
                    $event->red_card = null;

                    $event->playerNameAway = $request->awayPlayerName;
                    $event->update();

                    return redirect()->back();
                }

            } else if ($request->eventType === "blank"){

                if ($request->homePlayer === "on"){

                    $event = TickerEvents::find($request->eventId);
                    $event->title = $request->title;
                    $event->description = $request->description;
                    $event->minute_of_event =  $event->minute_of_event;

                    $playerOld = Player::find($event->player_idHome);
                    $match = Match::find($request->matchId);

                    if ($event->goal === 1 && $event->playerNameAway  === null){
                        $playerOld->total_goals = $playerOld->total_goals - 1 ;
                        $playerOld->update();

                        $match->teamA_score = $match->teamA_score - 1;
                        $match->update();

                    } else if ($event->goal === 1 && $event->playerNameAway  != null) {

                        $match->teamB_score = $match->teamB_score - 1;
                        $match->update();
                        $event->goal = null;
                    }

                    if ($event->assist === 1 && $event->playerNameAway  === null){
                        $playerOld->assists = $playerOld->assists - 1 ;
                        $playerOld->update();

                    }  else {
                        $event->assist = null;
                    }

                    if ($event->yellow_card === 1 && $event->playerNameAway  === null){
                        $playerOld->yellow_cards = $playerOld->yellow_cards - 1 ;
                        $playerOld->update();

                    } else {
                        $event->yellow_card = null;
                    }

                    if ($event->red_card === 1 && $event->playerNameAway  === null){
                        $playerOld->red_cards = $playerOld->red_cards - 1 ;
                        $playerOld->update();
                    } else {
                        $event->yellow_card = null;
                    }


                    $event->playerNameAway = null;
                    $event->yellow_card = null;
                    $event->red_card = null;
                    $event->injury = null;
                    $event->assist = null;
                    $event->goal = null;
                    $event->substitute = null;
                    $event->blank_event = 1;
                    $event->player_idHome = $request->homePlayerName;
                    $event->update();

                    return redirect()->back();

                } else if ($request->awayPlayer === "on"){

                    $event = TickerEvents::find($request->eventId);
                    $event->title = $request->title;
                    $event->description = $request->description;
                    $event->minute_of_event =  $event->minute_of_event;

                    if($event->player_idHome != null){
                        $player = Player::find($event->player_idHome);
                        $match = Match::find($request->matchId);

                        if ($event->red_card === 1){
                            $player->red_cards = $player->red_cards - 1;
                            $player->update();

                            $event->red_card = null;
                            $event->red_card = 1;
                        } else {
                            $event->red_card = null;
                            $event->red_card = 1;
                        }

                        if ($event->yellow_card === 1){
                            $player->yellow_cards = $player->yellow_cards - 1;
                            $player->update();

                            $event->yellow_card = null;
                            $event->yellow_card = 1;
                        } else {
                            $event->yellow_card = null;
                            $event->yellow_card = 1;
                        }

                        if ($event->goal === 1){
                            $player->total_goals = $player->total_goals - 1 ;
                            $player->update();

                            $match->teamA_score = $match->teamA_score - 1;
                            $match->update();

                            $event->goal = null;
                        } else {
                            $event->goal = null;
                        }

                        if ($event->assist === 1){
                            $player->assists = $player->assists - 1 ;
                            $player->update();
                            $event->assist = null;
                        } else {
                            $event->assist = null;
                        }

                    }

                    if ($event->goal === 1 && $event->player_idHome === null){
                        $match = Match::find($request->matchId);
                        $match->teamB_score = $match->teamB_score - 1;
                        $match->update();
                    }

                    $event->player_idHome = null;
                    $event->substitute = null;
                    $event->blank_event = 1;
                    $event->injury = null;
                    $event->assist = null;
                    $event->goal = null;
                    $event->yellow_card = null;
                    $event->red_card = null;

                    $event->playerNameAway = $request->awayPlayerName;
                    $event->update();

                    return redirect()->back();
                }

            }
        }

        else if ($request->btnDelete != null){

            $event = TickerEvents::find($request->eventId);

            if ($event->player_idHome != null && $event->goal === 1){
                $player = Player::find($event->player_idHome);
                $player->total_goals = $player->total_goals - 1;
                $player->update();

                $match = Match::find($request->matchId);
                $match->teamA_score = $match->teamA_score - 1;
                $match->update();
            } else {
                $match = Match::find($request->matchId);
                $match->teamB_score = $match->teamB_score - 1;
                $match->update();
            }

            if($event->player_idHome != null && $event->assist === 1){
                $player = Player::find($event->player_idHome);
                $player->assists = $player->assists - 1;
                $player->update();
            }

            if($event->player_idHome != null && $event->yellow_card === 1){
                $player = Player::find($event->player_idHome);
                $player->yellow_cards = $player->yellow_cards - 1;
                $player->update();
            }

            if($event->player_idHome != null && $event->red_card === 1){
                $player = Player::find($event->player_idHome);
                $player->red_cards = $player->red_cards - 1;
                $player->update();
            }

            $event->delete();
            return redirect()->back();
        }

    }

    public function matchEnd($id){

        $match = Match::find($id);
        $match->completed = 1;

        $team = Team::find(1);
        $team->totalMatches =  $team->totalMatches + 1;

        if ($match->teamA_score > $match->teamB_score){
            $team->totalWins = $team->totalWins + 1;
        } else if ($match->teamA_score < $match->teamB_score){
            $team->totalLoses = $team->totalLoses + 1;
        } else if ($match->teamA_score === $match->teamB_score){
            $team->totalDraws = $team->totalDraws + 1;
        }
        $team->update();

        $match->update();

        return redirect()->back();
    }
}
