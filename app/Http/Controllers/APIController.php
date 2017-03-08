<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UpdateAccount;

use App\user;
use JWTAuth;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;

class APIController extends Controller
{

    public function register(Request $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        User::create($input);
        return response()->json(['code' => '200', 'result' => true]);
    }

    public function login(Request $request)
    {
        $input = $request->all();
        if (!$token = JWTAuth::attempt($input)) {
            return response()->json(['code' => '403', 'result' => 'wrong email or password.']);
        }
        return response()->json(['result' => $token]);
    }

    public function get_user_details(Request $request)
    {
        $input = $request->all();
        $user = auth()->user();
        return response()->json(['code' => '200', 'result' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = auth()->user();
        $res = DB::table('users')
            ->where('id', $user->id)
            ->update($input);
        if ($res == 0) {
            return response()->json(['code' => '200', 'stats' => 'Your account has been updated!']);
        } else {
            return response()->json(['code' => '400', 'stats' => 'Token Invalide', 'res ', $res]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $user = auth()->user();
        $user = User::find($user->id);
        $user->forceDelete();
        //redirect()->route('register');
        return response()->json(['code' => '200', 'stats' => 'Your account has been deleted!']);
    }
}