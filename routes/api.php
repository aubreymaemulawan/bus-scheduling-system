<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BusController;
use App\Http\Controllers\BustypeController;
use App\Http\Controllers\BusstatusController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DaccountController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\DispatcherController;
use App\Http\Controllers\FareController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ScheduleTransactionController;
use App\Http\Controllers\StatusTripController;


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

//Bus
Route::match(['get','post',], 'bus/list', [BusController::class,'list']);
Route::match(['get','post',], 'bus/items', [BusController::class,'items']);
Route::match(['get','post',], 'bus/create', [BusController::class,'create']);
Route::match(['get','post',], 'bus/update', [BusController::class,'update']);
Route::match(['get','post',], 'bus/delete', [BusController::class,'delete']);

//Bustype
Route::match(['get','post',], 'bustype/list', [BustypeController::class,'list']);
Route::match(['get','post',], 'bustype/items', [BustypeController::class,'items']);
Route::match(['get','post',], 'bustype/create', [BustypeController::class,'create']);
Route::match(['get','post',], 'bustype/update', [BustypeController::class,'update']);
Route::match(['get','post',], 'bustype/delete', [BustypeController::class,'delete']);

//Busstatus
Route::match(['get','post',], 'busstatus/list', [BusstatusController::class,'list']);
Route::match(['get','post',], 'busstatus/items', [BusstatusController::class,'items']);
Route::match(['get','post',], 'busstatus/create', [BusstatusController::class,'create']);
Route::match(['get','post',], 'busstatus/update', [BusstatusController::class,'update']);
Route::match(['get','post',], 'busstatus/delete', [BusstatusController::class,'delete']);

//Company
Route::match(['get','post',], 'company/list', [CompanyController::class,'list']);
Route::match(['get','post',], 'company/items', [CompanyController::class,'items']);
Route::match(['get','post',], 'company/create', [CompanyController::class,'create']);
Route::match(['get','post',], 'company/update', [CompanyController::class,'update']);
Route::match(['get','post',], 'company/delete', [CompanyController::class,'delete']);

//Daccount
Route::match(['get','post',], 'daccount/list', [DaccountController::class,'list']);
Route::match(['get','post',], 'daccount/items', [DaccountController::class,'items']);
Route::match(['get','post',], 'daccount/create', [DaccountController::class,'create']);
Route::match(['get','post',], 'daccount/update', [DaccountController::class,'update']);
Route::match(['get','post',], 'daccount/delete', [DaccountController::class,'delete']);

//Discount
Route::match(['get','post',], 'discount/list', [DiscountController::class,'list']);
Route::match(['get','post',], 'discount/items', [DiscountController::class,'items']);
Route::match(['get','post',], 'discount/create', [DiscountController::class,'create']);
Route::match(['get','post',], 'discount/update', [DiscountController::class,'update']);
Route::match(['get','post',], 'discount/delete', [DiscountController::class,'delete']);

//Dispatcher
Route::match(['get','post',], 'dispatcher/list', [DispatcherController::class,'list']);
Route::match(['get','post',], 'dispatcher/items', [DispatcherController::class,'items']);
Route::match(['get','post',], 'dispatcher/create', [DispatcherController::class,'create']);
Route::match(['get','post',], 'dispatcher/update', [DispatcherController::class,'update']);
Route::match(['get','post',], 'dispatcher/delete', [DispatcherController::class,'delete']);


//Fare
Route::match(['get','post',], 'fare/list', [FareController::class,'list']);
Route::match(['get','post',], 'fare/items', [FareController::class,'items']);
Route::match(['get','post',], 'fare/create', [FareController::class,'create']);
Route::match(['get','post',], 'fare/update', [FareController::class,'update']);
Route::match(['get','post',], 'fare/delete', [FareController::class,'delete']);

//Location
Route::match(['get','post',], 'location/list', [LocationController::class,'list']);
Route::match(['get','post',], 'location/items', [LocationController::class,'items']);
Route::match(['get','post',], 'location/create', [LocationController::class,'create']);
Route::match(['get','post',], 'location/update', [LocationController::class,'update']);
Route::match(['get','post',], 'location/delete', [LocationController::class,'delete']);

