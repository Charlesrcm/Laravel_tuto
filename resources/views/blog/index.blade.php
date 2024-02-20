@extends('base')

@section('title', 'Accueil du blog')

@section('content')
  <h1>Mon blog</h1>

  @foreach($posts as $post)
    <article>
      <h2>{{ $post->title }}</h2>
      <p>
        {{ $post->content }}
      </p>
      <p>
        <a href="{{ route('blog.show', ['slug' => $post->slug, 'post' => $post->id]) }}" class="btn btn-primary">Lire la suite</a>
      </p>
    </article>
  @endforeach

  {{-- pour la pagination --}}
  {{ $posts->links() }}

  {{-- @if, @enif --}}
  {{-- @foreach --}}
  {{-- @dump --}}
@endsection