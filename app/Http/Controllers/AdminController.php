<?php

namespace App\Http\Controllers;

use App\Event;
use App\Player;
use App\Post;
use App\Team;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $players = Player::all()->count();
        $teams = Team::all()->count();
        $posts = Post::all()->count();
        $events = Event::all()->count();

        return view('admin.dashboard', compact('players', 'teams', 'posts', 'events'));
    }

}
