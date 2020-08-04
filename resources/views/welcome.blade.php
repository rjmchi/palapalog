<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
	<meta name="robots" content="noindex, nofollow">

        <script> window.laravel = {csfrToken:'{{csrf_token()}}'}</script>

        <title>Palapa Menu Comments</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">        

    </head>
    <body>
        <div id="app">
            <div class="container">
                <comment-component></comment-component>
            </div>
        </div>
    <script src="{{secure_asset('js/app.js')}}"></script>
    </body>
</html>
