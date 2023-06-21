<?php

use App\Http\Controllers\MpesaTransactionController;
use App\Models\MpesaTransaction;
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
Route::prefix('/v1')->group(function() {
    Route::post('/access/token', [MpesaTransactionController::class, 'generateAccessToken']);
    Route::post('/quiz/stk/push', [MpesaTransactionController::class, 'customerMpesaSTKPush']);
    Route::post('/quiz/validation', [MpesaTransactionController::class, 'mpesaValidation']);
    Route::post('/quiz/transaction/confirmation', [MpesaTransactionController::class, 'mpesaConfirmation']);
});
