<?php

namespace App\Http\Controllers\Api\V1;

use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;
use CloudCreativity\LaravelJsonApi\Document\Error;
use CloudCreativity\LaravelJsonApi\Http\Controllers\JsonApiController;
use App\Models\FourtuneEvents;
use App\Models\FourtuneImages;
use Illuminate\Support\Facades\DB;

class EventsController extends JsonApiController{

  public function deleteFourtuneEvent(Request $request){
    $data = (object) $request->json()->all();

    $whereArray = array('id' =>$data->eventid);
    FourtuneEvents::where($whereArray)->delete();

    $whereArray = array('parent_id' =>$data->eventid);
    FourtuneImages::where($whereArray)->delete();

    $uData = DB::connection('mysql')->select( DB::raw("SELECT * FROM fourtune_events"));       
    return response(array("events_data"=>$uData))->header('Content-Type', 'application/json');
  } 

  function clean($string) {
      $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.     
      return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
   }

  public function getEvents(Request $request){	
      $dBData = DB::connection('mysql')->select( DB::raw("
      SELECT 
       *
      FROM
      fourtune_events ORDER BY created_at DESC LIMIT 0,6;
  "));       
  return response(array("events_data"=>$dBData))->header('Content-Type', 'application/json');
       
    }
    public function addEvent(Request $request){ 
      $message = "";
      $issuccess = false;

      $folder = $request->event_name; 
      $folder= $this->clean($folder);       
      $strDestinationPath = 'uploads/events/'.$folder;      
      if(!is_dir($strDestinationPath)){        
          mkdir($strDestinationPath, 0755, true);
      }       
      $filesd = glob($strDestinationPath."/*"); 
      foreach($filesd as $file){ 
         if(is_file($file))
          unlink($file); 
      }        

      $fileName = $_FILES["event_image"]["name"] ;
      $u                  = 1;
      $fileTmpLoc         = $_FILES["event_image"]["tmp_name"];
      $fileType           = $_FILES["event_image"]["type"];
      $fileSize           = $_FILES["event_image"]["size"];
      $fileErrorMsg       = $_FILES["event_image"]["error"];
      $kaboom             = explode(".", $fileName);
      $fileExt            = end($kaboom);
      $fileName           = uniqid() . ".$fileExt";       

      if (!$fileTmpLoc){
        $message = "ERROR: Please browse for a file before clicking the upload button.";
          //exit();
      }
      else if ($fileSize > 5242880) {
        $message = "ERROR: Your file was larger than 5 Megabytes in size.";
          unlink($fileTmpLoc);
          //exit();
      }
     else if (!preg_match("/.(gif|jpg|png|jpeg)$/i", $fileName)) {        
      $message ="ERROR: Your image was not .gif, .jpg, or .png.";
         // exit();
      } 
      else if ($fileErrorMsg == 1){          
        $message ="ERROR: An error occured while processing the file. Try again.";
          //exit();
      }
      elseif (is_writable($strDestinationPath)) {
          $moveResult = move_uploaded_file($fileTmpLoc, "$strDestinationPath/$fileName");
          if ($moveResult != true){
              $error = error_get_last();           
              $message = "ERROR: $error[message]";
              //exit();
          }
      }
      else{
        $message = "Directory does not exist or it's not writable";
      } 
      
      $url = $request->url;
      $urlArray =  explode("api/v1",$url);
      if(count($urlArray)>0){
        $link = $urlArray[0]; 
      }else{
        $link = "";
      }

     $isSaved =  FourtuneEvents::create([
        'event_location'=>$request->event_location,
        'event_name' =>$request->event_name,
        'event_date' =>$request->event_date,
        'event_description' =>$request->event_description,                 
        'price' =>$request->price,
        'event_featured_image' =>$link."".$strDestinationPath."/".$fileName,
        'created_at'=>date('Y-m-d H:i:s')
      ]);
      $id = 0;
      if($isSaved){
        $id = $isSaved->id;
        $issuccess = true;
        $message = "Successfully Saved!!";
      }else{
        $message = "Details were not saved!";
      }
    $responseBody = array("message"=>$message,"success"=>$issuccess,"id"=>$id);        
    return response($responseBody)->header('Content-Type', 'application/json');
    }

    public function uploadImages(Request $request){  

      header('Access-Control-Allow-Origin: *');
      header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
      header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
      $issuccess = false;
      $message = "";
      $filesdata = $request->input('files');

      $url = $request->input('url');
      $urlArray =  explode("api/v1",$url);
      if(count($urlArray)>0){
        $link = $urlArray[0]; 
      }else{
        $link = "";
      }
      $id = $request->input('id');      
      $folder = $id;

      $strDestinationPath = 'uploads/events/more/'.$folder; 
      if(!is_dir($strDestinationPath)){        
          mkdir($strDestinationPath, 0755, true);
      }  
      foreach ($filesdata as $key =>$fdata){       
        $data = $fdata["dataURL"];
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        if(file_put_contents($strDestinationPath.'/'.$fdata["upload"]["filename"], $data)){
          //add to the images table
            $isSaved =  FourtuneImages::create([
              'image_path' =>$link."".$strDestinationPath.'/'.$fdata["upload"]["filename"],
              'parent_id' =>$id,
              'created_at' =>date('Y-m-d H:i:s'),                 
              'image_type' =>'events'
            ]);    
          if($isSaved){
            $issuccess = true;
            $message = "Successfully Saved!!";
          }else{
            $message = "Details were not saved!";
          }
          $message = "Successfully Saved!!";
        }
     
      }

      exit();
      $responseBody = array("message"=>$message,"success"=>$issuccess);        
      return response($responseBody)->header('Content-Type', 'application/json');
    }



}
