<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginregisController;
use App\Http\Controllers\UserprofileController;

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

Route::get('/', 'DashboardController@index')->middleware('auth');

Route::get('/userprofile', [UserprofileController::class, 'index'])->name('user.index')->middleware('auth');
Route::put('/userupdate', [UserprofileController::class, 'update'])->name('user.update')->middleware('auth');
Route::post('change/password/db', [UserprofileController::class, 'changePasswordDB'])->name('change/password/db');

Route::controller(LoginregisController::class)->group(function () {
    Route::post('/login',  'authenticate')->middleware('guest');
    Route::post('/logout',  'logout')->middleware('auth');
    Route::get('/loginregis', 'index')->name('login')->middleware('guest');
    Route::post('/regis', 'store')->middleware('guest');
});
Route::resource('catatanperjalanan', CatatanperjalananController::class)->middleware('auth');

use App\Http\Controllers\CatatanperjalananController;

Route::get('/search', [CatatanperjalananController::class, 'search'])->name('search');
