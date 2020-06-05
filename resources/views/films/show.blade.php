@extends('layouts.appfilm')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center flex-wrap">
            <h2>
                {{$film->title}}

            </h2>
        </div>

        <div class="mb-3"></div>

        <div class="lead card card-body">
            @if($film->image)
                <div>
                    <img src="{{ asset('storage/' . $film->image) }}" class="img-thumbnail" width="400" height="600" alt="">
                </div>
            @endif
            <div class="text-muted">{{$film->year}}</div>

        </div>
    </div>
@endsection
