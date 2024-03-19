<?php

use App\Http\Controllers\FacebookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Account Add and manage section start
     Route::get('/connect-account', function(){
        return view("account.connect");
    })->name('account.connect');
    Route::get('/manage-account', function(){
        return view("account.manage");
    })->name('account.manage');
    Route::get('/pages', [FacebookController::class, 'showPages']);
// Account Add and manage section end
Route::get('auth/facebook', [FacebookController::class, 'redirectToFacebook'])->name('facebook.connect');;
Route::get('auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);
// Post Add and manage section start
    Route::get('/create-post', function(){
        return view("posts.create");
    })->name('post.create');
    Route::get('/pages', function(){
        return view("account.accounts");
    });
// Post Add and manage section start
require __DIR__.'/auth.php';
