<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Traits\OfferTrait;
use App\Http\Requests\OfferRequest;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;


class OfferController extends Controller
{


    use OfferTrait;
    
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

    //save photo 
  
$file_name=$this->saveimage($request -> photo ,'images/offers');


   Offer::create([
    'photo'=>$file_name,
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

 $offers=Offer::select('id',
 'price',
 'name_' . LaravelLocalization::getCurrentLocale() .  ' as name',
 'details_'.LaravelLocalization::getCurrentLocale() . ' as details'
 )->get();
 return view('offers.index',compact('offers'));


}
public function edit($offer_id){

    $offer= Offer::find($offer_id);
    if(!$offer)
        return redirect()->back();
    
  $offer= Offer::select('id','name_ar','name_en','price','details_ar','details_en')->find($offer_id);
 

  return view('offers.edit',compact('offer'));


}


public function update(OfferRequest $request ,$offer_id){


    //check if offer exists
$offer=Offer::find($offer_id);
if(!$offer)
return redirect()->back();

//update data
$offer->update($request->all());

return redirect()->back()->with(['success' =>__('message.update')]);


}



}
