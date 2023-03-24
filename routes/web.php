<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\MovieController;
use GuzzleHttp\Middleware;
use Illuminate\Foundation\Application;
use Illuminate\Routing\RouteGroup;
use Illuminate\Routing\RouteUrlGenerator;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use League\Flysystem\UrlGeneration\PrefixPublicUrlGenerator;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
// Test User Role Spatie
// Route::get('admin', function() {
//     return 'Hi Admin';
// })->Middleware('role:admin');

// Route::get('user', function() {
//     return 'Hi user';
// })->Middleware('role:user');

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::redirect('/','/login');

Route::middleware(['auth', 'role:user'])->prefix('dashboard')->name('user.dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    route::get('/movie/{movie:slug}', [MovieController::class, 'show'])->name('movie.show');
    
});

// Route::get('/dashboard', function () {
//     return inertia('User/Dashboard/Index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('prototype')->name('prototype.')->group(function(){ 
    Route::get('/login', function() {
        return Inertia::render('Prototype/Login');
    })->name('login');

    Route::get('/register', function() {
        return Inertia::render('Prototype/Register');
    })->name('register');

    Route::get('/dashboard', function() {
        return Inertia::render('Prototype/Dashboard');
    })->name('dashboard');

    Route::get('/subscriptionPlan', function() {
        return Inertia::render('Prototype/SubscriptionPlan');
    })->name('subscriptionPlan');

    Route::get('/movie/{slug}', function() {
        return Inertia::render('Prototype/Movie/Show');
    })->name('movie.show');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
