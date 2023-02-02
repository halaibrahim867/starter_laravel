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
        $message=$this->getMessage();

        $validator= Validator::make($request-> all(),$rules, $message);
        if($validator -> fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        //insert data after validate

        Offer::create([
            'name'=> $request-> name ,
            'price'=>$request-> price,
            'details'=>$request -> details
        ]);

        return redirect()->back()->with(['success'=>'the data has been stored successfuly']);
    }
    public  function getRules(){
        return $rules=[
            'name'=>'required|max:100|unique:offers,name',
            'price'=>'required|numeric',
            'details'=>'required'
        ];
    }
    public  function getMessage(){
        return $message=[
            'name.required'=>__('message.offer name required'),
            'name.unique'=>__('message.offer name unique'),
            'price.numeric'=>__('message.offer price numeric'),
            'details.required'=>__('message.offer details'),
        ];
    }

}

