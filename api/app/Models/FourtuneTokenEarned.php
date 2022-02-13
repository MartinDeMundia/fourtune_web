<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FourtuneTokenEarned extends Model{
    protected $table = 'fourtune_token_coins_earned';
    protected $fillable = ['user_id', 'coins_earned','game','created_at','level'];
}
