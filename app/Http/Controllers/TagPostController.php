<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TagPost;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class TagPostController extends Controller
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
                $tag_id = $request->input('tag_id');
                $post_id = $request->input('post_id');

                $TagPost = new TagPost();
                $TagPost->user_id = $user->id;
                $TagPost->tag_id = $tag_id;
                $TagPost->post_id = $post_id;
                $TagPost->save();
        */
        auth()->user()->addTagPost(new TagPost($request->only(['post_id', 'tag_id', 'tag_value'])));
        return response()->json(['code' => '200', 'result' => 'true']);
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
     * @param TagPost $tagPost
     * @method put
     * @link localhost:8000/tagpost/{tagpost}
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TagPost $tagPost)
    {
        $user = auth()->user();
        if ($user->id == $tagPost->user_id) {
            $tagPost->update($request->only(['tag_id', 'tag_value']));
            return response()->json(['code' => '200', 'stats' => 'Your Tag for the post has been modified!']);
        }
        return response()->json(['code' => '403', 'stats' => 'it\'s not your post !!'], 403);
    }
    /**
     * Remove the TagPost from storage.
     *
     * @param  Request $request
     * @param TagPost $tagPost
     * @method delete
     * @link localhost:8000/tagpost/{tagpost}
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TagPost $tagPost)
    {
        $user = auth()->user();
        if ($user->id == $tagPost->user_id) {
            $tagPost->delete();
            return response()->json(['code' => '200', 'stats' => 'Your Tag for the post has been deleted!']);
        }
        return response()->json(['code' => '403', 'stats' => 'it\'s not your post !!'], 403);
    }
}
