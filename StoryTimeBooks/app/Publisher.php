<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    public $table = 'publishers';
    public $timestamps = false;

    protected $fillable = [
        'publisher_name', 'address', 'city', 'state_id', 'zipcode', 'phone'
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
