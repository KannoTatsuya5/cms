@extends('layouts.app')
@section('content')
    <!-- Bootstrapの定形コード… -->
    <div class="card-body">
        {{-- セッションメッセージ --}}
        @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
        <div class="card-title offset-md-3" >
            <span>本のタイトル</span>
        </div>

        <!-- バリデーションエラーの表示に使用-->
        {{-- @include('common.errors') --}}
        <!-- バリデーションエラーの表示に使用-->

        <!-- 本登録フォーム -->
        <form action="{{ url('books') }}" method="POST" class="form-horizontal">
            @csrf

            <!-- 本のタイトル -->

            <div class="form-row offset-md-3">
                <div class="form-group col-md-6">
                    <label for="book" class="col-sm-3 control-label">Book</label>
                    <input name="item_name" type="hidden" class="form-control  @if($errors->has('item_name')) is-invalid @endif" id="book" value="{{ old('item_name') }}">
                    <div class="invalid-feedback">
                        @foreach ($errors->get('item_name') as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                    <input name="item_name" type="text" class="form-control @if($errors->has('item_name')) is-invalid @endif" id="book" value="{{ old('item_name') }}">
                    {{-- <input type="text" name="item_name" class="form-control" id="book"> --}}
                </div>

                <div class="form-group col-md-6">
                    <label for="amount" class="col-sm-3 control-label">金額</label>
                    <input name="item_amount" type="hidden" class="form-control @if($errors->has('item_amount')) is-invalid @endif" id="amount" value="{{ old('item_amount') }}">
                    <div class="invalid-feedback">
                        @foreach ($errors->get('item_amount') as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                    <input name="item_amount" type="text" class="form-control @if($errors->has('item_amount')) is-invalid @endif" id="amount" value="{{ old('item_amount') }}">
                    {{-- <input type="text" name="item_amount" class="form-control" id="amount"> --}}
                </div>
                <div class="form-group col-md-6">
                    <label for="number" class="col-sm-3 control-label">数</label>
                    <input name="item_number" type="hidden" class="form-control @if($errors->has('item_number')) is-invalid @endif" id="number" value="{{ old('item_number') }}">
                    <div class="invalid-feedback">
                        @foreach ($errors->get('item_number') as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                    <input name="item_number" type="text" class="form-control @if($errors->has('item_number')) is-invalid @endif" id="number" value="{{ old('item_number') }}">
                    {{-- <input type="text" name="item_number" class="form-control" id="number"> --}}
                </div>

                <div class="form-group col-md-6">
                    <label for="published" class="col-sm-3 control-label">公開日</label>
                    <input name="published" type="hidden" class="form-control @if($errors->has('published')) is-invalid @endif" id="published" value="{{ old('published') }}">
                    <div class="invalid-feedback">
                        @foreach ($errors->get('published') as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                    <input name="published" type="date" class="form-control @if($errors->has('published')) is-invalid @endif" id="published" value="{{ old('published') }}">
                    {{-- <input type="date" name="published" class="form-control" id="published"> --}}
                </div>
            </div>

            <!-- 本 登録ボタン -->
            <div class="form-group offset-md-3">
                <div class="col-sm-offset-3 col-sm-6">
                    <br>
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Book: 既に登録されてる本のリスト -->
    <!-- 現在の本 -->
    @if (count($books) > 0)
        <div class="card-body">
            <div class="card-body">
                <table class="table table-striped task-table">
                    <!-- テーブルヘッダ -->
                    <thead>
                        <th>本一覧</th>
                        <th>数</th>
                        <th>価格</th>
                        <th>公開日</th>
                    </thead>
                    <!-- テーブル本体 -->
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <!-- 本タイトル -->
                                <td class="table-text">
                                    <div>{{ $book->item_name }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $book->item_number }}冊</div>
                                </td>
                                <td class="table-text">
                                    <div>{{number_format( $book->item_amount)}}円</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ date('Y/m/d', strtotime($book->published))  }}</div>
                                </td>

                                {{-- 本: 更新ボタン --}}
                                <td>
                                    <form action="{{url('booksedit/' . $book->id)}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">更新</button>
                                    </form>
                                </td>

                                <!-- 本: 削除ボタン -->
                                <td>
                                    <form action="{{ url('book/' . $book->id) }}" method="POST">
                                        <!-- CSRFからの保護 -->
                                        @csrf

                                        <!-- 擬似フォームメソッド(POSTではなくDeleteのふりをする) -->
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">
                                            削除
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 offset-md-5">
                {{ $books->links('pagination::bootstrap-4') }}
            </div>
        </div>
        
    @endif
@endsection
