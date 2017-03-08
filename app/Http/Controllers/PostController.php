<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use JWTAuth;
use Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        $input = $request->all();
        $user = auth()->user();
        //return response()->json($user);
        $title = $request->input('title');
        $body = $request->input('body');

        $Post = new Post();
        $Post->user_id = $user->id;
        $Post->title = $title;
        $Post->body = $body;
        $Post->save();
        */
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|min:5',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => '400', 'result' => 'required error']);
        }
        auth()->user()->publish(new Post($request->only(['title', 'body'])));
        return response()->json(['code' => '200', 'result' => 'true']);
    }

    /**
     * get_posts_by_user
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function get_posts_by_user(Request $request)
    {
        /*
        $input = $request->all();
        $user = auth()->user();
        $posts = DB::select('select * from posts where user_id = ?', [$user->id]);
        */
        $posts = auth()->user()->post()->get();
        return response()->json(['code' => '200', 'result' => $posts]);
    }

    /**
     * get_posts_by_following
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function get_posts_by_following(Request $request)
    {
        $input = $request->all();
        $user = auth()->user();
        $posts = DB::select('select * from posts , follows where follows.idfollowing = posts.user_id  and follows.user_id = ?', [$user->id]);
        //,' or posts.user_id = ? ', [$user->id]
        return response()->json(['code' => '200', 'result' => $posts]);
    }

    /**
     * Display the specified resource.
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $user = auth()->user();
        if ($user->id == $post->user_id) {
            $post->update($request->only(['title', 'body']));
            return response()->json(['code' => '200', 'stats' => 'Your post has been modified!']);
        }
        return response()->json(['code' => '403', 'stats' => 'it\'s not your post !!'], 403);
    }
    /**
     * Remove the post from storage.
     *
     * @param  Request $request
     * @param Post $post
     * @method delete
     * @link localhost:8000/post/{post}
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $post)
    {
        $user = auth()->user();
        if ($user->id == $post->user_id) {
            $post->delete();
            return response()->json(['code' => '200', 'stats' => 'Your post has been deleted!']);
        }
        return response()->json(['code' => '403', 'stats' => 'it\'s not your post !!'], 403);
    }
}
