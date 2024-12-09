<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Phone;
use App\Models\Hospital;
use App\Models\Doctor;
use App\Models\Service;


class RelationController extends Controller
{

################ ONE TO ONE RELATIONSHIP##############


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


   ################ ONE TO MANY RELATIONSHIP##############

public function getHospitalDoctors(){

//   $hospital=Hospital::with('doctors')->find(2);
// //   $hospital=Hospital::find(2);
// // 
// return $hospital->name;

//reverse and get all doctor

// $doctors=Doctor::with('hospital')->get();
// return $doctors;

                ////get name of all doctors
            //     $hospital=Hospital::with('doctors')->find(2);
            //     $doctors= $hospital->doctors;
            //   foreach($doctors as $doctor){
            // echo $doctor->name. "<br>";
            //   }


}
public function getAllHospital(){
   
   $hospitals=Hospital::select('id','name','address')->get();
   return view('oneToMany.hospitals',compact('hospitals'));
   
  ///Get all Hospital whereDoesntHave doctor ////////
//   $hospitals=Hospital::whereDoesntHave('doctors')->get();
//   return view('oneToMany.hospitals',compact('hospitals'));
 
 ///Get all Hospital Where Has doctor ////////
//  $hospitals=Hospital::whereHas('doctors')->get();
//  return view('oneToMany.hospitals',compact('hospitals'));

///Get all Doctors Where Has doctor and condition ////////
//  $hospitals=Hospital::with('doctors')->whereHas('doctors',function($q){
//    $q->where('title','باطنة');
//   })->first();
//   return $hospitals;
}
 public function getAllDoctors($hospital_id){
   $hospitals= Hospital::find($hospital_id);
   $doctors=$hospitals->doctors;
   return view('oneToMany.doctors',compact('doctors'));


 }


 public function deleteHospital($hospital_id){
   $hospitals= Hospital::find($hospital_id);
   if(!$hospitals){
      return abort(404);
   }
   else{
      $hospitals->doctors()->delete();
      $hospitals->delete();
      return redirect()->route('hospital-index');
   }

 }

  ################ MANY TO MANY RELATIONSHIP##############
  public function getDoctorService(){

//  $doctor =Doctor::find(1);
//  return $doctor->services;

// $doctor =Doctor::with('services')->find(1);
// return $doctor;


 return $service=Service::with('doctors')->find(1);

  }

  public function getService($doctor_id){
    $doctor=Doctor::find($doctor_id);
    if(!$doctor){
      return abort(404);

    }else{
 $services=$doctor->services;
 $doctors=Doctor::select('id','name')->get();
 $allServices=Service::select('id','name')->get();

return view('ManyToMany.services',compact('services','doctors','allServices'));


    }


  }


  public function saveDoctorService(Request $request){

   $doctor=Doctor::find($request->doctor_id);
   if(!$doctor){
     return abort(404);

   }else{
$doctor->services()->syncWithoutDetaching($request->services);
return 'success';


  }
  }

}
