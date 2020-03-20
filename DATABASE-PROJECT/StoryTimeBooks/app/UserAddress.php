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
        'AddressLine1', 'SuiteNo', 'City',
        'RowGuid', 'HomePhone', 'WorkPhone',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'AddressID';
}
