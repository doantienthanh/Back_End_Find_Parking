<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Park;
use App\User;
use Dotenv\Result\Success;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
class KeeperController extends Controller
{
    function addParking(REQUEST $request)
    {
        $user_id = $request->id_user;
        $name = $request->name;
        $location = $request->location;
        $area = $request->area;
        $price = $request->price;
        $description = $request->description;
        $checkName = count(Park::where('name', $name)->get());
        $checkLocation = count(Park::where('address', $location)->get());
        if ($checkName != 0) {
            $reponData = array('message' => 'This name already exists !');
            return  response()->json($reponData, 400);
        } elseif ($checkLocation != 0) {
            $reponData = array('message' => 'this address resgisted !');
            return  response()->json($reponData, 400);
        } else {
            $newParking = new Park();
            $newParking->id_user = $user_id;
            $newParking->name = $name;
            $newParking->address = $location;
            $newParking->area = $area;
            $newParking->price = $price;
            $newParking->description = $description;
            $newParking->save();
            $reponData=array('');
            return  response()->json($reponData, 200);
        }
    }

    function getAllParks(){
        $token = request()->header('Authorization');
        $myKey = 'doantienthanh200520000946613608';
        $id_hacked = JWT::decode($token, $myKey, array('HS256'));
        $parks = Park::where('id_user',$id_hacked->id_user)->get();
        if(count($parks)==0){
            $data = array([]);
            return  response()->json($data, 400);
        }else{
            return  response()->json($parks, 200);
        }
    }
    //Function delete Parking
    function deleteParking($id){
    Park::find($id)->delete();
    return  response()->json(200);
    }
// get park update
    function getParkUpdate($id){
        $park=Park::find($id);
        return  response()->json($park,200);
    }
    // update parking
    function updatePark(REQUEST $request,$id){

        $name = $request->name;
        $location = $request->location;
        $area = $request->area;
        $price = $request->price;
        $description = $request->description;
        $park=Park::find($id);
        $park->name = $name;
         $park->address = $location;
        $park->area = $area;
        $park->price = $price;
        $park->description = $description;
        $park->save();
        return  response()->json($park,200);
    }
}
