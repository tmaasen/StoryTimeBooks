<?php

namespace App\Models;

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
        'CardType', 'CardNumberHash', 'ExpMonth' , 'ExpYear',
    ];
     /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'CardID';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    const CreatedAt = 'creation_date';
    const UpdatedAt = 'last_update';
}
