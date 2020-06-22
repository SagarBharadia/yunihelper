<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password', 'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function notes() {
         return $this->hasMany(Note::class);
    }
    public function assignments() {
        return $this->hasMany(Assignment::class);
    }   
    public function finances() {
        return $this->hasMany(Finance::class);
    }
    public function todos() {
        return $this->hasMany(ToDo::class);
    }
}
