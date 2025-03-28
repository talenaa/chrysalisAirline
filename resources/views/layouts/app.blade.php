<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/style.css')}}">
        <title>@yield('title', "Chrysalis Airline")</title>
    </head>
    <body>
        <div id="app">
            <x-header />

            <main>
                @yield('content')
            </main>
            
            <x-footer />
        </div>

        <script src="{{ asset('js/script.js')}}"></script>
        
    </body>
</html>