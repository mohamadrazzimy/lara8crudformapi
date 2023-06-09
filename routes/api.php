<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DevController;
use App\Http\Controllers\CommonController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {

    /* dev controller test */
    Route::get('/init',[DevController::class,'init']);
    Route::get('/table',[DevController::class,'get_table']);
    Route::get('/{table}/desc',[DevController::class,'get_table_description']);

    /* common controller test */
    Route::get('/{table}/record',[CommonController::class,'get_table_record']);
    Route::get('/{table}/{record_where}/{field}/{value}',[CommonController::class,'get_table_record_where'])
    ->where(['record_where' =>'record_where|recordw']);

    Route::get('/insert/{json?}',[CommonController::class,'get_insert_record']);
    Route::post('/insert',[CommonController::class,'post_insert_record']);

    Route::get('/update/{json?}',[CommonController::class,'get_update_record']);
    Route::post('/update',[CommonController::class,'post_update_record']);

    Route::get('/delete/{json?}',[CommonController::class,'get_delete_record']);
    Route::post('/delete',[CommonController::class,'post_delete_record']);

});