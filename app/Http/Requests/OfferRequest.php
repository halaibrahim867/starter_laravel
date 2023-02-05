<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{


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
        return [
            'name_ar'=>'required|max:100|unique:offers,name_ar',
            'name_en'=>'required|max:100|unique:offers,name_en',
            'price'=>'required|numeric',
            'details_ar'=>'required',
            'details_en'=>'required'


        ];
    }

    public  function messages()
    {
        return [
            'name.required'=>__('messages.offer name required'),
            'name.unique'=>__('messages.offer name unique'),
            'price.numeric'=>__('messages.offer price numeric'),
            'details.required'=>__('messages.details required'),
        ];
    }


}
