<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class BooksController extends Controller
{
    /**
     * 本ダッシュボード表示
     */
    public function index()
    {
        $books = Book::orderBy('created_at', 'asc')->paginate(3);
        return view('/books', compact('books'));
    }

    //追加
    public function store(Request $request)
    {
        //バリデーション
        $validator = Validator::make(
            $request->all(),
            [
                'item_name' => 'required|min:3|max:255',
                'item_number' => 'required|min:1|max:3',
                'item_amount' => 'required|max:6',
                'published' => 'required'
            ],
            [
                'item_name.required' => '(必須)タイトルを入力してください',
                'item_name.min' => '(必須)3文字以上で入力してください',
                'item_name.max' => '(必須)最大255文字で入力してください',
                'item_number.required' => '(必須)冊数を入力してください',
                'item_number.min' => '(必須)1桁以上で入力してください',
                'item_number.max' => '(必須)3桁以内で入力してください',
                'item_amount.required' => '(必須)金額を入力してください',
                'item_amount.max' => '(必須)6桁以内で入力してください',
                'published.required' => '(必須)年月日だけでもOK'
            ]
        );


        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $books = new Book;
        $books->item_name = $request->item_name;
        $books->item_number = $request->item_number;
        $books->item_amount = $request->item_amount;
        $books->published = $request->published;
        $books->save();
        return redirect('/')->with('message', '本登録が完了しました。');
    }

    //更新
    public function update(Request $request)
    {
        //バリデーション
        $validator = Validator::make(
            $request->all(),
            [
                'item_name' => 'required|min:3|max:255',
                'item_number' => 'required|min:1|max:3',
                'item_amount' => 'required|max:6',
                'published' => 'required'
            ],
            [
                'item_name.required' => '(必須)タイトルを入力してください',
                'item_name.min' => '(必須)3文字以上で入力してください',
                'item_name.max' => '(必須)最大255文字で入力してください',
                'item_number.required' => '(必須)冊数を入力してください',
                'item_number.min' => '(必須)1桁以上で入力してください',
                'item_number.max' => '(必須)3桁以内で入力してください',
                'item_amount.required' => '(必須)金額を入力してください',
                'item_amount.max' => '(必須)6桁以内で入力してください',
                'published.required' => '(必須)年月日だけでもOK'
                ]
            );


        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        //データ更新
        $books = Book::find($request->id);
        $books->item_name = $request->item_name;
        $books->item_number = $request->item_number;
        $books->item_amount = $request->item_amount;
        $books->published   = $request->published;
        $books->save();
        return redirect('/');
    }



    /**
     * 更新画面
     */
    public function edit(Book $books)
    {
        return view('booksedit', ['book' => $books]);
    }

    /**
     * 本を削除
     */
    public function delete(Book $book)
    {
        $book->delete();
        return redirect('/');
    }
}
