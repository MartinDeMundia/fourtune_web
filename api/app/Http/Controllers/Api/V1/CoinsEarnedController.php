<?php

namespace App\Http\Controllers\Api\V1;

use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;
use CloudCreativity\LaravelJsonApi\Document\Error;
use CloudCreativity\LaravelJsonApi\Http\Controllers\JsonApiController;
use CloudCreativity\LaravelJsonApi\Contracts\Decoder\DecoderInterface;
use App\Models\FourtuneTokenEarned;
use Illuminate\Support\Facades\DB;

class CoinsEarnedController extends JsonApiController 
{   
    
    public function getCoinsEarned(Request $request){     
        $dBData = DB::connection('mysql')->select( DB::raw("
            SELECT 
                u.name,
                u.email,
                u.phone,
                fe.created_at,
                fe.coins_earned,
                fe.game,
                fe.level
            FROM
                fourtune_token_coins_earned fe
                    JOIN
                users u ON u.id = fe.user_id;
            "));       
        return response(array("coinsearned"=>$dBData))->header('Content-Type', 'application/json');
    }   

    
}
