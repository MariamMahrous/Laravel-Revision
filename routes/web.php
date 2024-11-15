<?php
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Controllers\OfferContoller;
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

########################AJAX ROUTES ####################################
Route::group(['prefix'=>'ajax-offers'] ,function(){

    Route::get('create','AjaxOfferController@create');
    Route::post('store','AjaxOfferController@store')->name('ajax.offers.store');



});