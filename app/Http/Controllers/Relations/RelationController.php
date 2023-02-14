<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
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
}
