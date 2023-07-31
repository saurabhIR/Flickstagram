<?php

use App\Mail\NewUserWelcomeMail;
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



Auth::routes();

//Routing for user profle with index function
Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');

//Routing for user profle for edit function
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profile.edit');

//Routing for user profle for update function
Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.update');



//Routing for feed page or posts index function
Route::get('/', [App\Http\Controllers\PostsController::class, 'index']);

//Routing for posts create function
Route::get('/posts/create', [App\Http\Controllers\PostsController::class, 'create'])->name('post.create');

//Routing for posts store function
Route::post('/posts', [App\Http\Controllers\PostsController::class, 'store'])->name('post.store');

//Routing to see a particular user post
Route::get('/posts/{id}', [App\Http\Controllers\PostsController::class, 'show'])->name('post.show');

//Routing for deleting post individually
Route::delete('/post/{id}',[\App\Http\Controllers\PostsController::class, 'destroy'])->name('post.destroy');



//on click follow button controller 
Route::post('/follow/{user}', [App\Http\Controllers\FollowsController::class, 'store'])->name('follow.store');

//Temporary routing for email check
Route::get('/email', function(){
    return new NewUserWelcomeMail();
});


//Routing for user profle with index function
Route::get('/followers/{user}', [App\Http\Controllers\FollowersController::class, 'followers'])->name('followers.show');

//Routing for user profle with index function
Route::get('/following/{user}', [App\Http\Controllers\FollowersController::class, 'following'])->name('following.show');