<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    /**
     * Show the name for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {
        return view('welcome', ['user' => User::findOrFail($id)]);
    }
    /**
     * Returns ALL users. THIS WILL BE AN ADMIN FUNCTION
     */
    public function allUsers()
    {
        $users = User::all();
        return response()->json(
            [
                'status' => 'success',
                'users' => $users
            ], 200);
    }
}