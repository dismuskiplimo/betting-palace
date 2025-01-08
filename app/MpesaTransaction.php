<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MpesaTransaction extends Model
{
    protected $dates = ['created_at', 'updated_at', 'TransactionDate'];

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
