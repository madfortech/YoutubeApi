<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\User\DashboardController;
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
    return view('index');
});

// Admin Routes
Route::group(['middleware' => ['auth','role:Admin','verified']], function () {
    Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
    
    
});

// User Routes
Route::group(['middleware' => ['auth','verified']], function () {
    
    Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');

});

Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');


Route::middleware('auth','verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

 

require __DIR__.'/auth.php';
