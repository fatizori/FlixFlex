<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\TvshowsController;


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

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');*/

/*Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});*/
