<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.add', compact('users'));
    }

    public function create(Request $request)
    {

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // $users = User::all();
        // return response()->json(array('users' => $users), 200);
        return response()->json(array('user' => $user), 200);
    }

    public function create_test(Request $request)
    {
        dd($request->all());

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // $users = User::all();
        // return response()->json(array('users' => $users), 200);
        return response()->json(array('user' => $user), 200);
    }
}
