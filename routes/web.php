<?php

use App\Http\Controllers\AuthController;
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
    return view('welcome', [
        'title' => 'Welcome to BiteStore'
    ]);
});

Route::get('/sale', function () {
    return view('products', [
        'title' => 'Sale'
    ]);
});
Route::middleware(['guest'])->group(function() {
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/login', [AuthController::class, 'auth']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'store']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function() {
    Route::prefix('dashboard')->group(function() {
        Route::get('/', function() {
            return view('dashboard.index');
        });
    });
});