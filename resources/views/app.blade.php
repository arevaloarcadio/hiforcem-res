<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Anindya Dhruba">
        <meta name="description" content="Laravel Vue SPA">

        <title>{{ config('app.name') }}</title>

        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
                'siteName'  => config('app.name'),
                'apiDomain' => config('app.url').'/api'
            ]) !!}
        </script>
    </head>
    <body>
        <div id="app">
            <app></app>
        </div>
    
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
