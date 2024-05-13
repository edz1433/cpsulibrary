<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ReportsController;
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

    Route::get('/log',[LoginController::class,'loginUserView'])->name('loginUserView');
    Route::post('/get-user', [MonitoringController::class, 'getUserType'])->name('getUserType');

    Route::group(['middleware'=>['guest']],function(){
        Route::get('/', function () {
            return view('login');
        });

        Route::get('/login',[LoginController::class,'loginView'])->name('getLogin');
        Route::post('/login/auth',[LoginController::class,'loginAuthenticate'])->name('postLogin');
    });

    Route::group(['middleware'=>['login_auth']],function(){
        Route::get('/dashboard',[dashboardController::class,'dashboard'])->name('dashboard');

        Route::prefix('/monitoring')->group(function () {
            Route::get('/list', [MonitoringController::class,'monitorRead'])->name('monitorRead');
        });

        Route::prefix('/reports')->group(function () {
            Route::get('/', [ReportsController::class,'reportsForm'])->name('reportsForm');
            Route::post('/', [ReportsController::class,'reportsForm'])->name('reportsForm');
            Route::get('/gen', [ReportsController::class,'reportsPdf'])->name('reportsPdf');
        });

        //Users
        Route::prefix('/users')->group(function () {
            Route::get('/list',[UserController::class,'userRead'])->name('userRead');
            Route::post('/list', [UserController::class, 'userCreate'])->name('userCreate');
            Route::get('list/edit/{id}', [UserController::class, 'userEdit'])->name('userEdit');
            Route::post('list/update', [UserController::class, 'userUpdate'])->name('userUpdate');
            Route::get('list/delete/{id}', [UserController::class, 'userDelete'])->name('userDelete');
        });

        Route::prefix('/settings')->group(function () {
            Route::get('/account', [SettingsController::class,'accountRead'])->name('accountRead');
        });
        Route::get('/logout',[DashboardController::class,'logout'])->name('logout');
    });

    
    Route::get('/log-check', [MonitoringController::class, 'logAttendance'])->name('logAttendance')->withoutMiddleware('login_auth');
    Route::get('/log-check-manual', [MonitoringController::class, 'logAttendanceManual'])->name('logAttendanceManual')->withoutMiddleware('login_auth');
