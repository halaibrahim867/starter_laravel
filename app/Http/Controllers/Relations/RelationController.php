<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;

class RelationController extends Controller
{
    //

    public function hasOneRelation(){
        $user=User::with(['phone'=>function($q){
            $q ->select('code','phone','user_id');
        }])->find(11);

        //return $user ->phone ->code;
        return response()->json($user);

    }

    public function hasOneRelationReverse(){
         $phone= Phone::with(['user'=>function($q){
             $q -> select('id','name');
        }])->find(1);
        //$phone->makeVisible(['user_id']); //to make user id visible
        return $phone ;
    }

    public function getUserHasPhone(){
       return  User::whereHas('phone',function ($q){
           $q->where('code','020');
       })->get();
    }

    public function getUserHasNotPhone(){
        return  User::whereDoesntHave('phone')->get(); //return users that dont have phone in table phone
    }


    ##############  One to manty relationship methods

    public  function getHospitalDoctor(){
         //$hospital=Hospital::find(1); //way one
        //Hospital::where('id',1)->first();
        //Hospital::first();//way three , because it's the first row

        return $hospital=Hospital::with('doctors')->find(1);


    }

    public function getHospitals(){

        $hospitals=Hospital::select('id','name','address')->get();
        return view('doctors.hospitals',compact('hospitals'));
    }

    public function getDoctors($hospital_id){
        $hospital=Hospital::find($hospital_id);
        $doctors=$hospital ->doctors;

        return view('doctors.doctors',compact('doctors'));
    }

    public function hospitalHasDoctors(){
        return $hospital=Hospital::whereHas('doctors')->get();
    }

    public function hospitalsHasDoctorsMale(){
        return $hospital=Hospital::with('doctors')->whereHas('doctors',function ($q){
            $q -> where('gender',1);
        })->get();
    }

    public function hospitalsHasNotDoctors(){
        return Hospital::whereDoesntHave('doctors')->get();
    }

    public function deleteHospital($hospital_id){

        $hospital=Hospital::find($hospital_id);

        if(!$hospital){
            return abort('404');
        }
        //delete  doctors of hospital
        $hospital ->doctors()-> delete();

        $hospital ->delete();
        return redirect()->route('hospitals.all');
    }



}
