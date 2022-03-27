<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,400;0,900;1,100;1,400;1,900&display=swap" rel="stylesheet">
        
        <!-- Style -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        
        <title> @yield('title') </title>

    </head>
    
    <body>
        <div id="app" class="container">
            <header>
                
            </header>
            <main class="">
                @yield('content')
            </main>
            <footer>
                
            </footer>
        </div>
    </body>
</html>
