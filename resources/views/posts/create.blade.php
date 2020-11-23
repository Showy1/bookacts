@extends('layouts.app')

@section('content')
  {{-- <form action="/posts" method="post">
    @csrf
    <div class="form-group row">
      <label for="input_book_title" class="col-sm-2 col-form-label">本のタイトル</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="input_book_title" name="book_title">
      </div>
    </div>
    <div class="form-group row">
      <label for="input_book_author" class="col-sm-2 col-form-label">本の著者</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="input_book_author" name="book_author">
      </div>
    </div>
    <button type="submit" class="btn btn-primary">投稿</button>
  </form> --}}

  <form action="/posts/create" method="get" class="mb-4">
    <div class="form-group">
      <input type="text" name="keyword" class="form-control" id="input_keyword" name="book_title" value="{{ $keyword }}" placeholder="書籍名 著者 など">
    </div>
    <button type="submit" class="btn btn-primary">検索</button>
  </form>

  @if ($items == null)
    <p>キーワードを入力してください。</p>
  @else (count($items) > 0)
    <p>「{{ $keyword }}」の検索結果</p>
    <hr>
    <div class="d-flex flex-wrap justify-content-around">
      @foreach ($items as $index => $item)
        <form action="/posts" method="post" class="mx-1 mb-4" id="book-form-{{$index}}" style="width: 15rem;">
          @csrf
        <div class="card" onclick="document.forms['book-form-{{$index}}'].submit();">
          @if (array_key_exists('imageLinks', $item['volumeInfo']))
            <img src="{{ $item['volumeInfo']['imageLinks']['thumbnail']}}" class="card-img-top px-5 pt-3 pb-1">
          @endif
          <div class="card-body">
            <input type="text" class="form-control border-0 p-0" id="input_book_title" name="book_title" value="{{ $item['volumeInfo']['title']}}" style="text-overflow: ellipsis;">
            @if (array_key_exists('authors', $item['volumeInfo']))
              <input type="text" class="form-control border-0 p-0" id="input_book_author" name="book_author" value="{{ $item['volumeInfo']['authors'][0]}}">
            @endif
          </div>
        </div>
      </form>
      @endforeach
      <div class="mx-1" style="width: 15rem;"></div>
      <div class="mx-1" style="width: 15rem;"></div>
      <div class="mx-1" style="width: 15rem;"></div>
    </div>
  @endif
@endsection
