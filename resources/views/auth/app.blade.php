<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="F Devs merupakan simple page untuk pembuatan Link yang sederhana, mudah digunakan dan praktis. Memiliki banyak fitur dan tersedia Free API untuk Pengembang Developer.">
    <meta property="og:title" content="F Devs a Simple Shortlink">
    <meta property="og:description" content="F Devs merupakan simple page untuk pembuatan Link yang sederhana, mudah digunakan dan praktis. Memiliki banyak fitur dan tersedia Free API untuk Pengembang Developer.">
    <meta property="og:url" content="{{ config('app.url') }}">
    <meta property="og:type" content="website/application">
    <title>F Devs | @yield('title')</title>
    <link rel="canonical" href="{{ config('app.url') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Quicksand:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('build/assets/app-be29d85a.css') }}">
    <link rel="manifest" href="{{ asset('build/manifest.json') }}">
    <script src="{{ asset('build/assets/app-dbe23e4c.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js" ></script>
    <script type="application/ld+json">{ "@context": "http://schema.org", "@type": "website", "name": "F Devs Shortlink", "description": "Website untuk membuat LINK menjadi Sederhana dan Simple untuk digunakan.", "url" : "{{ config('app.url') }}", "brand": "Shortlink URL"} </script>
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
@yield('js.reset')
@yield('js.signin')
@yield('js.signup')
</html>
