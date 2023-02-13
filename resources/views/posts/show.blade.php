@extends('layouts.app')

@section('content')

<div class='wrapper'>
    <h4>{{ $post->title }}</h4>
    <p>{{ $post->body }}</p>
    <a href="{{ $post->id }}/edit"><h5>Редактирвать</h5></a>
    <form action="{{ $post->id }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger"> Удалить</button>
    </form>
    <div>
        <img class="w-25" src="{{ asset('images/' . $post->image_path) }}" alt="">
    </div>
    <ul>
        <h5>Комментарии:</h5>
        @forelse ($post->coment as $coment)
            <li>{{ $coment['body'] }}</li>
        @empty
            <p>Пусто...</p>
        @endforelse
    </ul>

    <form action="/coments/{{ $post->id }}" method="POST">
        @csrf
        <div>
            <textarea class="form-control" type="text" name='coment' placeholder="Комментарий"></textarea>
        </div>
        <div>
            <button class="btn btn-primary" type='submit'>
                 Добавить комментарий
            </button>
        </div>
    </form>
</div>
    
@endsection