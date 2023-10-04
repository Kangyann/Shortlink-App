<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>F Devs | @yield('title')</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Quicksand:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('build/assets/app-be29d85a.css') }}">    
    <script src="{{ asset('build/assets/app-dbe23e4c.js') }}"></script>
</head>
<body>
    <div class="flex min-h-screen flex-col justify-center items-center lg:px-6 md:px-6 px-12 py-12">
        <div class="lg:w-[426px] md:w-[426px] sm:w-[426px] w-full  shadow border rounded-md p-6">
            <span class="text-3xl font-bold text-info font-serif">{{ config('app.name') }} - @yield('header')</span>
            <hr class="w-5 h-1 bg-info">
            @yield('auth.signup')
            @yield('auth.signin')
            @yield('auth.verify')
            @yield('auth.reset')
            @yield('auth.reset_valid')
        </div>
    </div>
</body>

</html>
