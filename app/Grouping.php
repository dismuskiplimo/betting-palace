<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grouping extends Model
{
    public function bet(){
        return $this->belongsTo('App\Bet', 'bet_id');
    }
}
