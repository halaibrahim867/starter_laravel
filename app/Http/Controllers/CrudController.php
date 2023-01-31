<?php

namespace App\Http\Controllers;

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

        //insert data after validate

        Offer::create([
            'name'=> $request-> name ,
            'price'=>$request-> price,
            'details'=>$request -> details
        ]);
    }
}
