<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use JWTAuth;
use Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;


class EventController extends Controller
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
        $validator = Validator::make($request->only(['title', 'body', 'date', 'location']), [
            'title' => 'required',
            'body' => 'required',
            'date' => 'required',
            'location' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['code' => '400', 'result' => 'required error']);
        }
        auth()->user()->addEvent(new Event($request->only(['title', 'body', 'date', 'location'])));
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
     * @param Request $request
     * @param  Event $event
     * @method put
     * @link localhost:8000/event/{event}
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $user = auth()->user();
        if ($user->id == $event->user_id) {
            $event->update($request->only(['title', 'body', 'date', 'location']));
            return response()->json(['code' => '200', 'stats' => 'Your event has been modified!']);
        }
        return response()->json(['code' => '403', 'stats' => 'it\'s not your event !!'], 403);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Request $request
     * @param  Event $event
     * @method delete
     * @link localhost:8000/event/{event}
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Event $event)
    {
        $user = auth()->user();
        if ($user->id == $event->user_id) {
            $event->delete();
            return response()->json(['code' => '200', 'stats' => 'Your event has been deleted!']);
        }
        return response()->json(['code' => '403', 'stats' => 'it\'s not your event !!'], 403);
    }

}
