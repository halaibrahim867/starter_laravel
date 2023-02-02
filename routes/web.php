<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Auth::routes(['verify' =>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')-> middleware('verified');

Route::get('/', function () {
    return 'Home';
});

*/

/*
Route::get('/', function () {
    echo File::get(storage_path('app/Console/Commands/Notify.php'));
});
*/

//Route::get('/fillable','App\Http\Controllers\CrudController@getOffer');
Route::group(['prefix'=>LaravelLocalization::setLocale() ,'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function (){

    Route::group(['prefix'=>'offers'],function (){
        // Route::get('store','App\Http\Controllers\CrudController@store');

        Route::get('create','App\Http\Controllers\CrudController@create');
        Route::post('store','App\Http\Controllers\CrudController@store');
    });

});
