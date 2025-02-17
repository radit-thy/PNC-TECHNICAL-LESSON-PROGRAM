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
Route ::get('/posts', function() {
    return [
        "Hello",
        "World"
    ];
});

Route ::get('/users', function(){
    $users =[
        [
            "id" => 1,
            "name" => "radit"
        ],
        [
            "id" => 2,
            "name" => "rady"
        ],
        [
            "id" => 3,
            "name" => "rado"
        ],
    ];
    return $users;
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
