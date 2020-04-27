<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCreditCard extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'user_creditcard';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'card_number', 'exp_month' , 'exp_year',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}