//Operator
Route::match(['get','post',], 'operator/list', [OperatorController::class,'list']);
Route::match(['get','post',], 'operator/items', [OperatorController::class,'items']);
Route::match(['get','post',], 'operator/create', [OperatorController::class,'create']);
Route::match(['get','post',], 'operator/update', [OperatorController::class,'update']);
Route::match(['get','post',], 'operator/delete', [OperatorController::class,'delete']);

//Route
Route::match(['get','post',], 'route/list', [RouteController::class,'list']);
Route::match(['get','post',], 'route/items', [RouteController::class,'items']);
Route::match(['get','post',], 'route/create', [RouteController::class,'create']);
Route::match(['get','post',], 'route/update', [RouteController::class,'update']);
Route::match(['get','post',], 'route/delete', [RouteController::class,'delete']);

//Schedule
Route::match(['get','post',], 'schedule/list', [ScheduleController::class,'list']);
Route::match(['get','post',], 'schedule/items', [ScheduleController::class,'items']);
Route::match(['get','post',], 'schedule/create', [ScheduleController::class,'create']);
Route::match(['get','post',], 'schedule/update', [ScheduleController::class,'update']);
Route::match(['get','post',], 'schedule/delete', [ScheduleController::class,'delete']);
Route::match(['get','post',], 'schedule/s', [ScheduleController::class,'s']);

//Status
Route::match(['get','post',], 'status/list', [StatusController::class,'list']);
Route::match(['get','post',], 'status/items', [StatusController::class,'items']);
Route::match(['get','post',], 'status/create', [StatusController::class,'create']);
Route::match(['get','post',], 'status/update', [StatusController::class,'update']);
Route::match(['get','post',], 'status/delete', [StatusController::class,'delete']);

//Transaction
Route::match(['get','post',], 'transaction/list', [TransactionController::class,'list']);
Route::match(['get','post',], 'transaction/items', [TransactionController::class,'items']);
Route::match(['get','post',], 'transaction/create', [TransactionController::class,'create']);
Route::match(['get','post',], 'transaction/update', [TransactionController::class,'update']);
Route::match(['get','post',], 'transaction/delete', [TransactionController::class,'delete']);

//Trip
Route::match(['get','post',], 'trip/list', [TripController::class,'list']);
Route::match(['get','post',], 'trip/items', [TripController::class,'items']);
Route::match(['get','post',], 'trip/create', [TripController::class,'create']);
Route::match(['get','post',], 'trip/update', [TripController::class,'update']);
Route::match(['get','post',], 'trip/delete', [TripController::class,'delete']);

//User
Route::match(['get','post',], 'user/list', [UserController::class,'list']);
Route::match(['get','post',], 'user/items', [UserController::class,'items']);
Route::match(['get','post',], 'user/create', [UserController::class,'create']);
Route::match(['get','post',], 'user/update', [UserController::class,'update']);
Route::match(['get','post',], 'user/delete', [UserController::class,'delete']);

//ScheduleTransaction
Route::match(['get','post',], 'schedule_transaction/list', [ScheduleTransactionController::class,'list']);
Route::match(['get','post',], 'schedule_transaction/items', [ScheduleTransactionController::class,'items']);
Route::match(['get','post',], 'schedule_transaction/create', [ScheduleTransactionController::class,'create']);
Route::match(['get','post',], 'schedule_transaction/update', [ScheduleTransactionController::class,'update']);
Route::match(['get','post',], 'schedule_transaction/delete', [ScheduleTransactionController::class,'delete']);

//StatusTrip
Route::match(['get','post',], 'status_trip/list', [StatusTripController::class,'list']);
Route::match(['get','post',], 'status_trip/items', [StatusTripController::class,'items']);
Route::match(['get','post',], 'status_trip/create', [StatusTripController::class,'create']);
Route::match(['get','post',], 'status_trip/update', [StatusTripController::class,'update']);
Route::match(['get','post',], 'status_trip/delete', [StatusTripController::class,'delete']);
