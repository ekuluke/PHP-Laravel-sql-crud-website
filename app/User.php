<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    function reviews() {
        return $this->hasMany('App\Review');
    }
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // can insert any value.
    protected $guarded = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function isAdmin() { // allows for admin function
        return $this->type === 'adminstrator';
    }

    function isCurator() { // allows for curator functions
        if($this->type === 'curator' && $this->status === 'approved') {
            return true;
        }
        elseif($this->type === 'adminstrator'){
            return true;
        }        
        else {
            return false;
        }
    }

    function isMember(){ // enables member functions
        return $this->type === 'member';
    }

    
}
