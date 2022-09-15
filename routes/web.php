<?php

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BooksController;



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

/**
 * 本の一覧表示(books.blade.php)
 */
Route::get('/', [BooksController::class, 'index']);

/**
 * 本を追加
 */
Route::post('/books', [BooksController::class, 'store']);

/**
 * 更新画面
 */
Route::post('/booksedit/{books}', [BooksController::class, 'edit']);

/**
 * 更新処理
 */
Route::post('/books/update', [BooksController::class, 'update']);
// Route::post('/books/update', function (Request $request) {});

/**
 * 本を削除
 */
Route::delete('/book/{book}', [BooksController::class, 'delete']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
