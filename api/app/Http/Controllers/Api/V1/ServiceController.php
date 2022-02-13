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
use App\Models\FourtuneTokenPurchases;
use App\Models\FourtuneTokenTransfer;
use Illuminate\Support\Facades\DB;

class ServiceController extends JsonApiController 
{
    
    public function getCoinsEarned(Request $request){ 
        $userid = $request->userid;
        $dBData = DB::connection('mysql')->select( DB::raw("
        SELECT 
            u.name,
            u.email,
            u.phone,
            fe.created_at,
            fe.coins_earned,
            fe.game,
            fe.level,
            fe.id
        FROM
            fourtune_token_coins_earned fe
                JOIN
            users u ON u.id = fe.user_id
            WHERE u.id = '".$userid."'
            ;
        "));  
        $coinsearned = array();
        foreach ($dBData as $key =>$coindata){
            $coinsearned[] = array("id"=>$coindata->id,"date"=>$coindata->created_at,"game"=>$coindata->game,"level"=>$coindata->level,"coins"=>$coindata->coins_earned); 
        }           
        $dbdata["coinsdata"] = array("coinsearned"=>$coinsearned,"totalcoins"=>200);
        $responseBody = array("data"=>$dbdata);
        return response($responseBody)->header('Content-Type', 'application/json');
    }

    public function purchaseToken(Request $request){
        $issuccess = false;
        $message = "Error!";
        $tokenSaved = 0;
        $account_notification = "";
        $tokenqty = $request->tokenqty;
        $userid = $request->userid;
        $dbData = DB::connection('mysql')->select( DB::raw("
           SELECT * FROM users WHERE  id = '".$userid."'
       "));   
       if(count($dbData)){  
            $tokenSaved = $dbData[0]->fourtune_coins + $tokenqty ; 
            if($tokenqty > 0){
                $tokenDataDB = FourtuneTokenPurchases::create([
                    'user_id' => $userid,
                    'purchase_date' =>date('Y-m-d H:i:s'),
                    'token_amount' =>$tokenqty,                 
                    'created_at' =>date('Y-m-d H:i:s')
                ]);
            }           
            DB::connection('mysql')->select( DB::raw("UPDATE users SET fourtune_coins='".$tokenSaved."' WHERE id = '".$userid."'")); 
            $message = "Updated your Fourtune Coins! Total :".$tokenSaved;
            $account_notification = "Your account is as below, date ". date('Y-m-d H:i:s');
            $issuccess = true;            
       }else{
        $message = "User does not exist!";
       }
       $responseBody = array("message"=>$message,"success"=>$issuccess,"totalcoins"=>$tokenSaved,"account_notification"=>$account_notification);        
       return response($responseBody)->header('Content-Type', 'application/json');
    }


    public function gamerProfile(Request $request){
        $issuccess = false;
        $message = "Error!";
        $account_notification = "";
        $tokenSaved = 0;       
        $userid = $request->userid;
        $dbData = DB::connection('mysql')->select( DB::raw("
           SELECT * FROM users WHERE  id = '".$userid."'
       "));   
       if(count($dbData)){  
            $tokenCoins = $dbData[0]->fourtune_coins; 
            $message = "Fetched Gamer details!";
            $issuccess = true; 
            $account_notification = "Your account is as below, date ". date('Y-m-d H:i:s');           
       }else{
        $message = "User does not exist!";
       }
       //fetch token purchased

      $dbDataToken = DB::connection('mysql')->select( DB::raw("
            SELECT 
            yearmonths.month,
            CASE
                WHEN yearmonths.month = 1 THEN 'Jan'
                WHEN yearmonths.month = 2 THEN 'Feb'
                WHEN yearmonths.month = 3 THEN 'Mar'
                WHEN yearmonths.month = 4 THEN 'Apr'
                WHEN yearmonths.month = 5 THEN 'May'
                WHEN yearmonths.month = 6 THEN 'Jun'
                WHEN yearmonths.month = 7 THEN 'Jul'
                WHEN yearmonths.month = 8 THEN 'Aug'
                WHEN yearmonths.month = 9 THEN 'Sep'
                WHEN yearmonths.month = 10 THEN 'Oct'
                WHEN yearmonths.month = 11 THEN 'Nov'
                WHEN yearmonths.month = 12 THEN 'Dec'
                ELSE ''
            END monthname,
            IFNULL(REPLACE(FORMAT(SUM(ftp.token_amount),0),',',''), 0 ) amount,
            u.name
        FROM
            (SELECT 1 AS MONTH UNION SELECT 2 AS MONTH UNION SELECT 3 AS MONTH UNION SELECT 4 AS MONTH UNION SELECT 5 AS MONTH UNION SELECT 6 AS MONTH UNION SELECT 7 AS MONTH UNION SELECT 8 AS MONTH UNION SELECT 9 AS MONTH UNION SELECT 10 AS MONTH UNION SELECT 11 AS MONTH UNION SELECT 12 AS MONTH) AS yearmonths
                LEFT JOIN
            fourtune_token_purchases ftp ON yearmonths.month = MONTH(ftp.purchase_date) AND ftp.user_id = '".$userid."'
                LEFT JOIN
            users u ON u.id = ftp.user_id AND u.id = '".$userid."'
        GROUP BY yearmonths.month
        ")); 



       $responseBody = array("message"=>$message,"success"=>$issuccess,"totalcoins"=>$tokenCoins,"account_notification"=>$account_notification,"token_purchases"=>$dbDataToken);        
       return response($responseBody)->header('Content-Type', 'application/json');
    }


    public function transferToken(Request $request){
        $message = "Error!";
        $issuccess = false;
        $newUserRemainingtoken = 0;
        $account_notification = "";
        $userid = $request->userid;
        $phone = $request->phone;
        $amount = $request->amount;

        $dbData = DB::connection('mysql')->select( DB::raw("
          SELECT * FROM users WHERE  phone = '".$phone."'
        ")); 
        if(count($dbData)){ 
            $dbDataUser = DB::connection('mysql')->select( DB::raw("
              SELECT * FROM users WHERE  id = '".$userid."'
            ")); 
            if(count($dbDataUser)){ 
                $userToken = $dbDataUser[0]->fourtune_coins;
                if($userToken < $amount ){
                    $message = "You have Insufficient fourtune token for transfer (".$userToken.")!"; 
                }else{
                    if($userid == $dbData[0]->id ){
                           $message = "You cannot transfer to your own account"; 
                    }else{
                        //update for main user
                        $newUserRemainingtoken = $userToken - $amount;
                        DB::connection('mysql')->select( DB::raw("UPDATE users SET fourtune_coins='".$newUserRemainingtoken."' WHERE id = '".$userid."'"));
                        //update for transfer user
                        $newTokenForTransferUser = $dbData[0]->fourtune_coins + $amount;
                        DB::connection('mysql')->select( DB::raw("UPDATE users SET fourtune_coins='".$newTokenForTransferUser."' WHERE id = '".$dbData[0]->id."'"));
                        //transfer
                        FourtuneTokenTransfer::create([
                            'from_user_id' => $userid,
                            'to_user_id' =>$dbData[0]->id,
                            'amount' =>$amount,                 
                            'totals_from' =>$newUserRemainingtoken,
                            'totals_to' =>$newTokenForTransferUser,
                            'created_at' =>date('Y-m-d H:i:s')
                        ]);                        
                        //response
                        $message = "Successfully transfered to ".$dbData[0]->name."!";
                        $issuccess = true;
                    }

                } 

            }else{
                $message = "User does not exist!";   
            }

        }else{
            $message = "The entered User does  not exist on fourtune database!"; 
        }
        $responseBody = array("message"=>$message,"success"=>$issuccess,"totalcoins"=>$newUserRemainingtoken,"account_notification"=>$account_notification);        
        return response($responseBody)->header('Content-Type', 'application/json');
    }

    public function updateTotals($userid,$amount){
      $newTokenForTransferUser = 0;
      $dbDataUser = DB::connection('mysql')->select( DB::raw("
        SELECT * FROM users WHERE  id = '".$userid."'
      ")); 
      if(count($dbDataUser)){ 
        $newTokenForTransferUser = $dbDataUser[0]->fourtune_coins + $amount;
        DB::connection('mysql')->select( DB::raw("UPDATE users SET fourtune_coins='".$newTokenForTransferUser."' WHERE id = '".$dbDataUser[0]->id."'"));
      }
      return $newTokenForTransferUser;
    }



    public function postEarnings(Request $request){
        $userid = $request->userid;
        $gmType = $request->gmType;
        $gmLevel = $request->gmLevel;
        $totalEarnings = $dbCoinToken = 0;
        $issuccess = false;
        //fetch db coin amount assigned
        $dbDataCoin = DB::connection('mysql')->select( DB::raw("
         SELECT * FROM fourtune_token_price WHERE  game = '".$gmType."' AND level = '".$gmLevel."'
        ")); 
        if(count($dbDataCoin)){
            $dbCoinToken = $dbDataCoin[0]->price; 
            FourtuneTokenEarned::create([
                'user_id' => $userid,
                'coins_earned' =>$dbCoinToken,
                'created_at' =>date('Y-m-d H:i:s'),                 
                'game' =>$gmType,
                'level' =>$gmLevel
            ]);
            //update total coins earned
            $totalEarnings = $this->updateTotals($userid,$dbCoinToken);
            $message = "You have earned some Fourtune Tokens (".$dbCoinToken.")!";
            $issuccess = true; 
        }else{
            $message = "Fourtune Token has not been assigned on this level (".$gmType.",Level ".$gmLevel.")!"; 
        }        
        $responseBody = array("message"=>$message,"success"=>$issuccess,"earnings"=>$dbCoinToken,"totalearnings"=>$totalEarnings);        
        return response($responseBody)->header('Content-Type', 'application/json');
    }
    
}
