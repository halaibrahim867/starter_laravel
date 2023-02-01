<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Offer;

use Illuminate\Http\Request;

class CrudController extends Controller
{
    //


    public function  getOffer(){
        return Offer::get()->toArray();
    }
/*
    public function store(){
         create row or enter data with static data
        Offer::create([
            'name'=>'offer1',
            'price'=>'5000',
            'details'=>'detail of offer'
        ]);
    }*/

    public  function create(){
        return view('offers.create');
    }

    public  function store(Request $request){
        //return $request;

        // must validate data before insert to database



        //$message=['name.unique:offers,name'=>'اسم العرض موجود',
        //            'price.numeric'=>'يجب ان يكون السعر رقم ويجب ادخاله ',
        //            'details.required'=>'يجب ادخال تفاصيل العرض'
        //        ];  //laravel or phpstrom not supported arabic but it works

        $rules= $this->getRules();

        $validator= Validator::make($request-> all(),$rules);
        if($validator -> fails()){
            return $validator->errors();
        }
        //insert data after validate

        Offer::create([
            'name'=> $request-> name ,
            'price'=>$request-> price,
            'details'=>$request -> details
        ]);

        return 'saved sucessfuly';
    }
    public  function getRules(){
        return [
            'name'=>'required|max:100|unique:offers,name',
            'price'=>'required|numeric',
            'details'=>'required'
        ];
    }

}

