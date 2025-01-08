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
        'name', 'email', 'password', 'phone', 'username',
    ];

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
        'email_verified_at'         => 'datetime',
        'subscription_expires_at'    => 'datetime',
        'sms_subscription_expires_at'    => 'datetime',
    ];

    public function subscription(){
        return $this->hasMany('App\Subscription', 'user_id')->where('subscription_type', 'predictions')->orderBy('created_at', 'DESC')->first();
    }

    public function sms_subscription(){
        return $this->hasMany('App\Subscription', 'user_id')->where('subscription_type', 'sms')->orderBy('created_at', 'DESC')->first();
    }

    public function subscription_active(){
        return $this->subscription_expires_at != null;
    }

    public function sms_subscription_active(){
        return $this->sms_subscription_expires_at != null;
    }

    public function is_admin(){
        return $this->user_type == 'ADMIN';
    }

    public function is_standard_user(){
        return $this->user_type == 'STANDARD';
    }

    public function is_analyst(){
        return $this->user_type == 'ANALYST';
    }
}
