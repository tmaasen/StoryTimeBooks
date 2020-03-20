<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'state';
     
     /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'StateID';
}
