<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'users';
     /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'CustID';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    const CreatedAt = 'creation_date';
    const UpdatedAt = 'last_update';

}
