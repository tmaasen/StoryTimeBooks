<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use DB;


class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * 
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // get request will not display these columns in a table
        'password', 'email_verified_at', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getActiveUsers() {
        $users = DB::table('users')
        ->where('is_deleted', '=', 0)
        ->get();
        return $users;
    }

    public function remove($id) {

        $userID = User::findOrFail($id);

        DB::table('users')
        ->where('id', $id)
        ->update(['is_deleted' => 1]);

    }

}
