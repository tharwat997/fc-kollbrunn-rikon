<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    public function index(){
        $postsUnformatted = Post::orderBy('created_at', 'desc')->paginate();
        $posts = [];

        foreach ($postsUnformatted as $post){
            $post = Post::find($post->id);
            $post->image =  $post->getMedia('postsImages');

            array_push($posts, $post);
        }

        return view('news', compact('posts'));
    }

    public function show($id){

        $post = Post::find($id);
        $author = User::find($post->author_id);
        $post->image = $post->getMedia('postsImages');
        $post->author_id = $author->name;

        return view('news_detail', compact('post'));
    }

    public function postCreate(){
        return view('admin.news.create_post', compact('post'));
    }
    public function store(Request $request){

        $user = Auth::user();

        $validator = Validator::make($request->all(),[
            "image" => "required|image|mimes:jpeg,png,jpg|dimensions:ratio=4/3,min_width=500,min_height=500",
        ]);

        if($validator->fails()){
            return redirect()->back()->with('message', 'Image needs to be 4:3 aspect ratio and Min 500 width and height. Example: 666x500')->withInput();
        } else {
            if ($request->image === null){

                $detail = $request->description;

                $dom = new \domdocument();
                $dom->loadHtml('<?xml encoding="utf-8" ?>'. $detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                $detail = $dom->savehtml();

                $summernote = new Post();
                $summernote->author_id = $user->id;
                $summernote->body = $detail;
                $summernote->title = $request->title;
                $summernote->save();

            } else {

                $detail = $request->description;

                $dom = new \domdocument();
                $dom->loadHtml('<?xml encoding="utf-8" ?>'. $detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                $detail = $dom->savehtml();

                $summernote = new Post();
                $summernote->author_id = $user->id;
                $summernote->body = $detail;
                $summernote->title = $request->title;
                $summernote->image = $request->image;
                $summernote->save();

                $summernote->addMedia($request->image)
                    ->withResponsiveImages()
                    ->toMediaCollection('postsImages');
            }

            return redirect()->back();
        }

    }
    public function postManage(){
        $postsUnformatted = Post::all();
        $posts = [];

        foreach ($postsUnformatted as $post){
            $author = User::find($post->author_id);
            $post->author_id = $author->name;
            array_push($posts, $post);
        }

        return view('admin.news.manage_posts', compact('posts'));
    }
    public function postManageShow($id){
        $post = Post::find($id);
        $authors = User::all();

        return view('admin.news.manage_post_detail', compact('post', 'authors'));
    }
    public function update(Request $request){

        if ($request->btnUpdate != null){

            if ($request->image != null){

                $validator = Validator::make($request->all(),[
                    "image" => "required|image|mimes:jpeg,png,jpg|dimensions:ratio=4/3,min_width=500,min_height=500",
                ]);

                if($validator->fails()){
                    return redirect()->back()->with('message', 'Image needs to be 4:3 aspect ratio and Min 500 width and height. Example: 666x500');
                } else {

                    $detail = $request->description;

                    $dom = new \domdocument();
                    libxml_use_internal_errors(true);
                    $dom->loadHtml('<?xml encoding="utf-8" ?>'. $detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                    $detail = $dom->savehtml();

                    $post = Post::find($request->postId);
                    $post->author_id = $request->author;
                    $post->body = $detail;
                    $post->title = $request->title;
                    $post->image = $request->image;
                    $post->save();

                    $post->addMedia($request->image)
                        ->withResponsiveImages()
                        ->toMediaCollection('postsImages');

                    return redirect()->back();
                }
            } else {

                $detail = $request->description;
                libxml_use_internal_errors(true);
                $dom = new \domdocument();
                $dom->loadHtml('<?xml encoding="utf-8" ?>'. $detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                $detail = $dom->savehtml();

                $post = Post::find($request->postId);
                $post->author_id = $request->author;
                $post->body = $detail;
                $post->title = $request->title;
                $post->image =  $post->image;
                $post->save();

                return redirect()->back();
            }

        } else if ($request->btnDelete != null) {
            $post = Post::find($request->postId);
            $post->delete();
            DB::table('posts')->where('id', '=', $request->postId)->delete();
            return redirect()->route('posts_manage');
        }
    }

}
