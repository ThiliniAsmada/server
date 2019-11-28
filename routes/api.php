<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register','Api\AuthController@register');
Route::post('/login','Api\AuthController@login');
Route::get('/profileRetrieve/{id}','Api\AuthController@profileRetrieve');
Route::get('/profileTripsRetrieve/{id}','Api\AuthController@profileTripsRetrieve');
Route::get('/profileRetrieveGuide/{id}','Api\AuthController@profileRetrieveGuide');
Route::put('/profileUpdate/{id}','Api\AuthController@profileUpdate');
Route::put('/profilePicture/{id}','Api\AuthController@profilePicture');
Route::get('/retrieveTimeline','Api\AuthController@retrieveTimeline');
Route::get('/retrieveGuides','Api\AuthController@retrieveGuides');
Route::post('/addTimeline','Api\AuthController@addTimeline');
Route::get('/retrieveTimeline','Api\AuthController@retrieveTimeline');
Route::post('/makeTour','Api\AuthController@makeTour');
Route::post('/completeTour','Api\AuthController@completeTour');
Route::get('/retrieveRequestedTours','Api\AuthController@retrieveRequestedTours');
Route::put('/tripStatusUpdate/{id}','Api\AuthController@tripStatusUpdate');
Route::get('/retrieveOngoingTrip','Api\AuthController@retrieveOngoingTrip');
Route::put('/guideRating/{id}','Api\AuthController@guideRating');
Route::post('/updateAvatar','Api\AuthController@update');
// Route::post('/updateAvatar','Api\UserAvatarController@update’ );


//Guides apis
Route::get('/tripRequests/{id}','Api\AuthController@tripRequests');
Route::get('/currentTrip/{id}','Api\AuthController@currentTrip');


