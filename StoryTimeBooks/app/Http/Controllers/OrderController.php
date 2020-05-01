<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use App\Publisher;
use App\ShoppingCart;
use App\Order;
use App\OrderItem;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Validator;
use Illuminate\Http\Request;


class OrderController extends Controller {

    /**
     * Inserts an order into the order table.
     * 
     */
    public function insertOrder(Request $request)
    {
        $v = Validator::make($request->all(), [
            'items_ordered' => 'required|integer',
            'subtotal' => 'required|numeric',
            'discount'  => 'required|numeric',
            'total' => 'required|numeric',
        ]);
        
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }

        $order = new Order();
        $order->user_id = $request->user_id;
        $order->items_ordered = $request->items_ordered;
        $order->subtotal = $request->subtotal;
        $order->discount = $request->discount;
        $order->total = $request->total;
        $order->confirmation_number = $request->confirmation_number;
        $order->save();

        $this->insertOrderItems($request);

        return response()->json(
            [
                'status' => 'success',
                'order' => $order,
            ], 200);
    }
    /**
     * Inserts a specific amount of order items into the order_item table.
     * 
     */
    public function insertOrderItems(Request $request)
    {
        $order_items = [];
        for($i= 0; $i < count($request->products); $i++){

            $orderitem = new OrderItem();
            $orderitem->user_order_id = $request->user_id;
            $orderitem->product_id = $request->products[$i]['product_id'];
            $orderitem->quantity_ordered = $request->products[$i]['quantity'];
            $orderitem->product_total = $request->product_total[$i];
            $orderitem->confirmation_number = $request->confirmation_number;
            $orderitem->save();
                
            Product::updateProductQuantity($request->products[$i]['product_id'], $request->products[$i]['quantity']); // ISSUES
        }

        ShoppingCart::clear($request->user_id);

        return response()->json(
            [
                'status' => 'success',
                'items' => $order_items,
            ], 200);
    }

    /**
     * Generates an order confirmation number.
     */
    // public function generateRandomString($length = 15) {
    //     $characters = '0123456789';
    //     $charactersLength = strlen($characters);
    //     $randomString = '';
    //     for ($i = 0; $i <= $length; $i++) {
    //         $randomString .= $characters[rand(0, $charactersLength - 1)];
    //     }
    //     return $randomString;
    // }

    /**
     * Provides a report of all users who have placed an order with StoryTime.
     * THIS IS AN ADMIN FUNCTION.
     */
    public function orderSummary() {
       // select first_name, last_name, items_ordered, subtotal, discount, total, orders.created_at from orders 
       // inner join users on orders.user_id = users.id;
      $results = DB::table('orders')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->select('first_name', 'last_name', 'items_ordered', 'subtotal', 'discount', 'total', 'orders.created_at')
        ->get();

    return response()->json(
        [
            'status' => 'success',
            'results' => $results
        ], 200);
    }
}