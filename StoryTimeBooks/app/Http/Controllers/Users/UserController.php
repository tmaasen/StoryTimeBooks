<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\UserAddress;
use App\UserCreditCard;
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
        $user = null;
        if ($request->password != null) {
            $user = DB::table('users')->where('id', $request->id)->update([
                
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => $request->role,
                'is_deleted' => $request->is_Deleted,
            ]);
        } else {
            $user = DB::table('users')->where('id', $request->id)->update([
            
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
            ]);
         }

        if ($request->address_line_1 !== null) 
            $this->updateUserAddress($request);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Updated user info successfully',
                'user' => $user
            ], 200);
    }

    /**
     * Add the specified address in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function addUserAddress(Request $request)
    {
            $shipping = new UserAddress();
            $shipping->user_id = $request->id;
            $shipping->address_type_id = 1;
            $shipping->address_line_1 = $request->address_line_1;
            $shipping->suite_no = $request->suite_no;
            $shipping->city = $request->city;
            $shipping->state_id = $request->state_id;
            $shipping->zipcode = $request->zipcode;
            $shipping->save();

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Added user address successfully',
                'address' => $shipping
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
        if (DB::table('user_address')->where('user_id', $request->id)->where('address_type_id', 1)->exists()) {
            $address = DB::table('user_address')->where('user_id', $request->id)->where('address_type_id', 1)->update([
                
                'address_line_1' => $request->address_line_1,
                'suite_no' => $request->suite_no,
                'city' => $request->city,
                'state_id' => $request->state_id,
                'zipcode' => $request->zipcode,
                'home_phone' => $request->home_phone,
                'work_phone' => $request->work_phone,

            ]);
        } else {
            $this->addUserAddress($request);
        }

        if ($request->card_type !== null) 
            $this->updatePaymentMethod($request);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Updated user address info successfully',
                'address' => $address
            ], 200);
    }

    /**
     * Update the specified user billing address in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function updateBillingAddress(Request $request)
    {
        if (DB::table('user_address')->where('user_id', $request->id)->where('address_type_id', 2)->exists()) {

            $address = DB::table('user_address')->where('user_id', $request->id)->where('address_type_id', 2)->update([
                
                'address_line_1' => $request->billing_address,
                'suite_no' => $request->billing_suite_no,
                'city' => $request->billing_city,
                'state_id' => $request->billing_state,
                'zipcode' => $request->billing_zip,

            ]);
        } else {
            $this->addBillingAddress($request);
        }

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Updated user billing address info successfully',
                'address' => $address
            ], 200);
    }

    /**
     * Add the specified billing address in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function addBillingAddress(Request $request)
    {
            $billing = new UserAddress();
            $billing->user_id = $request->id;
            $billing->address_type_id = 2;
            $billing->address_line_1 = $request->billing_address;
            $billing->suite_no = $request->billing_suite_no;
            $billing->city = $request->billing_city;
            $billing->state_id = $request->billing_state;
            $billing->zipcode = $request->billing_zip;
            $billing->save();

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Added billing address successfully',
                'address' => $billing
            ], 200);
    }
    
    /**
     * Add a payment method under the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function addPaymentMethod(Request $request)
    {
        $card = new UserCreditCard();
        $card->user_id = $request->id;
        $card->card_id = $request->card_type;
        $card->card_name = $request->card_name;
        $card->card_number = encrypt($request->card_number);
        $card->exp_month = $request->exp_month;
        $card->exp_year = $request->exp_year;
        $card->save();

        return response()->json([
            'status' => 'success',
            'card' => $card
        ], 200);
    }

    /**
     * Update the specified user payment method in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function updatePaymentMethod(Request $request)
    {
        $cardInfo = null;
        if (DB::table('user_creditcard')->where('user_id', $request->id)->exists()) {
            $cardInfo = DB::table('user_creditcard')->where('user_id', $request->id)->update([
                
                'card_name' => $request->card_name,
                'card_id' => $request->card_type,
                'card_number' => encrypt($request->card_number),
                'exp_month' => $request->exp_month,
                'exp_year' => $request->exp_year,

            ]);

        } else {
            $this->addPaymentMethod($request);
        }

        if ($request->billing_address !== null) 
            $this->updateBillingAddress($request);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Updated user card info successfully',
                'credit card' => $cardInfo
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
    public function allUserInfo(Request $request) {
        $shippingInfo = null;
        $cardInfo = null;
        $billingAddress = null;
        $userInfo = DB::table('users')
            ->select(
            'users.id',
            'users.first_name',
            'users.last_name',
            'users.email',
            )
            ->where('users.id', $request->id)
            ->first();

        if (DB::table('user_address')->where('user_id', $request->id)
            ->where('user_address.address_type_id', 1)->exists()) {
            $shippingInfo = DB::table('user_address')
            ->join('states', 'states.id', '=', 'user_address.state_id')
                ->select(
                    'user_address.address_type_id',
                    'user_address.address_line_1',
                    'user_address.suite_no',
                    'user_address.city',
                    'user_address.state_id',
                    'state',
                    'user_address.zipcode',
                    'user_address.home_phone',
                    'user_address.work_phone',
                )
                ->where('user_id', $request->id)
                ->where('user_address.address_type_id', 1)
                ->first();
        }

        if (DB::table('user_creditcard')->where('user_id', $request->id)->exists()) {
            $cardInfo = DB::table('user_creditcard')
                ->select(
                    'user_creditcard.card_name',
                    'user_creditcard.card_id',
                    'user_creditcard.exp_month',
                    'user_creditcard.exp_year',
                )
                ->where('user_id', $request->id)
                ->first();
            $cardNumber = DB::table('user_creditcard')->select('card_number')->where('user_id', $request->id)->value('card_number');
            $cardNumber=\decrypt($cardNumber);
        }

        if (DB::table('user_address')
            ->where('user_id', $request->id)
            ->where('user_address.address_type_id', 2)
            ->exists()) {
            $billingAddress = DB::table('user_address')
            ->join('states', 'states.id', '=', 'user_address.state_id')
                ->select(
                    'user_address.address_type_id',
                    'user_address.address_line_1',
                    'user_address.suite_no',
                    'user_address.city',
                    'user_address.state_id',
                    'state',
                    'user_address.zipcode'
                )->where('user_id', $request->id)
                ->where('user_address.address_type_id', 2)
                ->first();
        }

         return response()->json([
            'status' => 'success',
            'user' => $userInfo,
            'shipping' => $shippingInfo,
            'card' => $cardInfo,
            'decoded_card_number' => $cardNumber,
            'billing' => $billingAddress
        ]);
    }

    /**
     * Provides a report of all users by state.
     * THIS IS AN ADMIN FUNCTION.
     */
    public function customersByState() {
        //         select first_name, last_name, state, address_type.name from users
        //         inner join user_address on user_address.user_id = users.id
        //         inner join states on states.id = user_address.state_id
        //         inner join address_type on address_type.id = user_address.address_type_id
        //         order by state;
        $results = DB::table('users')
            ->join('user_address', 'users.id', '=', 'user_address.user_id')
            ->join('states', 'states.id', '=', 'user_address.state_id')
            ->join('address_type', 'address_type.id', '=', 'user_address.address_type_id')
            ->select('first_name', 'last_name', 'state', 'address_type.name')
            ->orderBy('state')
            ->get();
            
        return response()->json(
            [
                'status' => 'success',
                'results' => $results
            ], 200);
    }
}