<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;
class LikeController extends Controller
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

                $post_id = $request->input('idpost');

                $Like = new Like();
                $Like->user_id = $user->id;
                $Like->post_id = $post_id;
                $Like->save();
        */
        auth()->user()->addLike(new Like($request->only(['post_id'])));
        return response()->json(['code' => '200', 'result' => 'true']);
    }

    /**
     * get_nbr_like_by_comments
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function get_nbr_like_by_post(Request $request)
    {
        $post_id = $request->input('post_id');

        $nbrLike = DB::select('select post_id from likes where post_id = ?', [$post_id]);

        //  $nbrLike = auth()->user()->post()->like($request->only(['post_id']))->get();
        return response()->json(['code' => '200', 'result' => count($nbrLike)]);
    }
    /**
     * get_users_like_by_post
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function get_users_like_by_post(Request $request)
    {
        $post_id = $request->input('post_id');

        $iduser = DB::select('select users.name from likes, users where likes.user_id = users.id and post_id = ?', [$post_id]);

        return response()->json(['code' => '200', 'result' => $iduser]);
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
        // no update in like ;)
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     * @param Like $like
     * @method delete
     * @link localhost:8000/like/{like}
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Like $like)
    {
        $user = auth()->user();
        if ($user->id == $like->user_id) {
            $like->delete();
            return response()->json(['code' => '200', 'stats' => 'Your like has been deleted!']);
        }
        return response()->json(['code' => '403', 'stats' => 'it\'s not your like !!'], 403);
    }
}
