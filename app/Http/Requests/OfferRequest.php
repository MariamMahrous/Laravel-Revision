<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return  [
            'photo'=>'required',
            'name_ar'=>'required|max:100|unique:offers,name_ar',
            'name_en'=>'required|max:100|unique:offers,name_en',
            'price'=>'required|numeric',
            'details_ar'=>'required',
             'details_en'=>'required'
               ];
    }

    public function messages(){
        return [
            'photo.required'=>__('message.photo required'),
            'name_ar.required'=>__('message.name_ar required'),
            'name_en.required'=>__('message.name_en required'),
            'name_ar.unique'=>__('message.name_ar unique'),
            'name_en.unique'=>__('message.name_en unique'),
            'name_ar.max'=>__('message.name_ar max'),
            'name_en.max'=>__('message.name_en max'),
            'price.required'=>__('message.price required'),
            'price.numeric'=>__('message.price numeric'),
            'details_ar.required'=>__('message.details_ar required'),
            'details_en.required'=>__('message.details_en required'),
             
           ];
    }



}
