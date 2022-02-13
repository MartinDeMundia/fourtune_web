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

class DashBoardController extends JsonApiController 
{   
    
    public function getDashBoardData(Request $request){ 

                        $dBData = DB::connection('mysql')->select( DB::raw("
                        SELECT      
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
                        END labels,
                        IFNULL(REPLACE(FORMAT(SUM(ftp.token_amount),0),',',''), 0 ) series
                    
                    FROM
                        (SELECT 1 AS MONTH UNION SELECT 2 AS MONTH UNION SELECT 3 AS MONTH UNION SELECT 4 AS MONTH UNION SELECT 5 AS MONTH UNION SELECT 6 AS MONTH UNION SELECT 7 AS MONTH UNION SELECT 8 AS MONTH UNION SELECT 9 AS MONTH UNION SELECT 10 AS MONTH UNION SELECT 11 AS MONTH UNION SELECT 12 AS MONTH) AS yearmonths
                            LEFT JOIN
                        fourtune_token_purchases ftp ON yearmonths.month = MONTH(ftp.purchase_date) 
                            LEFT JOIN
                        users u ON u.id = ftp.user_id 
                    GROUP BY yearmonths.month
                    "));

                    $fourtunecoinvaluegraph = array();
                    foreach ($dBData as $key =>$data){
                        $fourtunecoinvaluegraph[] = array("labels"=>$data->labels,"series"=>$data->series); 
                    } 









                    $dBData = DB::connection('mysql')->select( DB::raw("
                        SELECT 
                        CASE
                            WHEN pweekday.weekday = 0 THEN 'Sun'
                            WHEN pweekday.weekday = 1 THEN 'Mon'
                            WHEN pweekday.weekday = 2 THEN 'Tue'
                            WHEN pweekday.weekday = 3 THEN 'Wed'
                            WHEN pweekday.weekday = 4 THEN 'Thu'
                            WHEN pweekday.weekday = 5 THEN 'Fri'
                            WHEN pweekday.weekday = 6 THEN 'Sar'
                            ELSE ''
                        END labels,
                        IFNULL(REPLACE(FORMAT(SUM(ftp.token_amount), 0),
                                    ',',
                                    ''),
                                0) series
                    FROM
                        (SELECT 0 AS WEEKDAY UNION SELECT 1 AS WEEKDAY UNION SELECT 2 AS WEEKDAY UNION SELECT 3 AS WEEKDAY UNION SELECT 4 AS WEEKDAY UNION SELECT 5 AS WEEKDAY UNION SELECT 6 AS WEEKDAY) AS pweekday
                            LEFT JOIN
                        fourtune_token_purchases ftp ON pweekday.weekday = WEEKDAY(ftp.purchase_date)
                    GROUP BY pweekday.weekday
                    ORDER BY pweekday.weekday
                    "));

                    $fourtunepurchasesgraph = array();
                    foreach ($dBData as $key =>$data){
                        $fourtunepurchasesgraph[] = array("labels"=>$data->labels,"series"=>$data->series); 
                    } 







                    $dBData = DB::connection('mysql')->select( DB::raw("
                        SELECT 
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
                        END labels,
                        IFNULL(REPLACE(FORMAT(SUM(ftp.coins_earned), 0),
                                    ',',
                                    ''),
                                0) series
                    FROM
                        (SELECT 1 AS MONTH UNION SELECT 2 AS MONTH UNION SELECT 3 AS MONTH UNION SELECT 4 AS MONTH UNION SELECT 5 AS MONTH UNION SELECT 6 AS MONTH UNION SELECT 7 AS MONTH UNION SELECT 8 AS MONTH UNION SELECT 9 AS MONTH UNION SELECT 10 AS MONTH UNION SELECT 11 AS MONTH UNION SELECT 12 AS MONTH) AS yearmonths
                            LEFT JOIN
                        fourtune_token_coins_earned ftp ON yearmonths.month = MONTH(ftp.created_at)
                            LEFT JOIN
                        users u ON u.id = ftp.user_id
                    GROUP BY yearmonths.month
                "));

                $fourtunegamersearningsgraph = array();
                foreach ($dBData as $key =>$data){
                    $fourtunegamersearningsgraph[] = array("labels"=>$data->labels,"series"=>$data->series); 
                } 





                $dBData = DB::connection('mysql')->select( DB::raw("
                SELECT 
                    u.name gamer,
                    u.phone,
                    u.email,
                    ftc.created_at,
                    ftc.game,
                    ftc.level,
                    ftc.coins_earned
                FROM
                    users u
                        JOIN
                    fourtune_token_coins_earned ftc ON ftc.user_id = u.id
                GROUP BY game
                ORDER BY coins_earned ASC
                LIMIT 0 , 5
                "));

                $fourtuneactiveusers = array();
                foreach ($dBData as $key =>$data){
                $fourtuneactiveusers[] = array("email"=>$data->email,"phone"=>$data->phone,"gamer"=>$data->gamer,"created_at"=>$data->created_at,"game"=>$data->game,"level"=>$data->level,"coins_earned"=>$data->coins_earned); 
                } 




        $fourtunecoinvalue  = "5";
        $totalfourtunecoinspurchased = "570";
        $totalcoinsearned = "360";
        $totalfourtunecoinstransfered = 50;





        return response(json_encode(array(
            "totalfourtunecoinstransfered"=>$totalfourtunecoinstransfered,
            "totalcoinsearned"=>$totalcoinsearned,
            "totalfourtunecoinspurchased"=>$totalfourtunecoinspurchased,
            "fourtunecoinvalue "=>$fourtunecoinvalue,
            "fourtuneactiveusers"=>$fourtuneactiveusers,
            "fourtunecoinvaluegraph"=>$fourtunecoinvaluegraph,
            "fourtunepurchasesgraph"=>$fourtunepurchasesgraph,
            "fourtunegamersearningsgraph"=>$fourtunegamersearningsgraph
            
            )))->header('Content-Type', 'application/json');
    } 
    
    











    public function getActiveUsers(Request $request){
            $dBData = DB::connection('mysql')->select( DB::raw("
                SELECT      
                * FROM users
            "));

            $users = array();
            foreach ($dBData as $key =>$data){
                //$users[] = array("name"=>$data->name,"id"=>$data->id); 
                $users[] = $data->name; 
            } 
            return response(json_encode(array(
                "users"=>$users   
             )))->header('Content-Type', 'application/json');

    }



    
}
