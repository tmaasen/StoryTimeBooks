<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\UserAddress;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function updateUser(Request $request)
    {

        DB::table('users')->where('id', $request->id)->update([
            
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
       
        ]);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Updated user info successfully'
            ], 200);
    }

    /**
     * Update the specified user address in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function updateUserAddress(Request $request)
    {
        DB::table('user_address')->where('user_id', $request->user_id)->update([
            
            'address_line_1' => $request->address_line_1,
            'suite_no' => $request->suite_no,
            'city' => $request->city,
            'state_id' => $request->state_id,
            'zipcode' => $request->zipcode,
            'home_phone' => $request->home_phone,
            'work_phone' => $request->work_phone,

        ]);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Updated user address info successfully'
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeUser(Request $request)
    {
        User::remove($request->id);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'User Removed'
            ], 200);
    }

    /**
     * Get authenticated user's address
     */
    public function userAddress(Request $request) {

        //$address = UserAddress::getUserAddress($request->id);
        $address = DB::table('user_address')->where('user_id', $request->id)->first();
        
         return response()->json([
            'status' => 'success',
            'address' => $address
        ]);
    }
}