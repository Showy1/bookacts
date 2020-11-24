@extends('layouts.app')

@section('content')
  <form action="/posts/{{$post->id}}" method="post">
    @method('patch')
    @csrf
    <div class="form-group row">
      <label for="input_book_title" class="col-sm-2 col-form-label">書籍名</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="input_book_title" name="book_title" value="{{$post->book_title}}" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="input_book_author" class="col-sm-2 col-form-label">著者</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="input_book_author" name="book_author" value="{{$post->book_author}}">
      </div>
    </div>
    <div class="form-group row">
      <label for="input_note" class="col-sm-2 col-form-label">メモ</label>
      <div class="col-sm-10">
        <textarea type="text" class="form-control" id="input_note" name="note" style="resize: none;">{{$post->note}}</textarea>
      </div>
    </div>
    <div class="form-group row">
      <label for="input_plan" class="col-sm-2 col-form-label">計画</label>
      <div class="col-sm-10">
        <textarea type="text" class="form-control" id="input_plan" name="plan" style="resize: none;">{{$post->plan}}</textarea>
      </div>
    </div>
    <div class="form-group row">
      <label for="input_result" class="col-sm-2 col-form-label">結果</label>
      <div class="col-sm-10">
        <textarea type="text" class="form-control" id="input_result" name="result" style="resize: none;">{{$post->result}}</textarea>
      </div>
    </div>
    <div class="d-flex">
      <a href="/" class="btn btn-dark mr-2">変更を保存せずに一覧に戻る</a>
      <button type="submit" class="btn btn-primary">更新</button>
    </div>
  </form>
@endsection
