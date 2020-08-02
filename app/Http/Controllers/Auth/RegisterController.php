<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use \Firebase\JWT\JWT;
class RegisterController extends Controller
{
    public function register(REQUEST $request)
    {
           $name=$request->name;
           $address=$request->address;
           $position=$request->position;
           $email=$request->email;
           $password=$request->password;
           $passHash=Hash::make($password);
           $checkEmail=User::where('email',$email)->get();
          if(count($checkEmail)==1){
            $reponData = array('user_id' => '','status'=>400);
            return  response()->json($reponData, 400);
          }else{
            $newUser= new User();
            $newUser->name=$name;
            $newUser->address=$address;
            $newUser->position=$position;
            $newUser->email=$email;
            $newUser->password=$passHash;
            $newUser->save();
            // return user_id to get profile
            $id_user=  $newUser->id;
            $myKey = 'doantienthanh200520000946613608';
            $data = array('id_user' => $id_user);
            $token = JWT::encode($data, $myKey);
            $reponData = array('user_id' => $token,'status'=>200);
            return  response()->json($reponData, 200);
          }
    }
}
