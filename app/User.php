<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isRole(){
        return $this->role; // mysql table column
    }
    /**
     * The orders that belong to the user.
     */
   /* public function orders()
    {
        return $this->hasMany('App\Order')->withTimestamps();
    }*/
    public function orders(){
      return $this->hasMany(Order::class);
    }
        public function review()
    {
        return $this->hasOne(ProductReview::class);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
