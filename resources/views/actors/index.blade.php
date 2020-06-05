@extends('layouts.appfilm')

@section('content')
    <div class="add">

        <a href="{{ route('actors.create') }}" class="ml-auto btn btn-success">
            Добавить актера
        </a>
    </div>

    <div class="container">
        @forelse($actors ?? [] as $actor)

            <form action="{{ route('actors.destroy', $actor) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <div class="lead starter-template">
                    <div class="content-name">
                        <a href="{{ route('actors.show', $actor) }}">{{$actor->fio}}</a>
                    </div>

                    <div class="btn-group">
                        {{--                    @can('update', $film ?? '')--}}
                        <a class="btn btn-info" href="{{ route('actors.edit', $actor) }}">Редактировать</a>
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

