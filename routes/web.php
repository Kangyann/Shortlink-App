<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Mail\SendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShortlinkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/p/link', function () {
    symlink(base_path() . '/storage/app/public', $_SERVER["DOCUMENT_ROOT"] . '/storage');
}); //  ADDED FOR STORAGE FILES

Route::get('/', [ShortlinkController::class, 'index']);
Route::post('/', [ShortlinkController::class, 'store'])->name('short@store');
Route::get('/{code}', [ShortlinkController::class, 'show'])->name('short@show');
Route::post('/p/send', [SendController::class, 'index'])->name('send');
Route::group(['prefix' => 'p'], function () {
    Route::get('terms', [ShortlinkController::class, 'terms'])->name('terms');
    Route::get('privacy', [ShortlinkController::class, 'privacy'])->name('privacy');
    Route::get('contact', [ShortlinkController::class, 'contact'])->name('contact');
    Route::get('api', [DashboardController::class, 'api'])->name('api');
});
Route::group(['prefix' => 'auth', 'middleware' => 'guest'], function () {
    Route::get('signin', [AuthController::class, 'signin'])->name('auth@signin');
    Route::get('reset', [AuthController::class, 'reset'])->name('auth@reset');
    Route::get('signup', [AuthController::class, 'signup'])->name('auth@signup');
    Route::post('signin', [AuthController::class, 'store'])->name('auth@store');
    Route::post('reset', [AuthController::class, 'reset_create'])->name('auth@reset_create');
    Route::patch('reset', [AuthController::class, 'reset_store'])->name('auth@reset_store');
    Route::post('signup', [AuthController::class, 'create'])->name('auth@create');
});

Route::group(['prefix' => 'auth', 'middleware' => 'auth'], function () {
    Route::get('verify', [AuthController::class, 'verify'])->name('auth@verify');
    Route::patch('verify', [AuthController::class, 'verify_store'])->name('auth@verify_store');
    Route::post('verify', [AuthController::class, 'verify_store_again']);
});
Route::group(['middleware' => ['auth', 'verify'], 'prefix' => 'dashboard'], function () {
    Route::resource('profile', ProfileController::class)->only(['index', 'update']);
    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('custom', [DashboardController::class, 'custom'])->name('dashboard@custom');
    Route::patch('custom', [DashboardController::class, 'createCustom'])->name('custom@create');
    Route::get('qr', [DashboardController::class, 'qr'])->name('dashboard@qr');
    Route::patch('qr', [DashboardController::class, 'createQR'])->name('qr@create');
    Route::post('qr', [DashboardController::class, 'createQR'])->name('qr@create');
});

Route::post('logout', [AuthController::class, 'destroy'])->name('auth@logout')->middleware('auth')->prefix('auth');
