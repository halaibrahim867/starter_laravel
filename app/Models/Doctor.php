<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table="doctors";
    protected $fillable=['id','name','gender','title','hospital_id','created_at','updated_at'];
    protected $hidden=['created_at','updated_at','pivot'];
    public $timestamp=true;

    public function hospital(){
        return $this ->belongsTo('App\Models\Hospital','hospital_id','id');
    }

    public function services(){
        //id , id not requirement id i named correctly
        return $this->belongsToMany('App\Models\Service','doctor_service','doctor_id','service_id','id','id');

    }
}
