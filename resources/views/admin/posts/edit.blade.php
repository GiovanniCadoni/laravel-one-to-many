@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <p class="text-center fw-bold fs-4">
            Modifica il post:
        </p>
        <div class="row justify-content-center">
            <div class="col-6">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.posts.update', ['post' =>$post->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="titolo" class="form-label">Titolo</label>
                        <input type="text" class="form-control" id="titolo" name="titolo"
                            value="{{ old('titolo', $post->titolo) }}">
                    </div>
                    <div class="mb-3">
                        <label for="type">Seleziona la categoria</label>
                        <select class="form-select" name="type_id" id="type">
                            <option @selected(old('type_id', $post->type_id)) value="">Nessuna categoria</option>
                            @foreach ($types as $type)
                                <option @selected(old('type_id', $post->type_id) == $type->id) value="{{ $type->id }}">{{ $type->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="contenuto" class="form-label">Contenuto</label>
                        <textarea class="form-control" id="contenuto" rows="3" name="contenuto">
                            {{ old('contenuto', $post->contenuto) }}
                        </textarea>
                    </div>
                    <div class="mb-3">
                        <label for="cover_image" class="form-label">Immagine</label>
                        <input type="file" class="form-control" id="cover_image" name="cover_image">
                    </div>
                    @if ($post->cover_image)
                        <div class="image-preview mb-3">
                            <p>Vecchia immagine:</p>
                            <img class="rounded-2" src="{{ asset('storage/' . $post->cover_image) }}" alt="">
                        </div>
                    @endif
                    <div class="mb-3">
                        <p>Preview della nuova immagine inserita:</p>
                        <img id="preview-img" src="" alt="">
                    </div>
                    <button type="submit" class="btn btn-primary">Salva</button>
                </form>
            </div>
        </div>
    </div>
@endsection