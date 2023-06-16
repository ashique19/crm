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

Route::middleware('auth:api')->get(
    '/user', function (Request $request) {
        return $request->user();
    }
);
Route::post('/leads.json', 'Api\LeadController@index');
Route::post('/analytics.json', 'Api\AnalyticController@index');
Route::post('/appointments.json', 'Api\AppointmentController@appointments');
Route::get('/appointments.json', 'Api\AppointmentController@availabilities');
Route::get('/services.json', 'Api\AppointmentController@services');
Route::post('/review.json', 'Api\ReviewController@index');
Route::group(
    ['middleware' => ['auth:api', 'subscription.active:api']], function () {
        Route::get(
            '/protected', function () {
                return response('You are in', 200);
            }
        );
    }
);