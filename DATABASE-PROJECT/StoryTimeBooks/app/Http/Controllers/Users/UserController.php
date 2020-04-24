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
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function updateUser(Request $request)
    {
        if ($request->password != null) {
            DB::table('users')->where('id', $request->id)->update([
                
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => $request->role,
                'is_deleted' => $request->is_Deleted,
            ]);
        } else {
            DB::table('users')->where('id', $request->id)->update([
            
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
            ]);
         }

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
     * Get authenticated user's information.
     */
    public function userInfo(Request $request) {

        $userInfo = DB::table('users')
            ->join('user_address', 'users.id', '=', 'user_address.user_id')
            ->join('user_creditcard', 'users.id', '=', 'user_creditcard.user_id')
            ->select(
            // general info
            'users.id',
            'users.first_name',
            'users.last_name',
            'users.email',
            // address info
            'user_address.address_line_1',
            'user_address.suite_no',
            'user_address.city',
            'user_address.state_id',
            'user_address.zipcode',
            'user_address.home_phone',
            'user_address.work_phone',
            // financial info
            'user_creditcard.card_name',
            'user_creditcard.card_id',
            'user_creditcard.card_number',
            'user_creditcard.exp_month',
            'user_creditcard.exp_year',
            )
            ->where('users.id', $request->id)
            ->first();

         return response()->json([
            'status' => 'success',
            'user' => $userInfo
        ]);
    }
}