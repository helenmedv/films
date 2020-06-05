<?php
$update = isset($film);
?>
@extends('layouts.appfilm')

@section('content')
    <div class="container">

        <form action="{{$update ? route('films.update', $film) : route('films.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            @if($update)
                @method('PUT')
            @endif

            <div class="form-group">
                <input type="text" name="title" placeholder="Название..."
                       class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title') ?? ($film->title ?? '')}}">
                @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Изображение</label>
                <input type="file" name="image" id="image" accept="image/jpeg, image/png">
{{--                @if($film->image)--}}
{{--                    <div>--}}
{{--                        {{$film->image}}--}}
{{--                    </div>--}}
{{--                @endif--}}
            </div>

            <div class="form-group">
                <input type="number" name="year" placeholder="Год..."
                       class="form-control"
                       value="{{ old('year') ?? ($film->year ?? '')}}">
            </div>

            <div class="form-group">
                <select name="genres[]" multiple class="form-control">
                    @foreach($genres as $genre)
                        <option @if(in_array($genre->id, $filmGenres)) selected @endif value="{{$genre->id}}">{{$genre->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <select name="actors[]" multiple class="form-control">
                    @foreach($actors as $actor)
                        <option @if(in_array($actor->id, $filmActors)) selected @endif value="{{$actor->id}}">{{$actor->fio}}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-success">{{ $update ? 'Обновить' : 'Добавить' }}</button>

        </form>
    </div>
@endsection
