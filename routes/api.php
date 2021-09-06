<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostApicontroller;
use App\Http\Controllers\UserApicontroller;

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

//books routes
Route::get('/getAll',[PostApicontroller::class,'index']);


//user routes
Route::post('user/register',[UserApiController::class,'register']);
Route::post('user/login',[UserApiController::class,'login']);




//protected aoutes

Route::group(['middleware' => ['auth:sanctum']], function(){
    //book register routes
    Route::post('/register',[PostApicontroller::class,'store']);
    
    //user routes
    Route::post('user/logout',[UserApiController::class,'logout']);
});


