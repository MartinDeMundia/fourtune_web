<?php

namespace App\Http\Controllers\Api\V1;

use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;
use CloudCreativity\LaravelJsonApi\Document\Error;
use CloudCreativity\LaravelJsonApi\Http\Controllers\JsonApiController;
use CloudCreativity\LaravelJsonApi\Contracts\Decoder\DecoderInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends JsonApiController 
{
  
    public function authenticateUser(Request $request){     
        $uname = $request->username; 
        $passwd = $request->passwd; 
        $success = "false"; 
        $uData = DB::connection('mysql')->select( DB::raw("
          SELECT * FROM users WHERE  email = '".$uname."'
        "));       
        if(count($uData)){   
            if(Hash::check($passwd,$uData[0]->password)){
                $name = $uData[0]->name;
                $email = $uData[0]->email;
                $id = $uData[0]->id; 
                $phone = $uData[0]->phone;
                $uData = array();         
                $message = "Authentication is a success!";
                $success = "true";
                $uData = array("name"=>$name,"email"=>$email,"id"=>$id,"phone"=>$phone);          
              }else{
                $uData = array();           
                $message = "Invalid Password!";          
            } 
        }else{
            $message = "Invalid Username!"; 
        }
        
        $responseBody = array("data"=>$uData,"message"=>$message,"success"=>$success);
        return response($responseBody)->header('Content-Type', 'application/json');
    }     
    
    protected function createUser(Request $request){
        $success = "false";
        $name = $request->fullname;
        $email = $request->email;
        $passwd = $request->passwd;
        $mobilenumber = $request->mobilenumber;
        $gender = $request->gender;
        $dob = $request->age;

        $uData = DB::connection('mysql')->select( DB::raw("
        SELECT * FROM users WHERE  email = '".$email."'
       "));

       $uDataDB = array();
       if(count($uData)){
            $message = "A user exist with the same email address!";
       }else{
            $uDataDB = User::create([
                'name' => $name,
                'email' => $email,
                'password' =>$passwd,
                'phone'=>$mobilenumber,
                'gender'=>$gender,
                'dob'=>$dob 
            ]);
            $message = "Successfully created user!";
            $success = "true";
        }
        $responseBody = array("data"=>$uDataDB,"message"=>$message,"success"=>$success);
        return response($responseBody)->header('Content-Type', 'application/json');
    }

    public function getUsers(Request $request){  
        $dBData = DB::connection('mysql')->select( DB::raw("
            SELECT 
              *
            FROM             
            users;
        "));       
        return response(array("users"=>$dBData))->header('Content-Type', 'application/json');
    }  



    
}
