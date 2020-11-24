@extends('layouts.app')

@section('content')
  <div class="card mb-4">
    <div class="card-body">
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <h5 class="card-title">{{$post->book_title}}</h5>
          <h6 class="card-subtitle mb-2 text-muted">{{$post->book_author}}</h6>
        </li>
        <li class="list-group-item">
          <div class="row">
            <div class="col-sm-2 pr-0">
              メモ
            </div>
            <div class="col-sm-10">
              {{$post->note}}
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <div class="row">
            <div class="col-sm-2 pr-0">
              計画
            </div>
            <div class="col-sm-10">
              {{$post->plan}}
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <div class="row">
            <div class="col-sm-2 pr-0">
              結果
            </div>
            <div class="col-sm-10">
              {{$post->result}}
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <div class="row">
            <div class="col-sm-2 pr-0">
              作成者
            </div>
            <div class="col-sm-10">
              {{$post->user->name}}
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <div class="row">
            <div class="col-sm-2 pr-0">
              作成日時
            </div>
            <div class="col-sm-10">
              {{$post->created_at}}
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <div class="row">
            <div class="col-sm-2 pr-0">
              更新日時
            </div>
            <div class="col-sm-10">
              {{$post->updated_at}}
            </div>
          </div>
        </li>
        <li class="list-group-item d-flex">
          <a href="/" class="btn btn-dark mr-2">一覧に戻る</a>
          @if(Auth::id() == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-dark mr-2">編集</a>
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
@endsection
