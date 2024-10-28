<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

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
// Route::middleware(['cors'])->group(function () {
//     Route::post('/login', [LoginController::class, 'login']);
//     Route::post('auth/register', [RegisterController::class, 'register']);

// });
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/auth/register', [RegisterController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users', [UsersController::class, 'get_All_Users']);
    Route::get('/users/{id}', [UsersController::class, 'get_User']);
    Route::post('/add_user', [UsersController::class, 'store']);
    Route::put('/users/{id}', [UsersController::class, 'update']);
    Route::delete('/users/{id}', [UsersController::class, 'destroy']);

    Route::get('/company', [CompanyController::class, 'get_All_Company']);
    Route::get('/company/{id}', [CompanyController::class, 'get_Company']);
    Route::post('/add_company', [CompanyController::class, 'store']);
    Route::put('/company/{id}', [CompanyController::class, 'update']);
    Route::delete('/company/{id}', [CompanyController::class, 'destroy']);

    Route::get('/package', [CompanyController::class, 'get_All_Packages']);
    Route::get('/package/{id}', [CompanyController::class, 'get_Package']);
    Route::post('/add_package', [CompanyController::class, 'store']);
    Route::put('/package/{id}', [CompanyController::class, 'update']);
    Route::delete('/package/{id}', [CompanyController::class, 'destroy']);

    Route::get('/shipping', [ShippingController::class, 'get_All_Shipping']);
    Route::get('/shipping/{id}', [ShippingController::class, 'get_Shipping']);
    Route::post('/add_shipping', [ShippingController::class, 'store']);
    Route::put('/shipping/{id}', [ShippingController::class, 'update']);
    Route::delete('/shipping/{id}', [ShippingController::class, 'destroy']);

    Route::get('/costs', [CostController::class, 'get_All_Costs']);
    Route::get('/costs/{id}', [CostController::class, 'get_Cost']);
    Route::post('/add_cost', [CostController::class, 'store']);
    Route::put('/costs/{id}', [CostController::class, 'update']);
    Route::delete('/costs/{id}', [CostController::class, 'destroy']);

    Route::get('/origin_countries', [OriginCountryController::class, 'get_All_OriginCountries']);
    Route::get('/origin_countries/{id}', [OriginCountryController::class, 'get_OriginCountry']);
    Route::post('/add_origin_country', [OriginCountryController::class, 'store']);
    Route::put('/origin_countries/{id}', [OriginCountryController::class, 'update']);
    Route::delete('/origin_countries/{id}', [OriginCountryController::class, 'destroy']);

    Route::get('/destination_countries', [DestinationCountryController::class, 'get_All_DestinationCountries']);
    Route::get('/destination_countries/{id}', [DestinationCountryController::class, 'get_DestinationCountry']);
    Route::post('/add_destination_country', [DestinationCountryController::class, 'store']);
    Route::put('/destination_countries/{id}', [DestinationCountryController::class, 'update']);
    Route::delete('/destination_countries/{id}', [DestinationCountryController::class, 'destroy']);
    Route::get('/destination_countries', [DestinationCountryController::class, 'get_All_DestinationCountries']);
    Route::get('/destination_countries/{id}', [DestinationCountryController::class, 'get_DestinationCountry']);
    Route::post('/add_destination_country', [DestinationCountryController::class, 'store']);
    Route::put('/destination_countries/{id}', [DestinationCountryController::class, 'update']);
    Route::delete('/destination_countries/{id}', [DestinationCountryController::class, 'destroy']);



});
