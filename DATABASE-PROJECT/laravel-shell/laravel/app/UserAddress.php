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
        'address_line_1', 'suite_no', 'city',
        'rowguid', 'home_phone', 'work_phone',
    ];
}
