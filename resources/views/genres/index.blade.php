@extends('layouts.appfilm')

@section('content')
    <div class="add">

        <a href="{{ route('genres.create') }}" class="ml-auto btn btn-success">
            Добавить жанр
        </a>
    </div>

    <div class="container">
        @forelse($genres ?? [] as $genre)

            <form action="{{ route('genres.destroy', $genre) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <div class="lead starter-template">
                    <div class="content-name">
                        <a href="{{ route('films.show', $genre) }}">{{$genre->name}}</a>
                    </div>

                    <div class="btn-group">
                        {{--                    @can('update', $film ?? '')--}}
                        <a class="btn btn-info" href="{{ route('genres.edit', $genre) }}">Редактировать</a>
                        {{--                    @endcan--}}
                        <button class="btn btn-danger">Удалить</button>
                    </div>

                </div>


            </form>

        @empty
            <div class="container alert alert-secondary">
                Ничего нет:(
            </div>

        @endforelse
    </div>

@endsection

