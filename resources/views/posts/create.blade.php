@extends('layouts.app')

@section('content')
<div>
    
    @if ($errors->any())
    <div class="alert alert-warning" role="alert">
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
        </div>
    @endif
 
<form action="/posts" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <input type="file" name='image_post'>
    </div>
    gfgfg
    <div>
        <input type="text" name='title' placeholder="Название поста">
    </div>
    <div>
        <textarea type="text" name='body' placeholder="Содержание поста"></textarea>
    </div>
    <div>
        <button type='submit'>
             Добавить
        </button>
    </div>
</form>
</div>
@endsection