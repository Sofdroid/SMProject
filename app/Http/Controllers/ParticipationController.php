<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Participation;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;

class ParticipationController extends Controller
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
        auth()->user()->addParticipation(new Participation($request->only(['event_id'])));
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
     * Update the Participation resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // No update in participation
    }

    /**
     * Remove the Participation resource from storage.
     *
     * @param  Request $request
     * @param Participation $participation
     * @method delete
     * @link localhost:8000/participation/{participation}
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Participation $participation)
    {
        $user = auth()->user();
        if ($user->id == $participation->user_id) {
            $participation->delete();
            return response()->json(['code' => '200', 'stats' => 'Your participation has been deleted !']);
        }
        return response()->json(['code' => '403', 'stats' => 'it\'s not your participation !!'], 403);
    }
}