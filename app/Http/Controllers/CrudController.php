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

    public function store(){
        Offer::create([
            'name'=>'offer1',
            'price'=>'5000',
            'details'=>'detail of offer'
        ]);
    }
}
