@extends('layouts.app')

@section('content')

<div>
    <a href="/posts/create"><h5>Добавить пост &rarr;</h5></a>
</div>
@foreach ($posts as $post)
<div class='wrapper'>
    <a href="/posts/{{ $post->id }}"><h5>{{ $post->title }}</h5></a>
    <p>{{ $post->body }}</p>
    <a href="/posts/{{ $post->id }}/edit"><h5>Редактирвать</h5></a>
    <form action="/posts/{{ $post->id }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger"> Удалить</button>
    </form>
</div>
@endforeach
<div>
    {{ $posts->links() }}
</div>

    
@endsection