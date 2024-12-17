<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\User\CustomSearch;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::middleware(['auth','role:Admin'])->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('admin.home');
    
});


Route::middleware('auth')->group(function () {

    Route::get('/settings', [SettingController::class, 'index'])->name('settings');

    Route::get('/settings', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/password', [PasswordController::class, 'edit'])->name('password.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/login/youtube', [AuthenticatedSessionController::class, 'redirectToProvider'])->name('youtube.login');
Route::get('/login/auth/callback', [AuthenticatedSessionController::class, 'handleProviderCallback']);

Route::get('/youtube/custom-search', [CustomSearch::class, 'index'])->name('custom-search');
Route::post('/youtube/custom-search', [CustomSearch::class, 'store'])->name('youtube.store');



require __DIR__.'/auth.php';
