@extends('layouts.admin')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="card border border-0 text-center col-8 p-2">
      <div class="card-body">
        @if ($post->cover_image)
          <div>
            <img class="rounded-2" src="{{ asset('storage/' . $post->cover_image) }}" alt="">
          </div>
        @else
          <div>
            Errore: nessuna immagine trovata
          </div>
        @endif
        <h5 class="card-title fs-4 fw-bold mt-2 mb-2">{{ $post->titolo }}</h5>
        <h6 class="card-subtitle mb-4 text-muted">({{ $post->slug }})</h6>
        <p>
          Categoria: {{ $post->type ? $post->type->nome : 'non assegnata' }}
        </p>
        <p class="card-text fw-bold mb-0">
          Contenuto:
        </p>
        <p class="card-text">
          {{ $post->contenuto }}
        </p>
        <a class="btn btn-warning" href="{{ route('admin.posts.edit', ['post' => $post->id]) }}">Modifica</a>
        <form class="d-inline-block" action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="POST">
          @csrf
          @method('DELETE')
          <button class="btn btn-danger">
              <i class="fa-solid fa-trash-can"></i>
          </button>
      </form>
      </div>
    </div>
  </div>
</div>
@endsection