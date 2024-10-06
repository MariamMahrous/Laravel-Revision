<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class OfferController extends Controller
{
    public function create()
    {
        return view ('offers.create');
    }

   public function store(Request $request)
   {  

    //validate before save data
     $rules=$this->getrules();
     $messages=$this->getmessages();
    $validator= Validator::make($request->all(), $rules ,$messages);
   if($validator->fails()){
    return redirect()->back()->withErrors($validator)->withInputes($request->all());
   }

   Offer::create([
    'name'=>$request->name,
    'price'=> $request->price,
    'details'=>$request->details
   ]);
   return redirect()->back()->with(['success' =>'تم اضافة العرض بنجاح']);
   }


protected function getrules(){
    return $rules= [
 'name'=>'required|max:100|unique:offers,name',
 'price'=>'required|numeric',
 'details'=>'required'
    ];
}

protected function getmessages(){
    return $messages= [
     'name.required'=>'هذا الحقل مطلوب',
     'price.required'=>'هذا الحقل مطلوب' ,
      'price.numeric'=>'يجب ان يكون حروف'


    ];
}






}
