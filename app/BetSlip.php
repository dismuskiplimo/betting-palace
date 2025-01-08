<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BetSlip extends Model
{
    protected $dates = ['created_at', 'updated_at', 'starts_at'];

    public function bets(){
        return $this->hasMany('App\Grouping', 'bet_slip_id');
    }
}
