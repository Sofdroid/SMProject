<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO:
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
                $value = $request->input('value');

                $Tag = new Tag();
                $Tag->user_id = $user->id;
                $Tag->value = $value;
                $Tag->save();
        */
        auth()->user()->addTag(new Tag($request->only(['value'])));
        return response()->json(['code' => '200', 'result' => 'true']);
    }

    /**
     * get_all_tags
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function get_all_tags()
    {

        $tags = DB::select('select * from tags ');

        return response()->json(['code' => '200', 'result' => $tags]);
    }

    /**
     * get_tags_by_post
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function get_tags_by_post(Request $request)
    {
        $post_id = $request->input('idpost');

        $nbrLike = DB::select('select * from tag_posts where post_id = ?', [$post_id]);

        return response()->json(['code' => '200', 'result' => count($nbrLike)]);
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //no update for tag
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // no delete for tag
    }
}
