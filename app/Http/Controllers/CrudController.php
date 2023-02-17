<?php

namespace App\Http\Controllers;
use App\Events\videoViewer;
use App\Http\Requests\OfferRequest;
use App\Models\Video;
use App\Traits\offerTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Offer;

use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CrudController extends Controller
{
    //
    use offerTrait;
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


        $file_name=$this ->saveImage($request -> photo,'images/offers' );

        Offer::create([
            'name_ar'=> $request-> name_ar ,
            'name_en'=>$request -> name_en,
            'price'=>$request-> price,
            'details_ar'=>$request -> details_ar,
            'details_en'=>$request ->details_en,
            'photo'=>$file_name,
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
            'details_' . LaravelLocalization::getCurrentLocale() . ' as details'
            )->simplePaginate(PAGINATION_COUNT);
        // ->get();    //return array of collection
       // return view('offers.all',compact('offers'));

        return view('offers.paginate',compact('offers'));
    }


    public  function editOffer($offer_id)
    {
        //Offer::findOrFail($offer_id);

        $offer=Offer::find($offer_id);

        if(!$offer){ //there is not data in tabel of id
            return redirect()->back();
        }

        Offer::select('id','name_ar','name_en','price','details_ar','details_en')->find($offer_id);
        return view('offers.edit',compact('offer'));

    }

    public function deleteOffer($offer_id){
        $offer=Offer::find($offer_id);

        if(!$offer){ //there is not data in tabel of id
            return redirect()->back()->with(['error'=>__('messages.offer not exist')]);
        }
        $offer ->delete();

        return redirect()
            ->route('offers.all')
            ->with(['success'=>__('messages.offer deleted successfully')]);
    }


    public  function updateOffer(OfferRequest $request, $offer_id)
    {
        $offer=Offer::find($offer_id);

        if(!$offer){ //there is not data in tabel of id
            return redirect()->back();
        }

        $offer -> update($request ->all());

        return redirect()->back()->with(['success'=>'تم التحديث بنجاح']);

    }

    public function getVideo(){
        $video=Video::first();

        event(new videoViewer($video));
        return view('video')->with('video',$video);
    }


    public  function getAllInactiveOffer(){
        // local scope used in specific model
        //return Offer::inactive()->get();

        //global scope
        return Offer::get();
    }

}

//
