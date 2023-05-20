<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\PlayController;

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

// Route::get('/', [KanjiController::class,"index"])->name('index');
// Route::resource('/language', [KanjiController::class,"language"])->name('language');
// Route::get('/next', [KanjiController::class,"next"]);

Route::get('/', [LanguageController::class,"index"]);
Route::resource('language', LanguageController::class);
Route::resource('category', CategoriesController::class);
Route::resource('card', CardsController::class);
Route::resource('play', PlayController::class);
Route::get('language_index', [LanguageController::class,"language"])->name('language_index');
Route::get('select_category/{id}', [PlayController::class,"edit"])->name('select_category');
Route::get('next/{id_category}/{id_language}', [PlayController::class,"next"])->name('next');
Route::get('finish/{id_category}', [PlayController::class,"finish"])->name('finish');

