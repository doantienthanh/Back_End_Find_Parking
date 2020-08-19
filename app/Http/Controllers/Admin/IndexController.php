<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Park;
use Illuminate\Http\Request;

class IndexController extends Controller
{
   function getAllDataParks(){
      $parks= Park::get();
      if(count($parks)==0){
          $parks=[];
         return  response()->json($parks,400);
      }else{
        return  response()->json($parks,200);
      }
   }
}
