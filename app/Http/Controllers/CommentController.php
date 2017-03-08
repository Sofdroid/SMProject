<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
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
        /*  $input = $request->all();
            $user = auth()->user();

            $body = $request->input('body');
            $post_id = $request->input('post_id');

            $Comment = new Comment();
            $Comment->user_id = $user->id;
            $Comment->post_id = $post_id;
            $Comment->body = $body;
            $Comment->save();
        */
        auth()->user()->addComment(new Comment($request->only(['post_id', 'body'])));
        return response()->json(['code' => '200', 'result' => 'true']);
    }

    /**
     * get_nbr_comments_by_post
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function get_nbr_comments_by_post(Request $request)
    {
        $post_id = $request->input('post_id');

        $nbrComments = DB::select('select post_id from comments where post_id = ?', [$post_id]);

        return response()->json(['code' => '200', 'result' => count($nbrComments)]);
    }

    /**
     * get_users_comments_by_post
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function get_users_comments_by_post(Request $request)
    {
        $post_id = $request->input('post_id');

        $usersmane = DB::select('select users.name , comments.body from comments , users where comments.user_id = users.id and post_id = ?', [$post_id]);

        return response()->json(['code' => '200', 'result' => $usersmane]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
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
     * @param Comment $comment
     * @method put
     * @link localhost:8000/comment/{comment}
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $user = auth()->user();
        if ($user->id == $comment->user_id) {
            $comment->update($request->only(['body']));
            return response()->json(['code' => '200', 'stats' => 'Your comment has been modified!']);
        }
        return response()->json(['code' => '403', 'stats' => 'it\'s not your comment !!'], 403);
    }
    /**
     * Remove the comment from storage.
     *
     * @param  Request $request
     * @param Comment $comment
     * @method delete
     * @link localhost:8000/comment/{comment}
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Comment $comment)
    {
        $user = auth()->user();
        if ($user->id == $comment->user_id) {
            $comment->delete();
            return response()->json(['code' => '200', 'stats' => 'Your post has been deleted!']);
        }
        return response()->json(['code' => '403', 'stats' => 'it\'s not your post !!'], 403);
    }
}
