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
}
