<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FourtuneTokenTransfer extends Model{
    protected $table = 'fourtune_token_transfer';
    protected $fillable = ['from_user_id', 'to_user_id','amount','totals_from','totals_to','created_at'];
}
