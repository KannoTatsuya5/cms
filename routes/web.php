<?php

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\Validator;



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
Route::get('/', function () {
    return view('books');
});

/**
 * 本を追加
 */
Route::post('/books', function (Request $request) {

    //バリデーション
    $validator = Validator::make($request->all(), ['item_name' => 'required|max:255',]);

    //バリデーション:エラー
    if($validator->fails()) {
        return redirect('/')
        ->withInput()
        ->withErrors($validator);
    }
});

/**
 * 本を削除
 */
Route::delete('/book/{book}', function (Book $book) {
    // 
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
