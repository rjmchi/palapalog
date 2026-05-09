<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'PalapaLog') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>

    <body>
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-sky-900 leading-tight">
                    Los Palmares Palapa Menu Beta Test Comments
                </h2>
            </div>
        </header>  
        
        <main class="p-4">
<div class="py-12">
    <form action="{{route('comment.store')}}" method="post">
        @csrf

        <div class="flex justify-between mx-2 items-center space-x-2">
                <textarea name="comment" placeholder="Your Comment" class="w-10/12"></textarea>
                <input type="text" name="initials" placeholder="Your Initials">
        </div>
        <div class="button">
            <button type="submit" class="btn btn-primary">Add Comment</button>
        </div>

    </form>

    <div class="m-4 border rounded-lg border-neutral-200 shadow p-2">
    @foreach ($comments as $comment)
        <div class="grid grid-cols-12 items-center shadow">
            <span class="col-span-9 p-2 {{$comment->fixed ? 'line-through':''}}">{{$comment->comment}}</span>
            <span class="p-2">{{$comment->initials}}</span>
            <span class="col-span-2 text-center">
            @if(!$comment->fixed)
            <form action="{{route('comment.update', $comment->id)}}" method="post">
                @method('PATCH')
                @csrf
                <button class="btn btn-primary">Fixed</button>
                <input type="hidden" name="fixed" value="1">
            </form>
            @else
            <form action="{{route('comment.update', $comment->id)}}" method="post">
                @method('PATCH')
                @csrf
                <button class="btn btn-secondary">Re-open</button>
                <input type="hidden" name="fixed" value="0">
            </form>            
            @endif
            </span>
        </div>
    @endforeach
    </div>
  </div>
    </div>            

        </main>


        <p class="m-4">Laravel Version: {{ App::VERSION() }}</p>

    </body>
</html>
