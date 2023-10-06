<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="F Devs merupakan simple page untuk pembuatan Link yang sederhana, mudah digunakan dan praktis. Memiliki banyak fitur dan tersedia Free API untuk Pengembang Developer.">
    <meta property="og:title" content="F Devs a Simple Shortlink">
    <meta property="og:description" content="F Devs merupakan simple page untuk pembuatan Link yang sederhana, mudah digunakan dan praktis. Memiliki banyak fitur dan tersedia Free API untuk Pengembang Developer.">
    <meta property="og:url" content="{{ config('app.url') }}">
    <meta property="og:type" content="website/application">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Quicksand:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('build/assets/app-be29d85a.css') }}">
    <link rel="manifest" href="{{ asset('build/manifest.json') }}">
    <script src="{{ asset('build/assets/app-dbe23e4c.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="application/ld+json">{ "@context": "http://schema.org", "@type": "website", "name": "F Devs Shortlink", "description": "Website untuk membuat LINK menjadi Sederhana dan Simple untuk digunakan.", "url" : "{{ config('app.url') }}", "brand": "Shortlink URL"} </script>
</head>
<body>
    <div class="flex">
        <div class="sidebar z-20 lg:sticky fixed top-0 lg:w-64 min-w-[256px] w-48 h-screen border-e whitespace-nowrap overflow-hidden"
            data-theme="light">
            <div class="flex items-center justify-between p-5 whitespace-nowrap transition duration-300">
                <h1 class="text-xl font-semibold">SHORT LINK</h1>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" id="close" class="lg:hidden block cursor-pointer w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <div class="flex flex-col py-2 my-5 gap-2 p-5">
                <small class="">Menu : </small>
                <a href="{{ route('dashboard') }}"
                    class="px-2 py-1 @if (request()->is('dashboard/home')) bg-neutral text-white font-semibold @endif hover:translate-x-2 transition duration-300 ease-out rounded-sm">Dashboard</a>
                <a href="{{ route('dashboard@custom') }}"
                    class="px-2 py-1 @if (request()->is('dashboard/custom')) bg-neutral text-white font-semibold @endif hover:translate-x-2 transition duration-300 ease-out rounded-sm">Custom
                    Link</a>
                <a href="{{ route('dashboard@qr') }}"
                    class="px-2 py-1 @if (request()->is('dashboard/qr')) bg-neutral text-white font-semibold @endif hover:translate-x-2 transition duration-300 ease-out rounded-sm">QR
                    Codes</a>
                <a href="/">Back</a>
            </div>
        </div>
        <div class="w-full">
            <div class="navbar border-b sticky top-0 z-10 flex items-center justify-between w-full h-12 p-5"
                data-theme="light">
                <div class="flex gap-3">
                    <label class="swap swap-rotate p-2 rounded-sm transition-all">
                        <input type="checkbox" id="menu" />
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="swap-on w-5 h-5 ">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="swap-off w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </label>
                    <div class="breadcrumbs">
                        <ul>
                            <li></li>
                            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            @if (request()->is('dashboard/custom'))
                                <li><a href="{{ route('dashboard@custom') }}">Custom Link</a></li>
                            @endif
                            @if (request()->is('dashboard/qr'))
                                <li><a href="{{ route('dashboard@qr') }}">Code QR</a></li>
                            @endif
                            @if (request()->is('dashboard/api'))
                                <li><a href="{{ route('dashboard@api') }}">Api</a></li>
                            @endif
                            @if (request()->is('dashboard/profile'))
                                <li><a href="{{ route('profile.index') }}">Api</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="flex gap-3 me-5">
                    <div class="dropdown dropdown-bottom dropdown-end">
                        <div class="cursor-pointer" tabindex="0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                            </svg>
                        </div>
                        <ul tabindex="0" class="dropdown-content z-[1] p-2 menu mt-7 shadow rounded-md w-72 border">
                            <span class="font-medium">Not Have Notification ! </span>
                        </ul>

                    </div>
                    <label class="swap swap-rotate p-2 rounded-sm transition-all">
                        <input type="checkbox" id="mode" />
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="swap-on w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="swap-off w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                        </svg>
                    </label>
                    <div class="dropdown dropdown-bottom dropdown-end">
                        <div class="avatar cursor-pointer" tabindex="0">
                            <div class="rounded-full w-10">
                                <img src="https://daisyui.com//images/stock/photo-1534528741775-53994a69daeb.jpg"
                                    alt="">
                            </div>
                        </div>
                        <ul tabindex="0"
                            class="dropdown-content z-[1] menu p-2 mt-4 shadow bg-base-100 rounded-box w-52">
                            <li><a href="{{ route('profile.index') }}">Profile</a></li>
                            <li>
                                <form action="{{ route('auth@logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-red-800 hover:text-red-800 pe-24 ">Logout</a>
                                </form>
                            </li>
                            <hr>
                            <li><span class="text-sm">User Limit : {{ auth()->user()->limit }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="px-5 py-2">
                @yield('dashboard.index')
                @yield('dashboard.custom')
                @yield('dashboard.qr')
                @yield('profile.index')
            </div>

        </div>
    </div>
</body>
@yield('js.profile')
<script type="text/javascript" defer>
    theme = localStorage.getItem('theme');
    jQuery('[data-theme]').each((index, x) => {
        jQuery(x).attr('data-theme', theme)
    })
    jQuery('#mode').click((e) => {
        jQuery('[data-theme]').each((index, x) => {
            if (jQuery(x).attr('data-theme') == 'light') {
                localStorage.setItem('theme', 'dark')
                jQuery(x).attr('data-theme', localStorage.getItem('theme'));
            } else {
                localStorage.setItem('theme', 'light')
                jQuery(x).attr('data-theme', localStorage.getItem('theme'));
            }
        });
    });
    jQuery('#menu').click((e) => {
        jQuery('.sidebar').toggle('hidden');
    })
    jQuery('#close').click((e) => {
        jQuery('.sidebar').toggle('hidden')
    });
</script>

</html>
