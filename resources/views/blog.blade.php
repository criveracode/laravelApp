@extends('template')

@section('content')
    <h1>Publicaciones</h1>
    @foreach ($posts as $post)
        <p>
            <strong>{{ $post->id }}</strong>
            <a href="{{ route('post', $post->slug) }}">{{ $post->title }}</a>
        </p>
        <strong>Autor : <span>{{ $post->user->name }}</span></strong>
    @endforeach
    {{ $posts->links() }}
@endsection
