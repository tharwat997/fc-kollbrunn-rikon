<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request){
        Comment::create([
           'match_id' => $request->matchId,
            'name' => $request->commentName,
            'comment' => $request->commentBody,
        ]);

        return redirect()->back();
    }
}
