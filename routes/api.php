<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiKategori;
use App\Http\Controllers\API\ApiBuku;

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

Route::get('/family', [ApiKategori::class, 'getData']);
Route::get('/family/show/{id}', [ApiKategori::class, 'show']);
Route::post('/family/store', [ApiKategori::class, 'store']);
Route::post('/family/update/{id}', [ApiKategori::class, 'update']);
Route::delete('/family/destroy/{id}', [ApiKategori::class, 'destroy']);

Route::get('/libro', [ApiBuku::class, 'index']);
Route::get('/libro/show/{id}', [ApiBuku::class, 'show']);
Route::post('/libro/store', [ApiBuku::class, 'store']);
Route::post('/libro/update/{id}', [ApiBuku::class, 'update']);
Route::delete('/libro/destroy/{id}', [ApiBuku::class, 'destroy']);
