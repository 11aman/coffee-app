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
//For Organisation
Route::get('organisation', 'OrganisationController@getAllOrganisation');
Route::get('organisation/{id}', 'OrganisationController@getOrganisation');
Route::post('organisation', 'OrganisationController@saveOrganisation');
Route::post('organisation/{id}', 'OrganisationController@updateOrganisation');
Route::delete('organisation/{id}','OrganisationController@deleteOrganisation');

//For Rooms
Route::get('room', 'RoomController@getAllRoom');
Route::get('organisationRoom/{id}', 'RoomController@getAllOrganisationRoom');
Route::get('room/{id}', 'RoomController@getRoom');
Route::post('room', 'RoomController@saveRoom');
Route::put('room/{id}', 'RoomController@updateRoom');
Route::delete('room/{id}','RoomController@deleteRoom');

//For Pantry
Route::get('pantries', 'PantryController@getAllPantries');
Route::get('organisationPantries/{id}', 'PantryController@getOrganisationPantries');
Route::get('pantry/{id}', 'PantryController@getPantry');
Route::post('pantry', 'PantryController@savePantry');
Route::put('pantry/{id}', 'PantryController@updatePantry');
Route::delete('pantry/{id}','PantryController@deletePantry');


//For Products
Route::get('product', 'ProductController@getAllProducts');
Route::get('product/{id}', 'ProductController@getProduct');
Route::post('product', 'ProductController@saveProduct');
Route::post('product/{id}', 'ProductController@updateProduct');
Route::delete('product/{id}','ProductController@deleteProduct');



// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//For User
Route::get('user', 'UserController@getAllUsers');
Route::post('register', 'UserController@AddUser');
