<?php
namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\FourtuneEvents;
use Illuminate\Support\Facades\DB;

class FourtuneEventsController extends Controller 
{


    public function getEvents(Request $request){  
        $dBData = DB::connection('mysql')->select( DB::raw("
                SELECT 
                fe.id,
                fe.event_name,
                fe.event_date,
                fe.event_description,
                fe.price
            FROM
                fourtune_events fe;
        "));         
        $events_object = $images_data = array();
        foreach ($dBData as $key =>$data){
            $dBImageData = DB::connection('mysql')->select( DB::raw("
                SELECT 
                 *
                FROM
                fourtune_images WHERE parent_id = '".$data->id."' AND image_type = 'events';
            ")); 
            $events_object[] = array("events"=>$data,"images"=>$dBImageData);
        } 
        
        //$events_object = 1;
        
       return view('events',array('events_object'=>$events_object));
    } 

    
    /*public function getTokenPurchases(Request $request){  
        $dBData = DB::connection('mysql')->select( DB::raw("
            SELECT 
            u.name, u.email, u.phone, ft.created_at, ft.token_amount
            FROM
                fourtune_token_purchases ft
                    JOIN
                users u ON u.id = ft.user_id;

        "));       
        return response(array("tokenpurchases"=>$dBData))->header('Content-Type', 'application/json');
    }     
    
    public function deleteFourtuneTokenPrice(Request $request){
        $data = (object) $request->json()->all();
        $whereArray = array('id' =>$data->tokenid);
        FourtuneTokenPrice::where($whereArray)->delete();
        $uData = DB::connection('mysql')->select( DB::raw("SELECT * FROM fourtune_token_price"));       
        return response(array("fourtunetokenprices"=>$uData))->header('Content-Type', 'application/json');
    }    
    
    public function setFourtuneToken(Request $request){        
       $data = (object) $request->json()->all();
       if($data->tokenid == 0){
            $tokenDataDB = FourtuneTokenPrice::create([
                'game' => $data->selectgame,
                'level' => $data->level,
                'price' =>$data->tokenprice,
                'updated_at' =>date('Y-m-d H:i:s'),
                'created_at' =>date('Y-m-d H:i:s')
            ]);
       }else{
            $tokenDataDB = FourtuneTokenPrice::find($data->tokenid);
            $tokenDataDB->update(array(
                    'game' => $data->selectgame,
                    'level' => $data->level,
                    'price' =>$data->tokenprice,
                    'updated_at' =>date('Y-m-d H:i:s')
                ));

       }
        $uData = DB::connection('mysql')->select( DB::raw("SELECT * FROM fourtune_token_price"));       
        return response(array("fourtunetokenprices"=>$uData))->header('Content-Type', 'application/json');
    }


    public function getFourtuneTokenPrice(Request $request){     
        $uData = DB::connection('mysql')->select( DB::raw("SELECT * FROM fourtune_token_price"));       
        return response(array("fourtunetokenprices"=>$uData))->header('Content-Type', 'application/json');
    } 


    public function getFourtuneTransfer(Request $request){  
        $dBData = DB::connection('mysql')->select( DB::raw("
        SELECT 
           ft.id,   fr_u.name fromname,fr_u.phone fromphone, to_u.name toname,to_u.phone tophone, ft.amount ,totals_from ,totals_to
        FROM
          fourtune_token_transfer ft
        JOIN
        users fr_u ON fr_u.id = ft.from_user_id
        JOIN
        users to_u ON to_u.id = ft.to_user_id
        "));       
        return response(array("tokentransfer"=>$dBData))->header('Content-Type', 'application/json');
    }    

    */
    
}
