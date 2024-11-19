<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\OfferTrait;
use App\Models\Offer;
use LaravelLocalization;

class AjaxOfferController extends Controller
{

    use OfferTrait;

    public function create()
    {
        return view('ajaxoffers.create');
    }
    
    public function store(Request $request)
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















}
