<?php

use App\Http\Controllers\GoogleAdsController;
use Illuminate\Support\Facades\Route;

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
    return redirect('google-ads-demo');
});

Route::get('/google-ads-demo', [GoogleAdsController::class, 'index'])->name('google-ads-demo');
