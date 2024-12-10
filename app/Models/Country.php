<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    
    protected $table='countries';
    protected $fillable=['name'];
  
    public $timestamps=false;


    ########################### Begin Relations #######################
   public function doctor(){
    return $this->hasManyThrough('App\Models\Doctor','App\Models\Hospital','country_id','hospital_id');
   }




    ########################### End Relations #########################
  
}
