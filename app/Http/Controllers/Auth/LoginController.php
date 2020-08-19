<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\User;
use \Firebase\JWT\JWT;
use phpDocumentor\Reflection\Types\This;

class LoginController extends Controller
{

    function createKey()
    {
        $myKey = 'doantienthanh200520000946613608';
        return $myKey;
    }
    function Login(REQUEST $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();
            $id_user = $user->id;
            $data = array('id_user' => $id_user);
            $myKey = $this->createKey();
            $token = JWT::encode($data, $myKey);
            $reponData = array('user_id' => $token, 'status' => 200);
            return  response()->json($reponData, 200);
        } else {
            return array('status' => 400);
        }
    }
    function getProfileUser()
    {
        $token = request()->header('Authorization');
        $myKey = $this->createKey();
        $data = JWT::decode($token, $myKey, array('HS256'));
        $user = User::find($data->id_user);
        $reponData = array('user' => $user);
        return  response()->json($reponData, 200);
    }

}
