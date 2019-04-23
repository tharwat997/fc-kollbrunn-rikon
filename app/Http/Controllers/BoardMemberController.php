<?php

namespace App\Http\Controllers;

use App\BoardMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BoardMemberController extends Controller
{
    public function boardCreate(){
        return view('admin.board.create_board_member', compact('boardMembers'));
    }
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            "image" => "required|image|mimes:jpeg,png,jpg,webp|dimensions:ratio=1/1,min_width=320,min_height=320|max:300000",
        ]);

        if($validator->fails()){
            return redirect()->back()->with('message', 'Image must be .jpeg, .png, .jpg type, under 30MB, minimum width and height 320, aspect ratio 1:1')->withInput();
        } else {
            if ($request->image === null){
                $boardMember = new BoardMember([
                    'name' => $request->name,
                    'title' => $request->title,
                    'email' => $request->email,
                    'mobile_number' => $request->mobile_number,
                    'image' => $request->image,
                ]);
                $boardMember->save();
                return redirect()->back();
            } else {
                $boardMember = new BoardMember([
                    'name' => $request->name,
                    'title' => $request->title,
                    'email' => $request->email,
                    'mobile_number' => $request->mobile_number,
                    'image' => $request->image,
                ]);
                $boardMember->save();
                $boardMember->addMedia($request->image)
                    ->withResponsiveImages()
                    ->toMediaCollection('boardMembersImages');
                return redirect()->back();
            }

        }

    }
    public function boardManage(){
        $boardMembersNumber = BoardMember::all()->count();
        $members = [];

        for ($x = 0; $x <= $boardMembersNumber; $x++) {
            $member = BoardMember::find($x);
            if ($member != null){
                $memberImage = $member->getMedia('boardMembersImages');
                $member->image = $memberImage;
                array_push($members, $member);
            }
        }

        return view('admin.board.manage_board_members', compact('members'));
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

                    $boardMember = BoardMember::find($request->memberId);

                    $boardMember->name = $request->name;
                    $boardMember->title = $request->title;
                    $boardMember->email = $request->email;
                    $boardMember->mobile_number = $request->mobile_number;
                    $boardMember->image = $request->image;
                    $boardMember->update();

                    $boardMember->addMedia($request->image)
                        ->withResponsiveImages()
                        ->toMediaCollection('boardMembersImages');
                    return redirect()->back();
                }
            } else {

                $boardMember = BoardMember::find($request->memberId);

                $boardMember->name = $request->name;
                $boardMember->title = $request->title;
                $boardMember->email = $request->email;
                $boardMember->mobile_number = $request->mobile_number;
                $boardMember->image = $boardMember->image;
                $boardMember->update();

                return redirect()->back();
            }

        } else if ($request->deleteBtn != null) {
            $member = BoardMember::find($request->memberId);
            $member->delete();
            DB::table('board_members')->where('id', '=', $request->memberId)->delete();
            return redirect()->route('board_manage');
        }
    }
}
