<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [PostController::class, 'index']);
//bitno je da staticke putanje budu iznad dinamickih kod istih metoda (kada je prvi deo isti, i iste su duzine - imaju isto delova)
Route::get('/posts/create', [PostController::class, 'create']);
Route::get('/posts/{post}', [PostController::class, 'show'])->name('post');
Route::post('/posts', [PostController::class, 'store']);
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('createComment');
Route::get('/register', [AuthController::class, 'getRegisterForm']);
Route::post('/register', [AuthController::class, 'register']);
//po konvenciji bi bila store metoda ^
Route::post('/logout', [AuthController::class, 'logout']);
//po konvenciji bi bila delete metoda ^ (mada nema neke jake konvencije)
Route::get('/login', [AuthController::class, 'getLoginBlade']);
Route::post('/login', [AuthController::class, 'login']);
