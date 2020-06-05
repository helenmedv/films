@extends('layouts.appfilm')

@section('content')
    <div class="add">
{{--        <h1>{{$user->name}}</h1>--}}

        <a href="{{ route('films.create') }}" class="ml-auto btn btn-success">
            Добавить фильм
        </a>
    </div>

    <div class="container">
        @forelse($films ?? [] as $film)

            <form action="{{ route('films.destroy', $film) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <div class="lead starter-template">
                    <div class="content-name">
                        <a href="{{ route('films.show', $film) }}">{{$film->title}}</a>
                    </div>
                    <div class="film-container">

                        @if($film->image)

                            <div class="image">
                                <img src="{{ asset('storage/' . $film->image) }}"
                                     class="img-thumbnail" width="200" height="300" alt="">
                            </div>

                        @endif

                        @if($film->description)
                            <div class="description">
                                {{ $film->description }}
                            </div>
                        @endif


                    </div>
                        <div class="btn-group">
                            {{--                    @can('update', $film)--}}
                            <a class="btn btn-info" href="{{ route('films.edit', $film) }}">Редактировать</a>
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
