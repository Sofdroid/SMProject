<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follow;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
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
    {/*
                $input = $request->all();
                $user = auth()->user();
                $idfollowing = $request->input('idfollowing');
                $Follow = new Follow();
                $Follow->user_id = $user->id;
                $Follow->idfollowing = $idfollowing;
                $Follow->save();
        */
        auth()->user()->addfollow(new Follow($request->only(['idfollowing'])));
        return response()->json(['code' => '200', 'result' => 'true']);
    }

    /**
     * Get following by User
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function get_following_by_user(Request $request)
    {
        $input = $request->all();
        $user = auth()->user();

        $follows = DB::select('select * from users , follows where users.id = follows.idfollowing and  follows.user_id = ?', [$user->id]);
        return response()->json(['code' => '200', 'result' => $follows]);
    }

    /**
     * Get follower by User
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function get_follower_by_user(Request $request)
    {
        $input = $request->all();
        $user = auth()->user();

        $follows = DB::select('select * from users , follows where users.id = follows.idfollower and  follows.idfollowing = ?', [$user->id]);
        return response()->json(['code' => '200', 'result' => $follows]);
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
        // No update in follow ;)
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     * @param Follow $follow
     * @method delete
     * @link localhost:8000/follow/{follow}
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Follow $follow)
    {
        $user = auth()->user();
        if ($user->id == $follow->user_id) {
            $follow->delete();
            return response()->json(['code' => '200', 'stats' => 'Your follow has been deleted!']);
        }
        return response()->json(['code' => '403', 'stats' => 'it\'s not your follow !!'], 403);
    }
}