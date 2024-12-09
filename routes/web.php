<?php
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Controllers\OfferContoller;
use App\Http\Controllers\Auth\customAuthController;
use App\Http\Middleware\checkeAge;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');


Route::get('/redirect/{service}', 'SocialController@redirect');

Route::get('/callback/{service}', 'SocialController@callback');


Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function()
{
Route::group(['prefix'=>'offers'],function(){

Route::get('create','OfferController@create');

Route::post('store', 'OfferController@store') ->name('offers.store');

Route::get('index','OfferController@getAllOffers')->name('offers.index');

Route::get('edit/{offer_id}','OfferController@edit');

Route::post('update/{offer_id}', 'OfferController@update') ->name('offers.update');

Route::get('delete/{offer_id}','OfferController@delete');
} );
Route::get('youtube','EventController@viewPage');

});

########################Begin AJAX ROUTES ####################################
Route::group(['prefix'=>'ajax-offers'] ,function(){

    Route::get('create','AjaxOfferController@create');
    Route::post('store','AjaxOfferController@store')->name('ajax.offers.store');
    Route::get('index','AjaxOfferController@index')->name('ajax.offers.index');
    Route::post('delete','AjaxOfferController@delete')->name('ajax.offers.delete');
    Route::get('edit/{offer_id}','AjaxOfferController@edit')->name('ajax.offers.edit');
    Route::post('update','AjaxOfferController@update')->name('ajax.offers.update');
});

########################End AJAX ROUTES ####################################



######################## Begin Authentication && Guards ####################################

 Route::group(['middleware'=>'checkeAge' ,'namespace'=>'Auth'],function(){
     Route::get('adult','customAuthController@adult');


});

Route::get('site','Auth\customAuthController@site')->middleware('auth:web')->name('site');
Route::get('admin','Auth\customAuthController@admin')->middleware('auth:admin')->name('admin');

Route::get('admin/login','Auth\customAuthController@adminlogin')->name('admin.login');
Route::post('admin/login','Auth\customAuthController@checkAdminLogin')->name('save.admin.login');

######################## End Authentication && Guards ####################################
Route::get('back',function(){
    return 'not adult';
})->name('back');
 ########################### Begin Relations Routes #########################


                ################ ONE TO ONE RELATION ##############
Route::get('has-one','RelationController@hasOneRelation');
Route::get('has-one-reverse','RelationController@hasOneRelationReverse');
     
                 ################ ONE TO MANY RELATION ##############

 Route::get('hospital-has-many','RelationController@getHospitalDoctors');
 
 Route::get('hospital-index','RelationController@getAllHospital')->name('hospital-index');
 
 Route::get('doctors-index/{hospital_id}','RelationController@getAllDoctors')->name('doctors-index');

 Route::get('hospital-delete/{hospital_id}','RelationController@deleteHospital')->name('hospital-delete');

               ################ MANY TO MANY RELATIONSHIP ##############

 Route::get('doctors/services','RelationController@getDoctorService');
 Route::get('doctors-services/{doctor_id}','RelationController@getService')->name('doctors-services');
 Route::post('save-doctor-service','RelationController@saveDoctorService')->name('save-doctor-service');

     ########################### End Relations Routes #########################
