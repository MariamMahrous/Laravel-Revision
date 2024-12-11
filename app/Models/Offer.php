<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\OfferScopes;
class Offer extends Model
{
    protected  $fillable=['name_ar','name_en','price','photo','details_ar','details_en','status','created_at','updated_at'];
    protected $hidden=['created_at','updated_at']; 
   // public $timestamps= false;
/////////////////////Begin Local Scope//////////////////////

public function scopeInactive($query){
    return $query->where('status',1);
}
public function scopePrice($query){
    return $query->where('price',55);
}

/////////////////////Begin Global Scope//////////////////////

protected static function boot()
{ 
    parent::boot();
    static::addGlobalScope(new OfferScopes);
}







/////////////////////End Local Scope//////////////////////


}
