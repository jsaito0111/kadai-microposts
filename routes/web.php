<?php

#use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController; // 追記
use App\Http\Controllers\MicropostsController; //追記

use App\Http\Controllers\UserFollowController;  // 追記
use App\Http\Controllers\FavoritesController;  // 追記
use App\Http\Controllers\MessageController;

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

Route::get('/', [MicropostsController::class, 'index']);

Route::get('/dashboard', [MicropostsController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::get('/messages/{userId}', [MessageController::class, 'index'])->name('messages.index');
Route::post('/messages/{userId}', [MessageController::class, 'send'])->name('messages.send');

Route::group(['middleware' => ['auth']], function () {
    // 追記ここから
    Route::prefix('users/{id}')->group(function () {
        Route::post('follow', [UserFollowController::class, 'store'])->name('user.follow');
        Route::delete('unfollow', [UserFollowController::class, 'destroy'])->name('user.unfollow');
        Route::get('followings', [UsersController::class, 'followings'])->name('users.followings');
        Route::get('followers', [UsersController::class, 'followers'])->name('users.followers');
    });
    // 追記きこまで
    
    Route::resource('users', UsersController::class, ['only' => ['index', 'show']]);
    //Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('microposts', MicropostsController::class, ['only' => ['store', 'destroy']]);
    
    Route::prefix('microposts/{id}')->group(function() {
        Route::post('favorites', [FavoritesController::class, 'store'])->name('users.favorite');
        Route::delete('unfavorite', [FavoritesController::class, 'destroy'])->name('users.unfavorite');
        Route::get('favorites', [FavoritesController::class, 'favorites'])->name('favorites.favorites');
    });
    
    Route::put('microposts/{id}', [MessagesController::class, 'update']);
});

require __DIR__.'/auth.php';
