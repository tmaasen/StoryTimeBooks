<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Order extends Model
{
    public $table = 'orders';
    public $timestamps = true;

    protected $fillable = [

        'items_ordered', 'subtotal', 'discount', 'total'
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
