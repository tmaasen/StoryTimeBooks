<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class OrderItem extends Model
{
    public $table = 'order_item';
    public $timestamps = true;

    protected $fillable = [

        'user_id', 'product_id','quantity_ordered', 'product_total', 
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
}
