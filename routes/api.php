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
Route::post('saveorganisation', 'OrganisationController@saveOrganisation');
Route::put('organisation/{id}', 'OrganisationController@updateOrganisation');
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

//For Pantrydevices
Route::get('devices','PantryDeviceController@getAllDevices');
Route::get('pantrydevices/{id}','PantryDeviceController@getAllPantryDevices');
Route::get('device/{id}', 'PantryDeviceController@getDevice');
Route::post('pantrydevice', 'PantryDeviceController@savePantryDevice');
Route::put('updatedevice/{id}', 'PantryDeviceController@updateDevice');
Route::delete('deletedevice/{id}','PantryDeviceController@deleteDevice');


//for Orders
Route::get('orders','OrderController@getAllOrders');
Route::get('orders/{id}','OrderController@getOrder');
Route::post('order', 'OrderController@saveOrder');
Route::put('updateorder/{id}', 'OrderController@updateOrder');
Route::delete('deleteorder/{id}','OrderController@deleteOrder');

//for OrderProducts
Route::get('orderproducts','OrderProductController@getAllOrderProducts');
Route::get('orderproduct/{id}','OrderProductController@getOrderProduct');
Route::post('orderproduct', 'OrderProductController@saveOrderProduct');
Route::put('updateorderproduct/{id}','OrderProductController@updateOrderProduct');
Route::delete('deleteorderproduct/{id}','OrderProductController@deleteOrderProduct');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
