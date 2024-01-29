@extends('layouts.admin')

@section('content')
    <div class="container pt-3">
        <h2 class="fw-bold">
            Lista dei Post
        </h2>
        @if (session('message'))
            <div class="alert alert-success d-inline-flex">
                {{ session('message') }}
            </div>
        @endif
        <div>
            <a href="{{ route('admin.posts.create') }}">Aggiungi un nuovo post +</a>
        </div>
        <table class="table table-striped p-5">
            <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">Titolo</th>
                <th scope="col">Data</th>
                <th scope="col">Azioni</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->titolo }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td>
                            <a class="btn btn-secondary" href="{{ route('admin.posts.show', ['post' => $post->id]) }}"><i class="fa-solid fa-circle-info"></i></a>
                            <a class="btn btn-warning" href="{{ route('admin.posts.edit', ['post' => $post->id]) }}"><i class="fa-solid fa-pencil" style="color: #ffffff;"></i></i></a>
                            <form class="d-inline-block" action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
    </div>
@endsection