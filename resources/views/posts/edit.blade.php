@extends('layouts.app')

@section('content')
<div>
    <h1>Update post</h1>
    @if ($errors->any())
    <div class="alert alert-warning" role="alert">
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
        </div>
    @endif
<form action="/posts/{{ $post-> id }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <input class="form-control" type="text" name='title' value="{{ $post->title }}">
    </div>
    <div>
        <textarea class="form-control" type="text" name='body'>{{ $post->body }}</textarea>
    </div>
    <div>
        <button class="btn btn-primary" type='submit'>
             Сохранить
        </button>
    </div>
</form>
</div>
@endsection