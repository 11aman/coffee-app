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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('add_oragnisation','organisationAPI@add_oragnisation');
Route::any('Organisation_view','organisationAPI@Organisation_view');

Route::post('add_room','roomAPI@add_room');
Route::any('Rooms_view','roomAPI@Rooms_view');

Route::post('addpantry','pantryAPI@addpantry');
Route::any('viewpantry','pantryAPI@viewpantry');

Route::post('addproduct','productAPI@addproduct');
Route::any('viewproduct','productAPI@viewproduct');