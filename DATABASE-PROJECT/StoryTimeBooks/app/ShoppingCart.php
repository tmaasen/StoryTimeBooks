<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
