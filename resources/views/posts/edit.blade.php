@extends('layouts.app')

@section('content')
  <form action="/posts/{{$post->id}}" method="post">
    @method('patch')
    @csrf
    <div class="form-group row">
      <label for="input_book_title" class="col-sm-2 col-form-label">本のタイトル</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="input_book_title" name="book_title" value="{{$post->book_title}}">
      </div>
    </div>
    <div class="form-group row">
      <label for="input_book_author" class="col-sm-2 col-form-label">本の著者</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="input_book_author" name="book_author" value="{{$post->book_author}}">
      </div>
    </div>
    <button type="submit" class="btn btn-primary">更新</button>
  </form>
@endsection
