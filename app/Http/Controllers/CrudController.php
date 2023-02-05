<?php

namespace App\Http\Controllers;
use App\Http\Requests\OfferRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Offer;
use LaravelLocalization;
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

    public  function store(OfferRequest $request)
    {
        //return $request;

        // must validate data before insert to database



        //$message=['name.unique:offers,name'=>'اسم العرض موجود',
        //            'price.numeric'=>'يجب ان يكون السعر رقم ويجب ادخاله ',
        //            'details.required'=>'يجب ادخال تفاصيل العرض'
        //        ];  //laravel or phpstrom not supported arabic but it works
    /*
        $rules= $this->rules();
        $message=$this->messages();

        $validator= Validator::make($request-> all(),$rules, $message);
        if($validator -> fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }*/
        //insert data after validate

        Offer::create([
            'name_ar'=> $request-> name_ar ,
            'name_en'=>$request -> name_en,
            'price'=>$request-> price,
            'details_ar'=>$request -> details_ar,
            'details_en'=>$request ->details_en
        ]);

        return redirect()->back()->with(['success'=>'the data has been stored successfuly']);
    }

    /*
    public  function getRules(){
        return $rules=[
            'name'=>'required|max:100|unique:offers,name',
            'price'=>'required|numeric',
            'details'=>'required'
        ];
    }*/
    /*
    public  function getMessage(){
        return $message=[
            'name.required'=>__('message.offer name required'),
            'name.unique'=>__('message.offer name unique'),
            'price.numeric'=>__('message.offer price numeric'),
            'details.required'=>__('message.offer details'),
        ];
    }*/

    public  function getAllOffers()
    {
        $offers =Offer::select('id',
            'price',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'details_' . LaravelLocalization::getCurrentLocale() . ' as details')
            ->get();
        return view('offers.all',compact('offers'));
    }

}

//
