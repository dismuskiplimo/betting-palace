<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $dates = ['created_at', 'updated_at', 'ends_at', 'starts_at', 'completed_at'];

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
