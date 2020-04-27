<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;

class ShoppingCart extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'customer_shopping_cart';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Removes record from cart.
     */
    public static function remove($user_id, $product_id) {

        DB::table('customer_shopping_cart')
        ->where('user_id', $user_id)
        ->where('product_id', $product_id)
        ->delete();

    }

    /**
     * Updates cart quantity.
     */
    public static function updateCartQuantity($product_id, $user_id, $quantity) {

            DB::table('customer_shopping_cart')
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->update([
                'quantity' => $quantity
            ]);

    }

    /**
     * Checks if book is already in user's cart. If so, then increases quantity.
     */
    public static function checkIfBookExistsInCart($product_id, $user_id, $quantity) {

        $item = DB::table('customer_shopping_cart')
            ->where('user_id', $user_id)
            ->where('product_id', $product_id);

        if ($item->exists()) {
            $updatedItem = $item->increment('quantity');
            return $item->get();

        } else {
            return false;
        }
    }
}
