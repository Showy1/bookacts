@extends('layouts.app')

@section('content')
  <div class="card mb-4">
    <div class="card-body">
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <h5 class="card-title">{{$post->book_title}}</h5>
          <h6 class="card-subtitle mb-2 text-muted">{{$post->book_author}}</h6>
        </li>
        <li class="list-group-item">{{$post->note}}</li>
        <li class="list-group-item">{{$post->plan}}</li>
        <li class="list-group-item">{{$post->result}}</li>
        <li class="list-group-item">{{$post->user_id}}</li>
        <li class="list-group-item">{{$post->created_at}}</li>
        <li class="list-group-item">{{$post->updated_at}}</li>
        <li class="list-group-item">
          <a href="/posts/{{$post->id}}/edit" class="btn btn-dark">編集</a>
          <a href="/" class="btn btn-dark">一覧に戻る</a>
          <form action="/posts/{{$post->id}}" method="post">
            @method('delete')
            @csrf
            <input type="submit" class="btn btn-dark" name="" value="削除">
          </form>
        </li>
      </ul>
    </div>
  </div>
@endsection
