<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected  $table='phones';
    protected $fillable=['id','code','phone','user_id'];
    protected $hidden=['user_id'];
    public $timestamps=false;
    ############  Begin Relations ###########

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    ########### End Relations ###############
}
