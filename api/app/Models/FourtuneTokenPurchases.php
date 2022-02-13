<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FourtuneTokenPurchases extends Model{
    protected $table = 'fourtune_token_purchases';
    protected $fillable = ['user_id', 'purchase_date','token_amount','created_at'];
}
