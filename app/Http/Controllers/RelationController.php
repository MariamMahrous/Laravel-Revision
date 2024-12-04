<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Phone;


class RelationController extends Controller
{
   public function hasOneRelation(){
    $user=User::with(['phone' =>function($q){
        $q->select('code','phone','user_id');
    }])->find(14);
    return $user->phone->user_id;
    return response()->json($user);
   }


   public function hasOneRelationReverse(){
    // $phone=Phone::with('user')->find(1);
    // $phone=Phone::with(['user' =>function($q){
    //    $q->select('name','email','id');

    // }])->find(1);
    // //Some Important attribute
    // $phone->makeVisible(['user_id']);
    // $phone->makeHidden(['code']);


    // return response()->json($phone);


     //    // //Some Important attribute  whereHas
    //  $user =User::whereHas('phone')->get();
    //  return response()->json($user);

         //    // //Some Important attribute  whereHas
 
        //  $user =User::whereDoesntHave('phone')->get();
        //  return response()->json($user);
        //    // //Some Important attribute  whereHas And Condition
     $user =User::whereHas('phone',function($q){
        $q->where('code','03');
     })->get();
     return response()->json($user);

   }
}
