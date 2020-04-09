<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\UserAddress;
use App\User;
use DB;
use Request;

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
     * Returns ALL users. THIS IS AN ADMIN FUNCTION
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

    /**
     * Returns ALL user addresses. THIS IS AN ADMIN FUNCTION
     */
    public function userAddress()
    {
        $userAddresses = UserAddress::all();
        return response()->json(
            [
                'status' => 'success',
                'users' => $userAddresses
            ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);

        $this->validate($request,[
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'sometimes',
            'role' => 'sometimes',
            'is_deleted' => 'sometimes'
        ]);

        $user->update($request->all());
        return ['message' => 'Updated the user info'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeUser($id)
    {

        //$this->authorize('isAdmin');

        $user = new User();
        $user->remove($id);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'User Removed' // calling method from model to get all active users
            ], 200);
    }

}