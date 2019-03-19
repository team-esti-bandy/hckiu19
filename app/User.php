<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','lastname','role_id','email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function moocs()
    {
        return $this->hasMany('App\Mooc');
    }

    public function isStudent()
    {
        return $this->role->name === 'student';
    }
    public function isContrib()
    {
        return $this->role->name === 'contrib';
    }
    public function files()
    {
        return $this->belongsToMany('App\File')->using('App\FileUser');
    }
}
