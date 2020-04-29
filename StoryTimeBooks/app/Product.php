<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{
    public $table = 'products';
    public $timestamps = false;

    protected $fillable = [

        'product_image', 'product_name', 'author', 'publisher_id', 'isbn_13', 'copyright_date', 'retail_price', 'company_cost', 'quantity_on_hand',
        'is_deleted'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // get request will not display these columns in a table
        'id'
    ];

    public static function remove($id) {

        DB::table('products')
        ->where('id', $id)
        ->update(['is_deleted' => 1]);

    }

    /**
     * Updates product's quantity after an order has been placed.
     */
    public static function updateProductQuantity($product_id, $quantityOrdered) {

        $quantityOnHand = DB::table('products')->select('quantity_on_hand')->where('id', $product_id)->value('id');

        DB::table('products')
        ->where('id', $product_id)
        ->update([
            'quantity_on_hand' => ((int)$quantityOnHand - (int)$quantityOrdered)
        ]);

    }   
}
