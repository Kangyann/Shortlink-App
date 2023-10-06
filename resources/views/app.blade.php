<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="F Devs merupakan simple page untuk pembuatan Link yang sederhana, mudah digunakan dan praktis. Memiliki banyak fitur dan tersedia Free API untuk Pengembang Developer.">
    <meta property="og:title" content="F Devs a Simple Shortlink">
    <meta property="og:description" content="F Devs merupakan simple page untuk pembuatan Link yang sederhana, mudah digunakan dan praktis. Memiliki banyak fitur dan tersedia Free API untuk Pengembang Developer.">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:type" content="website/application">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link rel="canonical" href="{{ request()->url() }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Quicksand:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('build/assets/app-a889ee34.css') }}">
    <link rel="manifest" href="{{ asset('build/manifest.json') }}">
    <script src="{{ asset('build/assets/app-dbe23e4c.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="application/ld+json">{ "@context": "http://schema.org", "@type": "website", "name": "F Devs Shortlink", "description": "Website untuk membuat LINK menjadi Sederhana dan Simple untuk digunakan.", "url" : "{{ config('app.url') }}", "brand": "Shortlink URL"} </script>
</head>
<body>
    <div class="mx-auto lg:w-3/5  w-5/6 text-center">
        <div class="sticky top-2 z-10 border bg-white rounded-md shadow py-3 mb-5 flex justify-center gap-5 items-center px-3">
            <div class="lg:block hidden">
                <a href="/" class=" @if (request()->is('/')) border-b-neutral font-bold border-b @endif">Home</a>
                <a href="{{ route('api') }}" class="mx-2 @if (request()->is('p/api')) border-b-neutral font-bold border-b @endif">API</a>
                @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
                @endauth
            </div>
            <div class="dropdown dropdown-bottom dropdown-start me-auto lg:hidden block">
                <div class="cursor-pointer" tabindex="0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="swap-on w-5 h-5 ">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                    </svg>
                </div>
                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 mt-4 shadow bg-base-100 rounded-box w-52">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('api') }}">API</a></li>
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                </ul>
            </div>
            @auth
            <a href="{{ route('profile.index') }}" class="ms-auto">{{ auth()->user()->name }}</a>
            <form action="{{ route('auth@logout') }}" method="POST">
                <button type="submit">Logout</button>
                @csrf
            </form>
            @endauth
        </div>
        @yield('home')
        @yield('terms')
        @yield('privacy')
        @yield('api')
    </div>
    <div class="text-center mt-16 py-2 text-sm">
        <hr class="my-2">
        <span>Made With ❤️ by Kangyann</span>
        <div class="">
            <a href="{{ route('terms') }}" class="mx-2">Terms of Service</a>
            <span>-</span>
            <a href="https://linktr.ee/JuniorDev" class="mx-2">Community</a>
            <span>-</span>
            <a href="{{ route('privacy') }}" class="mx-2">Privacy Policies</a>
        </div>
    </div>
</body>
@yield('js.api')
</html>
