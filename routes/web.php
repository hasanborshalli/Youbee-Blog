<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PostController;

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

Route::get('/', [MainController::class,'loginPage'])->middleware('guest');

Route::get('/about', [MainController::class,'aboutPage']);

Route::get('/home', [MainController::class,'homePage'])->middleware('auth');
Route::get('/home/search', [MainController::class,'searchPage'])->middleware('auth');
Route::post('/home/read-later', [PostController::class,'readLater'])->middleware('auth');
Route::get('/home/savedPosts', [PostController::class,'savedPosts'])->middleware('auth');

Route::get('/login', [MainController::class,'loginPage'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class,'login'])->middleware('guest');

Route::get('/logout', [AuthController::class,'logout'])->middleware('auth');

Route::get('/newpost', [MainController::class,'newpostPage'])->middleware('auth');
Route::post('/newpost', [PostController::class,'newpost'])->middleware('auth');

Route::get('/post', [MainController::class,'postPage'])->middleware('auth');
Route::get('/post/{post}', [PostController::class,'viewPost'])->middleware('auth');

Route::get('/signup', [MainController::class,'signupPage'])->middleware('guest');
Route::post('/blog/signup', [AuthController::class,'signup'])->middleware('guest');

Route::get('/user/{user}', [AuthController::class,'viewUser'])->middleware('auth');

Route::get('/post/edit/{post}', [PostController::class,'editPostPage'])->middleware('auth')->middleware("can:update,post");
Route::post('/post/edit/{post}', [PostController::class,'editPost'])->middleware('auth')->middleware("can:update,post");

Route::get('/post/delete/{post}', [PostController::class,'deletePost'])->middleware('auth')->middleware("can:delete,post");

Route::post('/comment/{post}', [PostController::class,'comment'])->middleware('auth');
Route::post('/reply/{comment}', [PostController::class,'reply'])->middleware('auth');

Route::post('/post/like/{post}', [PostController::class,'like'])->middleware('auth');
Route::get('/post/share/{post}', [PostController::class,'share'])->middleware('auth')->middleware("can:share,post");

Route::post('/user/follow/{user}', [AuthController::class,'follow'])->middleware('auth')->middleware("can:follow,user");

Route::post('/change-avatar/{user}', [MainController::class,'changeAvatar'])->middleware('auth')->middleware("can:update,user");