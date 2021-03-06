@extends('layouts.app')

@section('content')
  {{-- <form action="{{url('/')}}" method="GET" class="mb-4"> --}}
  <form action="/" method="GET" class="mb-4">
    <div class="form-group">
      <input type="text" class="form-control" id="" name="keyword" value="{{$keyword}}" placeholder="検索キーワード（本のタイトルまたは著者を対象）">
    </div>
    <button type="submit" class="btn btn-primary mr-3 mb-2">キーワードを含む投稿を検索</button>
    <a class="btn btn-dark align-top" href="/" role="button">検索リセット</a>
  </form>

  @if($posts->count())
    @foreach ($posts as $post)
      <div class="card mb-4">
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <h5 class="card-title">{{$post->book_title}}</h5>
              <h6 class="card-subtitle mb-2 text-muted">{{$post->book_author}}</h6>
            </li>
            @if($post->plan)
              <li class="list-group-item">{{$post->plan}}</li>
            @endif
            @if($post->result)
              <li class="list-group-item">{{$post->result}}</li>
            @endif
            <li class="list-group-item d-flex">
              <a href="/posts/{{$post->id}}" class="btn btn-primary mr-2">詳細</a>
              @if(Auth::id() == $post->user_id)
                <a href="/posts/{{$post->id}}/edit" class="btn btn-primary mr-2">編集</a>
                <form action="/posts/{{$post->id}}" method="post">
                  @method('delete')
                  @csrf
                  <input type="submit" class="btn btn-dark" name="" value="削除">
                </form>
              @endif
            </li>
          </ul>
        </div>
      </div>
    @endforeach
  @else
    <p>検索結果はありません</p>
  @endif
@endsection
