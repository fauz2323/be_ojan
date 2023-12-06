<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//auth routes
Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

//version
Route::get('/version', [App\Http\Controllers\Api\VersionApiController::class, 'getVersion']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    //auth
    Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::get('/auth', [App\Http\Controllers\Api\AuthController::class, 'auth']);

    //wisata
    Route::get('/wisata', [App\Http\Controllers\Api\WisataApiController::class, 'getWisata']);
    Route::get('/wisata/id/{id}', [App\Http\Controllers\Api\WisataApiController::class, 'getWisataById']);
    Route::post('/wisata/by/category', [App\Http\Controllers\Api\WisataApiController::class, 'getWisataByCategory']);
    Route::get('/wisata/category', [App\Http\Controllers\Api\WisataApiController::class, 'getCategory']);
});
