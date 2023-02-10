<?php

namespace App\Http\Controllers;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\offerTrait;
use Illuminate\Http\Request;
use LaravelLocalization;

class OfferController extends Controller
{
    use offerTrait;
    //
    public function create(){
        //view form to add this offer
        return view('ajaxoffers.create');
    }

    public function store(OfferRequest $request){
        //save offer into db using ajax

        $file_name=$this->saveImage($request -> photo,'images/offers' );

        //insert data in table
        $offer=Offer::create([
            'name_ar'=> $request-> name_ar ,
            'name_en'=>$request -> name_en,
            'price'=>$request-> price,
            'details_ar'=>$request -> details_ar,
            'details_en'=>$request ->details_en,
            'photo'=>$file_name,
        ]);


        if($offer) {
            return response()->json([
                'status' => true,
                'msg' => 'saved successfully'
            ]);
        }
        else{
            return response()-> json([
                'status' =>false,
                'msg' => 'cannot save , you should try again'
            ]);
        }

    }
    public  function all()
    {
        $offers =Offer::select('id',
            'price',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'details_' . LaravelLocalization::getCurrentLocale() . ' as details')
            ->limit(10)->get(); //return array of collection
        return view('ajaxoffers.all',compact('offers'));
    }

    public function delete(Request $request)
    {
        $offer=Offer::find($request-> id);

        if(!$offer){ //there is not data in tabel of id
            return redirect()->back()->with(['error'=>__('messages.offer not exist')]);
        }
        $offer ->delete();

        return response()->json([
            'status' => true,
            'msg' => 'Deleted successfully',
            'id'=> $request ->id,
        ]);

    }
    public function edit(Request  $request){
        //Offer::findOrFail($offer_id);

        $offer=Offer::find($request->offer_id);

        if(!$offer){ //there is not data in tabel of id
            return response()-> json([
                'status' =>false,
                'msg' => 'this offer is not exist'
            ]);
        }

        Offer::select('id','name_ar','name_en','price','details_ar','details_en')->find($request->offer_id);
        return view('ajaxoffers.edit',compact('offer'));

    }
    public  function update(Request $request){
        $offer=Offer::find($request->offer_id);

        if(!$offer){ //there is not data in tabel of id
            return response()-> json([
                'status' =>false,
                'msg' => 'This offer is not exist'
            ]);
        }

        $offer -> update($request ->all());

        return response()->json([
            'status' => true,
            'msg' => 'updated successfully',

        ]);
    }

}
