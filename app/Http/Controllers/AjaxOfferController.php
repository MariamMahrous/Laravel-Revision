<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\OfferTrait;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use LaravelLocalization;

class AjaxOfferController extends Controller
{

    use OfferTrait;

    public function create()
    {
        return view('ajaxoffers.create');
    }
    
public function store(OfferRequest $request)
    {
       
$file_name=$this->saveimage($request -> photo ,'images/offers');


$offer=Offer::create([
'photo'=>$file_name,
 'name_ar'=>$request->name_ar,
 'name_en'=>$request->name_en,
 'price'=> $request->price,
 'details_ar'=>$request->details_ar,
 'details_en'=>$request->details_en,
]);
if ($offer)
return response()->json([
    'status' => true,
    'msg' => 'تم الحفظ بنجاح',
]);

else
return response()->json([
    'status' => false,
    'msg' => 'فشل الحفظ برجاء المحاوله مجددا',
]);

}

public function index(){
    $offers=Offer::select('id',
       'price',
 'name_' . LaravelLocalization::getCurrentLocale() .  ' as name',
 'details_'.LaravelLocalization::getCurrentLocale() . ' as details',
 'photo'

    )->limit(10)->get();
    return view('ajaxoffers.index',compact('offers'));
}

public function delete(Request $request){
$offer=Offer::find($request->id);

$offer->delete();
if($offer)
return response()->json([
'status'=>true,
'msg'=>'تم الحذف بنجاح',
'id'=>$request->id
]);
else
return response()->json([
    'status'=>false,
    'msg'=>'fail',
  
    ]);
}

public function edit(Request $request){
    $offer= Offer::find($request->offer_id);
    if(!$offer)
    return response()->json([
        'status'=>false,
        'msg'=>'هذ العرض غير موجود',
      
        ]);
  $offer= Offer::select('id','name_ar','name_en','price','details_ar','details_en')->find($request->offer_id);
 

  return view('ajaxoffers.edit',compact('offer'));

       

}
public function update(Request $request){
$offer=Offer::find($request->id);
if(!$offer)
return response()->json([
    'status'=>false,
    'msg'=>'لا يوجد عرض فشل'
]);
$offer->update($request->all());
 return response()->json([
    'status'=>true,
    'msg'=>'تم التحديث بنجاح'
]);





}












}
