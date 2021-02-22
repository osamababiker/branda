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

Route::group([
    'prefix' => 'auth'
], function () {
    Route::get('test', 'AuthController@test');
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});
#====== phone verifiction ======#
Route::get('/user/verifi/{phone}','AuthController@verifiction');
#====== Update user info  ======#
Route::put('/user/update','ProfileController@update');
// ==============================================//

#====== List All agar's ======#
Route::get('/agar/list/with_paginate', 'AgarController@get_agar_with_paginate');
Route::get('/agar/list/without_paginate', 'AgarController@get_agar_without_paginate');
# ===== get agars for spacific user === #
Route::get('/agar/list/{user_id}','AgarController@get_agar_with_user_id');
#====== List single agar ======#
Route::get('/agar/{id}','AgarController@show');
#====== List Last added agar ======#
Route::get('/agar/lastAdded','AgarController@lastAdded');
#===== add new agar =============#
Route::post('/agar/add','AgarController@store');
#===== delete agar =============#
Route::delete('/agar/delete','AgarController@destroy');
#===== udate agar  info=============#
Route::put('/agar/update','AgarController@update');
#===== update agar b_extra info=============#
Route::put('/agar/update/b_extra','AgarController@agar_update_b_extra');
#===== update agar a_extra info=============#
Route::put('/agar/update/a_extra','AgarController@agar_update_a_extra');
#===== update agar sf_extra info=============#
Route::put('/agar/update/sf_extra','AgarController@agar_update_sf_extra');
#===== update agar condition info=============#
Route::put('/agar/update/agar_condition','AgarController@agar_update_condition');
#===== update agar price info=============#
Route::put('/agar/update/price','AgarController@agar_update_price');
#===== update agar calendar info=============#
Route::post('/agar/add/calendar','AgarController@agar_add_calendar');
Route::put('/agar/update/calendar','AgarController@agar_update_calendar');
Route::delete('/agar/delete/calendar','AgarController@agar_delete_calendar');
#========= delete agar image  ====== #
Route::delete('/agar/delete/image','AgarController@agar_delete_image');
#========= add agar image  ====== #
Route::post('/agar/add/image','AgarController@agar_add_image');


#======= search agar by name ==========#
Route::get('/agar/list/search/{query}','AgarController@search_by_name_api');
Route::post('/agar/list/filter','AgarController@agar_filter_api'); 
// ===========================================================//

# ========== list reservation for user ==============#
Route::get('/reserv/list/{user_id}', 'reservationController@get_reserv_with_user_id');
# ========== list new reservation for user ==============#
Route::get('/reserv/new/{user_id}', 'reservationController@get_new_reserv_with_user_id');
# ========== list accepted reservation for user ==============#
Route::get('/reserv/accepted/{user_id}', 'reservationController@get_accepted_reserv_with_user_id');
# ========== list confirmable reservation for user ==============#
Route::get('/reserv/confirmable/{user_id}', 'reservationController@get_confirmable_reserv_with_user_id');

# ========== get single reservation for spacific user  ==============#
Route::get('/reserv/{user_id}/{id}', 'reservationController@show');
# ========== to add new reservation ==============#
Route::post('/reserv/add', 'reservationController@store');
# ========== to update single reservation to be accepted ==============#
Route::put('/reserv/update', 'reservationController@update');
# ========== to destroy single reservation ==============#
Route::delete('/reserv/delete', 'reservationController@destroy');
