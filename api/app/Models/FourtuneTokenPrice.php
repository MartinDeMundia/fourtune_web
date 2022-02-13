<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FourtuneTokenPrice extends Model{
    protected $table = 'fourtune_token_price';
    protected $fillable = ['game', 'token_qty','price','user_id','level','created_at'];
}
