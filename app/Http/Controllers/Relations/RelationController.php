<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Phone;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;


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

    public function getDoctorServices(){
        return $doctor = Doctor::with('services')->find(9);  //return doctor with services
        //return $doctor -> services;
    }

    public function getDoctorServicesById($doctorId){
        $doctor = Doctor::find($doctorId);
        $services= $doctor ->services;

        $doctors = Doctor::select('id','name')->get();
        $allServices =Service::select('id','name')->get();
        return view('doctors.services',compact('services','doctors','allServices'));
    }

    public function saveServicesToDoctors(Request $request){
        $doctor=Doctor::find($request ->doctor_id);
        if(!$doctor)
            return abort('404');

        //$doctor->  services()-> attach($request-> servicesIds) ; //serviceIds is the array i named it in form in services.balde.php

        //$doctor->  services()-> sync($request-> servicesIds) ; //update =>delete all old data and add new
        $doctor->  services()-> syncWithoutDetaching($request-> servicesIds);  //add on old data =>insert

        return 'success';
    }


    public function getServicesDoctors(){
        return $doctor =Service::with(['doctors'=>function($q){
            $q->select('doctors.id','name','title');
        }])->find(1); //return services with doctors
    }




    ############ Begin  Has one through methods #########

    public function getPatientDoctor(){
        $patient=Patient::find(1);
        return  $patient-> doctor;

    }
    public  function getCountryDoctors(){
        // $country=Country::find(1);
        $country=Country::with('doctors')->find(1); //return country with it's doctors

        return $country;
    }

    public function getCountryHospitals(){
        $country=Country::find(1);
        return $country->hospitals;
    }
    ########### End Has one through method ############3
}
