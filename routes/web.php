<?php

use Illuminate\Support\Facades\Auth;
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

define('PAGINATION_COUNT',5);
Auth::routes(['verify' =>true]);

Route::get('/home','App\Http\Controllers\HomeController@index')
    ->name('home')-> middleware('verified');

Route::get('/', function () {
    return 'Home';
});


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
        Route::get('all','App\Http\Controllers\CrudController@getAllOffers')
            ->name('offers.all');

        Route::get('edit/{offer_id}','App\Http\Controllers\CrudController@editOffer');
        Route::post('update/{offer_id}','App\Http\Controllers\CrudController@updateOffer')->name('offers.update');
        Route::get('delete/{offer_id}','App\Http\Controllers\CrudController@deleteOffer')
            ->name('offers.delete');

        Route::get('get-all-inactive-offer','App\Http\Controllers\CrudController@getAllInactiveOffer');
    });

    Route::get('youtube','App\Http\Controllers\crudController@getVideo');
});


############### Begin Ajax routes ##############

Route::group(['prefix'=>'ajax-offers'],function(){

    Route::get('/create','App\Http\Controllers\OfferController@create');

    Route::post('store','App\Http\Controllers\OfferController@store')
        ->name('ajax.offers.store');

    Route::get('all','App\Http\Controllers\OfferController@all')
        ->name('ajax.offers.all');

    Route::post('delete','App\Http\Controllers\OfferController@delete')
        ->name('ajax.offers.delete');

    Route::get('edit/{offer_id}','App\Http\Controllers\OfferController@edit')
        ->name('ajax.offers.edit');

    Route::post('update','App\Http\Controllers\OfferController@update')
        ->name('ajax.offers.update');
});



############### End Ajax routes #######################

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


######### Begin  Authentication && Guard ##############
Route::get('/dashboard',function (){
    return 'Not adult';
})->name('not.allowed');

Route::group(['middleware'=>'checkage'],function(){
Route::get('/adult','App\Http\Controllers\Auth\CustomAuthController@adult')
    ->name('adult');
});


/*
Route::get('adult','App\Http\Controllers\Auth\CustomAuthController@adult')
        ->middleware('checkage');
*/
######## End  Authentication && Guard ###############


Route::get('/index','App\Http\Controllers\Auth\CustomAuthController@show') ;

Route::get('/site','App\Http\Controllers\Auth\CustomAuthController@site')
    ->middleware('auth:web')->name('site');

Route::get('/admin','App\Http\Controllers\Auth\CustomAuthController@admin')
    ->middleware('auth:admin')->name('admin');


Route::get('admin/login','App\Http\Controllers\Auth\CustomAuthController@adminLogin')
    ->name('admin.login');

Route::post('admin/login','App\Http\Controllers\Auth\CustomAuthController@checkAdminLogin')
    ->name('save.admin.login');




/*
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('customAuth.index');
    });
});*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



###############   Begin one to one Relations ############3

Route::get('has-one','App\Http\Controllers\Relations\RelationController@hasOneRelation');

Route::get('has-one-reverse','App\Http\Controllers\Relations\RelationController@hasOneRelationReverse');

Route::get('get-user-has-phone','App\Http\Controllers\Relations\RelationController@getUserHasPhone');

Route::get('get-user-not-has-phone','App\Http\Controllers\Relations\RelationController@getUserHasNotPhone');

##############   End one to one Relations ###############


###############   Begin many to many Relations ############3

Route::get('hospital-has-many','App\Http\Controllers\Relations\RelationController@getHospitalDoctor');

Route::get('hospitals','App\Http\Controllers\Relations\RelationController@getHospitals')
        ->name('hospitals.all');

Route::get('doctors/services/{doctor_id}','App\Http\Controllers\Relations\RelationController@getDoctorServicesById')
    ->name('doctors.services');

Route::post('saveServices','App\Http\Controllers\Relations\RelationController@saveServicesToDoctors')
    ->name('save.doctors.services');


Route::get('doctors/{hospital_id}','App\Http\Controllers\Relations\RelationController@getDoctors')
    ->name('hospital.doctors');

Route::get('hospitals/{hospital_id}','App\Http\Controllers\Relations\RelationController@deleteHospital')
        ->name('hospital.delete');

Route::get('hospitals-has-doctors','App\Http\Controllers\Relations\RelationController@hospitalHasDoctors');

Route::get('hospitals-has-doctors-male','App\Http\Controllers\Relations\RelationController@hospitalsHasDoctorsMale');

Route::get('hospitals-has-not-doctors','App\Http\Controllers\Relations\RelationController@hospitalsHasNotDoctors');

Route::get('doctors-services','App\Http\Controllers\Relations\RelationController@getDoctorServices');

Route::get('services-doctors','App\Http\Controllers\Relations\RelationController@getServicesDoctors');


###############   Begin many to many Relations ############3

################ Begin Has one Through Relationship route  #########################

Route::get('has-one-through','App\Http\Controllers\Relations\RelationController@getPatientDoctor');

Route::get('has-many-through','App\Http\Controllers\Relations\RelationController@getCountryDoctors');

Route::get('country-has-hospitals','App\Http\Controllers\Relations\RelationController@getCountryHospitals');

################# End Has one Through Relationship route   #########################
