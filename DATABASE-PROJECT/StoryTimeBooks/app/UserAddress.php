<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'user_address';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address_line_1', 'suite_no', 'city', 'zipcode',
        'rowguid', 'home_phone', 'work_phone',
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

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
