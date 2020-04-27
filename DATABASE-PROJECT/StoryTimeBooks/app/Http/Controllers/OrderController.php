<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use App\Publisher;
use App\ShoppingCart;
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
        $order->confirmation_number = str_random(15);
        $order->save();

        return response()->json(
            [
                'status' => 'success',
                'order' => $order,
            ], 200);
    }
    /**
     * Inserts a specifiec amount of order items into the order_item table.
     * 
     */
    public function insertOrderItem(Request $request)
    {
        $order_items = [];
        for($i= 0; $i < count($request->products); $i++){
        $order_items[] = [
            'user_order_id' => $request->user_id,
            'product_id' => $request->products->product_id,
            'quantity_ordered' => $request->products->quantity_ordered,
            'product_total' => $request->products->product_total,
            ];
        }
        
        DB::table('order_item')->insert($order_items);

        return response()->json(
            [
                'status' => 'success',
                'items' => $order_items,
            ], 200);
    }
}