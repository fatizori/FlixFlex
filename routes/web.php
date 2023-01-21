<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\TvshowsController;
use App\Http\Controllers\FavoritesController;


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

/*Movies Routes  */
Route::get('/',[MoviesController::class, 'index'])->name('movies.index');
Route::get('/movies/{movie}',[MoviesController::class, 'show'])->name('movies.show');

/*TV Show Routes  */
Route::get('/tvshows',[TvshowsController::class, 'index'])->name('tvshows.index');
Route::get('/tvshows/{tvshow}',[TvshowsController::class, 'show'])->name('tvshows.show');

/*Favorites Routes  */
Route::get('/favorites',[FavoritesController::class, 'movies'])->name('favorites.movies')->middleware('auth:sanctum');
Route::get('/favorites/tvs',[FavoritesController::class, 'tvshows'])->name('favorites.tvshows')->middleware('auth:sanctum');
Route::post('/favorites/{item}/{type}',[FavoritesController::class, 'store'])->name('favorites.store')->middleware('auth:sanctum');
Route::delete('/favorites/{item}',[FavoritesController::class, 'destroy'])->name('favorites.delete')->middleware('auth:sanctum');
