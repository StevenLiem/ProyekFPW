<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
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

Route::get('show/{id}', [SiteController::class, 'gotoDetail'])->name('detail');
Route::get('show/{id}/{page}', [SiteController::class, 'read'])->name('read');

Route::get('artist', [SiteController::class, 'gotoArtist'])->name('artist');
Route::get('artist/{name}', [SiteController::class, 'searchArtist']);
Route::get('author', [SiteController::class, 'gotoAuthor'])->name('author');
Route::get('author/{name}', [SiteController::class, 'searchAuthor']);
Route::get('genre', [SiteController::class, 'gotoGenre'])->name('genre');
Route::get('genre/{name}', [SiteController::class, 'searchGenre']);
Route::get('random', [SiteController::class, 'randomManga'])->name('random');

Route::get('search', [SiteController::class, 'search'])->name('search');

Route::middleware(['CheckRole:user'])->group(function () {
    Route::post('show/{id}/addComment', [UserController::class, 'addComment']);
    Route::post('show/{id}/addFavorite', [UserController::class, 'addFavorite']);
    Route::get('favorite', [UserController::class, 'gotoFavorite'])->name('favorite');
    Route::get('notify', [UserController::class, 'toNotification'])->name('notify');
});

Route::prefix('admin')->middleware(['CheckRole:admin'])->group(function () {
    Route::get('/', [AdminController::class, 'gotoAdmin'])->name('master');
    Route::get('/masterManga', [AdminController::class, 'gotoMasterManga'])->name('masterManga');
    Route::get('/addManga', [AdminController::class, 'gotoAddManga'])->name('addManga');
    Route::get('/banUser/{id}', [AdminController::class, 'banUser']);

    Route::post('/addNewManga', [AdminController::class, 'addNewManga']);
    Route::get('/deleteManga/{id}', [AdminController::class, 'deleteManga']);

    Route::post('/addAuthor', [AdminController::class, 'addAuthor']);
    Route::post('/addArtist', [AdminController::class, 'addArtist']);
    Route::post('/addGenre', [AdminController::class, 'addGenre']);
    Route::post('/updateAuthor/{id}', [AdminController::class, 'updateAuthor']);
    Route::post('/updateArtist/{id}', [AdminController::class, 'updateArtist']);
    Route::post('/updateGenre/{id}', [AdminController::class, 'updateGenre']);
});

Route::prefix('user')->middleware(['CheckRole:user'])->group(function () {
    Route::get('/profile', [UserController::class, 'gotoProfile']);
    Route::post('/update', [UserController::class, 'updateProfile']);
    Route::post('/toPremium', [UserController::class, 'becomePremium']);
});
