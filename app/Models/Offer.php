<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static get()
 */
class Offer extends Model
{
  //  use HasFactory;

    protected $table="offers";
    protected $fillable=['name','price', 'details'];
    protected $hidden=['created_at','updated_at'];


}
