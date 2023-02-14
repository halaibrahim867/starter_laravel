<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table="doctors";
    protected $fillable=['id','name','gender','title','hospital_id','created_at','updated_at'];
    protected $hidden=['created_at','updated_at'];
    public $timestamp=true;

    public function hospital(){
        return $this ->belongsTo('App\Models\Hospital','hospital_id','id');
    }

}
