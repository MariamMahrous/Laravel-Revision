<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Http\Requests\OfferRequest;
use Illuminate\Support\Facades\Validator;


class OfferController extends Controller
{
    public function create()
    {
        return view ('offers.create');
    }

   public function store(OfferRequest $request)
   {  

    //validate before save data
//      $rules=$this->getrules();
//      $messages=$this->getmessages();
//     $validator= Validator::make($request->all(), $rules ,$messages);
//    if($validator->fails()){
//     return redirect()->back()->withErrors($validator)->withInputes($request->all());
//    }

   Offer::create([
    'name_ar'=>$request->name_ar,
    'name_en'=>$request->name_en,
    'price'=> $request->price,
    'details_ar'=>$request->details_ar,
    'details_en'=>$request->details_en,
   ]);
   return redirect()->back()->with(['success' =>__('message.done')]);
   }


// protected function getrules(){
//     return $rules= [
//  'name_ar'=>'required|max:100|unique:offers,name_ar',
//  'name_en'=>'required|max:100|unique:offers,name_en',
//  'price'=>'required|numeric',
//  'details_ar'=>'required',
//   'details_en'=>'required'
//     ];
// }

// protected function getmessages(){
//     return $messages= [
//      'name_ar.required'=>__('message.name_ar required'),
//      'name_en.required'=>__('message.name_en required'),
//      'name_ar.unique'=>__('message.name_ar unique'),
//      'name_en.unique'=>__('message.name_en unique'),
//      'name_ar.max'=>__('message.name_ar max'),
//      'name_en.max'=>__('message.name_en max'),
//      'price.required'=>__('message.price required'),
//      'price.numeric'=>__('message.price numeric'),
//      'details_ar.required'=>__('message.details_ar required'),
//      'details_en.required'=>__('message.details_en required'),
      
//     ];
// }


public function getAllOffers(){

 $offers=Offer::select('id','name_ar','name_en','price','details_ar','details_en')->get();
 return view('offers.index',compact('offers'));


}



}
