<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'settings'], function () {


    Route::get('how_to_get_points',[\App\Http\Controllers\Api\HowToGetPointApiController::class,'index']);
    Route::get('how_to_redeem',[\App\Http\Controllers\Api\HowToRedeemApiController::class,'index']);
    Route::get('offers',[\App\Http\Controllers\Api\OfferApiController::class,'index']);
    Route::get('clients',[\App\Http\Controllers\Api\ClientApiController::class,'index']);
    Route::get('user_types_by_client',[\App\Http\Controllers\Api\UserTypeApiController::class,'index']);
    Route::get('charities',[\App\Http\Controllers\Api\CharityApiController::class,'index']);
    Route::get('stores',[\App\Http\Controllers\Api\StoreApiController::class,'index']);
    Route::get('levels_by_client',[\App\Http\Controllers\Api\LevelApiController::class,'index']);
    Route::get('governorates',[\App\Http\Controllers\Api\GovernorateApiController::class,'index']);
    Route::get('active_services',[\App\Http\Controllers\Api\ServiceApiController::class,'index']);


    ### points

    Route::get('pointsForUser',[\App\Http\Controllers\Api\PointApiController::class,'pointsForUser']);
    Route::post('addPointsForUser',[\App\Http\Controllers\Api\PointApiController::class,'addPointsForUser']);
    Route::post('convert_point_to_money',[\App\Http\Controllers\Api\PointApiController::class,'convert_point_to_money']);
    Route::post('convert_point_to_donation',[\App\Http\Controllers\Api\PointApiController::class,'convert_point_to_donation']);
    Route::post('add_indoor_offer',[\App\Http\Controllers\Api\PointApiController::class,'add_indoor_offer']);
    Route::post('add_outdoor_offer',[\App\Http\Controllers\Api\PointApiController::class,'add_outdoor_offer']);
    Route::post('point_to_money',[\App\Http\Controllers\Api\PointApiController::class,'point_to_money']);
    Route::post('point_to_coupon',[\App\Http\Controllers\Api\PointApiController::class,'point_to_coupon']);



   ### converts
    Route::get('converts',[\App\Http\Controllers\Api\ConvertApiController::class,'index']);



    ####  transactions

    Route::get('transactions',[\App\Http\Controllers\Api\TransactionApiController::class,'index']);




});


Route::group(['prefix' => 'App_stores'], function () {



    Route::post('login_app_store',[\App\Http\Controllers\Api\AppStore\AuthController::class,'login']);

    Route::get('store_offer_code',[\App\Http\Controllers\Api\AppStore\StoreOfferController::class,'store_offer_code']);

    Route::get('store_offer_code_used',[\App\Http\Controllers\Api\AppStore\StoreOfferController::class,'store_offer_code_used']);

    Route::get('offer_code_details',[\App\Http\Controllers\Api\AppStore\StoreOfferController::class,'offer_code_details']);


    Route::post('confirm_offer_code',[\App\Http\Controllers\Api\AppStore\StoreOfferController::class,'confirm_offer_code']);


    Route::post('app_store_update_profile',[\App\Http\Controllers\Api\AppStore\StoreOfferController::class,'app_store_update_profile']);




});



Route::group(['prefix' => 'games'], function () {



    Route::get('questionCategoriesApi',[\App\Http\Controllers\Api\Games\CategoryQuestionApiController::class,'index']);

    Route::get('gamesApi',[\App\Http\Controllers\Api\Games\GamesApiController::class,'index']);

    Route::get('userGames',[\App\Http\Controllers\Api\Games\GamesApiController::class,'userGames']);


    Route::get('playGame',[\App\Http\Controllers\Api\Games\GamesApiController::class,'playGame']);


    Route::post('gameDayAnswer',[\App\Http\Controllers\Api\Games\GamesApiController::class,'gameDayAnswer']);





});











