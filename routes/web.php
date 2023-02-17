<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KanjiController;

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

Route::get('/', [KanjiController::class,"index"])->name('index');
Route::get('/language', [KanjiController::class,"language"])->name('language');
Route::get('/next', [KanjiController::class,"next"]);
