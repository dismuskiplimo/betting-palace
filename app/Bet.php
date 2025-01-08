<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    protected $dates = ['created_at', 'updated_at', 'ends_at', 'starts_at'];

    public function groups(){
        return $this->hasMany('App\Grouping', 'bet_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
