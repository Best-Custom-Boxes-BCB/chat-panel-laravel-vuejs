<?php

use App\Http\Controllers\Admin\Visitor\VisitorController;
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

Route::controller(VisitorController::class)->group(
    function(){
        Route::get('live-visitor','VisitorPage');
        Route::get('change-status/{id}','changeStatus');
    }
);
