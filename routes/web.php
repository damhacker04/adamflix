<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscribeController;
use Illuminate\Http\Request;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MovieController; 
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;


// Route::get('/', [MovieController::class, 'index'])->name('welcome');


// Route::get('/home',[MovieController::class, 'index'] )->middleware(['auth', 'check.device.limit'])->name('home');
// Route::get('/movies',[MovieController::class, 'all'] )->name('movies.index');
// Route::get('/movies/{movie:slug}',[MovieController::class, 'show'] )->name('movies.show');
// Route::get('/movies/search',[MovieController::class, 'search'] )->name('movies.search');
// Route::get('/categories/{category:slug}',[CategoryController::class, 'show'] )->name('categories.show');


// Route::get('/text-expired', function(){
    //     $membership = \App\Models\membership::find(1);
    //     event(new \App\Events\MembershipHasExpired($membership));
    //     return 'Event Fired';
    // });
    
    
    // Route::get('/subscribe/plans', [SubscribeController::class, 'showPlans'])->name('subscribe.plans');
    // Route::get('/subscribe/plan/{plan}', [SubscribeController::class, 'checkoutPlan'])->name('subscribe.checkout');
    // Route::post('/subscribe/plan/checkout', [SubscribeController::class, 'processCheckout'])->name('subscribe.process');
    // Route::get('/subscribe/success', [SubscribeController::class, 'showSuccess'])->name('subscribe.success');
    // Route::post('/checkout', [TransactionController::class, 'checkout'])->name('checkout');
    
    Route::middleware(['auth', 'check.device.limit', 'subscribed'])->group(function () {
        Route::get('/', [MovieController::class, 'index'])->name('welcome');
        Route::get('/home', [MovieController::class, 'index'])->name('home');
        Route::get('/movies', [MovieController::class, 'all'])->name('movies.index');
        Route::get('/movies/search', [MovieController::class, 'search'])->name('movies.search');
        Route::get('/movies/{movie:slug}', [MovieController::class, 'show'])->name('movies.show');
        Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
    });
    
    Route::post('/logout', function (Request $request) {
        return app(\Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::class)->destroy($request);
    
    })->name('logout')->middleware(['auth', 'logout.device']);

    Route::middleware(['auth', 'check.device.limit'])->group(function () {
    Route::get('/subscribe/plans', [SubscribeController::class, 'showPlans'])->name('subscribe.plans');
    Route::get('/subscribe/plan/{plan}', [SubscribeController::class, 'checkoutPlan'])->name('subscribe.checkout');
    Route::post('/subscribe/plan/checkout', [SubscribeController::class, 'processCheckout'])->name('subscribe.process');
    Route::post('/checkout', [TransactionController::class, 'checkout'])->name('checkout');
    Route::get('/subscribe/success', [SubscribeController::class, 'showSuccess'])->name('subscribe.success');
});

