<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiteController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('', [SiteController::class, 'gotoHome'])->name('home');
Route::get('login', [SiteController::class, 'gotoLogin'])->name('login');
Route::get('register', [SiteController::class, 'gotoRegister'])->name('register');

Route::get('logout', [SiteController::class, 'logout'])->name('logout');

Route::post('doLogin', [SiteController::class, 'doLogin'])->name('doLogin');
Route::post('doRegister', [SiteController::class, 'doRegister'])->name('doRegister');

Route::prefix('admin')->middleware(['CheckRole:admin'])->group(function () {
    Route::get('/', [AdminController::class, 'gotoAdmin'])->name('master');
});
