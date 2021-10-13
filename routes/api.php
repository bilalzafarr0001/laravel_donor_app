<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BloodDonors;
use App\Http\Controllers\AdminLogin;
use App\Http\Controllers\MailController;

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

Route::get('/users', [BloodDonors::class, 'getUsers']);
Route::get('/user/{id}', [BloodDonors::class, 'getSingleUser']);
Route::post('/users', [BloodDonors::class, 'createUser']);
Route::delete('/user/{id}', [BloodDonors::class, 'deleteUser']);
Route::put('/user/{id}', [BloodDonors::class, 'updateUser']);

Route::post('/admin', [AdminLogin::class, 'loginUser']);
Route::get('/admin', [AdminLogin::class, 'signOut']);


Route::post('/send-email', [MailController::class, 'sendEmail']);
