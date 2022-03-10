<?php

use Illuminate\Support\Facades\Route;
// Add
use App\Http\Controllers\WelcomeController;
//Main
use App\Http\Controllers\Main\DashboardController;
use App\Http\Controllers\Main\UserController;
use App\Http\Controllers\Main\AppointmentController;
use App\Http\Controllers\Main\TherapyRoomController;
//Settings
use App\Http\Controllers\Settings\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return view('index');
});

Auth::routes();

/*
|--------------------------------------------------------------------------
| Home Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


/*
|--------------------------------------------------------------------------
| Welcome Routes
|--------------------------------------------------------------------------
|
*/
Route::get('welcome', [WelcomeController::class, 'index'])->name('welcome');


/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
*/
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Users Routes
|--------------------------------------------------------------------------
|
*/
Route::resource('users', UserController::class);


/*
|--------------------------------------------------------------------------
| appointments Routes
|--------------------------------------------------------------------------
|
*/
Route::resource('appointments', AppointmentController::class);
Route::put('appointments', [AppointmentController::class, 'filterAppointments'])->name('appointments-filter');
Route::post('update-appointment', [AppointmentController::class, 'updateAppointmentStatus'])->name('update-appointment-status');


/*
|--------------------------------------------------------------------------
| therapy-rooms Routes
|--------------------------------------------------------------------------
|
*/
Route::resource('therapy-rooms', TherapyRoomController::class);


/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
|
*/
Route::resource('profile', ProfileController::class);



/*
|--------------------------------------------------------------------------
| Clear Cache Routes
|--------------------------------------------------------------------------
*/
Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('storage:link');
    return redirect()->back()->with('success', 'Commands executed successfully!');
});
