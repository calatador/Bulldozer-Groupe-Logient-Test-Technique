<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\DashboardController;
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
    return redirect(app()->getLocale());
});


Route::prefix('{locale}')->where(['locale' => '[a-zA-Z]{2}'])->middleware('setlocale')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});


require __DIR__.'/auth.php';

Route::prefix('{locale}')->where(['locale' => '[a-zA-Z]{2}'])->middleware(['auth' , 'setlocale' ])->group(function () {
    Route::post('/short', [ShortUrlController::class, 'short'])->name('short.url');
    Route::get('/delete/{id}', [ShortUrlController::class, 'delete'])->name('short.delete');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/stats/{id}', [ShortUrlController::class, 'showLog'])->name('showLog');

});

Route::get('/{code}', [ShortUrlController::class, 'show'])->name('short.show');


