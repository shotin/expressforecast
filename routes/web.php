<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController as Home;
use App\Http\Controllers\TimetableController as Timetable;
use App\Http\Controllers\WinningHistoryController as History;
use App\Http\Controllers\ResultsController as Results;
use App\Http\Controllers\ForecastController as Forecast;
use App\Http\Controllers\Auth\AdminAuthController as AdminAuth;
use App\Http\Controllers\AdminController as Admin;
use App\Http\Controllers\ImageController as Image;
use App\Http\Controllers\ViewController as ViewMore;

use Illuminate\Support\Facades\Http;

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
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::group( ['middleware' => ['auth']], function () {
    //only verified account can access with this group
    Route::group( ['middleware' => ['verified']], function () {
        Route::get('/home', [Home::class, 'index'])->name('home');
        Route::get('/logout', [Home::class, 'logout'])->name('user.logout');
        Route::get('/timetable', [Timetable::class, 'index'])->name('timetable.home');
        Route::get('/winning/history', [History::class, 'index'])->name('winning.history');
        Route::get('/results', [Results::class, 'index'])->name('results');
        Route::get('/viewmore/{operator_id}', [ViewMore::class, 'index'])->name('viewmore');
        Route::get('/forecast', [Forecast::class, 'index'])->name('forecasts');
    });
});

Route::get('/todays/forecasts', [Forecast::class, 'todayForecast'])->name('forecasts.today');
Route::get('/todays/results', [Results::class, 'todayResults'])->name('results.today');
Route::get('admin/login', [AdminAuth::class, 'getLogin'])->name('adminLogin');
Route::post('admin/login', [AdminAuth::class, 'postLogin'])->name('adminLoginPost');
Route::get('admin/logout', [AdminAuth::class, 'logout'])->name('adminLogout');
Route::post('/upload', [Image::class, 'upload']);
Route::put('/edit/{id}', [Image::class, 'edit']);
Route::delete('/delete/{id}', [Image::class, 'delete']);


Route::post('select-game', [History::class, 'show']);
Route::post('filter-game', [History::class, 'show_js']);
Route::group(['prefix' => 'admin','middleware' => 'adminauth'], function () {
    Route::get('/dashboard', [Admin::class, 'dashboard'])->name('dashboard');
    Route::get('/registerusers', [Admin::class, 'registerusers'])->name('registerusers');
});
// Route::get('/getme', [Home::class, 'gamesDatabase'])->name('home');