<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Фильмы</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
{{--    <script src="/js/jquery.min.js"></script>--}}
    <script src="/js/bootstrap.min.js"></script>
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/starter-template.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{route('films.index')}}">Фильмы</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="{{ route('genres.index') }}">Жанры</a></li>
                        <li><a href="{{ route('actors.index') }}">Актеры</a>
                        </li>

                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ route('login') }}">Войти</a></li>

                    </ul>
                </div>
            </div>
        </nav>
        <main class="container starter-template">
            @yield('content')
        </main>
    </div>

</body>
</html>
