@extends('app')
@section('title', 'Shortlink')
@section('home')
    <h1 class="font-bold text-3xl text-info mb-5 font-serif">URL Shortenner</h1>
    <div class="shadow-slate-500 shadow rounded-md p-5 mb-5" >
        <h2 class="font-inter text-xl mb-3 font-semibold font-serif">Paste Your URL To Shorten</h2>
        <form action="{{ route('short@store') }}" method="POST">
            @csrf
            <div class="join w-full border rounded-sm">
                <input type="text" name="url" class="w-full input-sm join-item p-1 px-2 outline-none"
                    placeholder="https://example.com/">
                <button type="submit" name="submit" value="guest"
                    class="btn btn-sm btn-info text-white join-item border ">Short</button>
            </div>
            @error('url')
                <div class="text-start text-sm text-red-600 mb-1">{{ $message }}</div>
            @enderror
            @if (session('data'))
                <h2 class="text-start mb-1 mt-3 text-sm font-semibold">Ressult</h2>
                <div class="join w-full rounded-sm border">
                    <input type="text" value="{{ session('data') }}" class="input input-sm select-none join-item w-full"
                        disabled>
                    <button type="button" class="btn btn-sm btn-info text-white join-item">COPY</button>
                </div>
            @endif
        </form>
        <span class="text-sm text-justify indent-2">ShortURL is a free tool to shorten URLs and generate short links
            URL shortener allows to create a shortened link making it easy to share</span>
        <div class="text-start mt-3">
            <h2 class="font-semibold text-lg font-serif">Premium Features</h2>
            <div class="my-3">
                <ul class="grid lg:grid-cols-3 gap-1">
                    <li>Dashboard</li>
                    <li>Custom Link</li>
                    <li>Generate QR Code</li>
                    <li>Tracking Visitor</li>
                    <li>API</li>
                    <li>Notification</li>
                </ul>
            </div>
            <span><a href="{{ route('auth@signup') }}" class="text-cyan-500">Signup Now</a> to get premium features </span>
        </div>
    </div>
    <div class="text-start mb-10">
        <div class="mb-3">
            <h2 class="font-semibold font-serif">Simple and fast URL shortener!</h2>
            <span>ShortURL allows to shorten long links from Instagram, Facebook, YouTube, Twitter, Linked In, WhatsApp,
                TikTok,
                blogs and sites. Just paste the long URL and click the Shorten URL button. On the next page, copy the
                shortened
                URL and share it on sites, chat and emails. After shortening the URL, check how many clicks it
                received.</span>
        </div>
        <div class="mb-1">
            <h2 class="font-semibold font-serif">Shorten, share and track</h2>
            <span>Your shortened URLs can be used in publications, documents, advertisements, blogs, forums, instant
                messages,
                and other locations. Track statistics for your business and projects by monitoring the number of hits from
                your
                URL with our click counter.</span>
        </div>
    </div>
    <div class="grid lg:grid-cols-3 grid-cols-2 gap-10">
        @foreach ($source as $s)
            <div class="w-full">
                <img src="{{ asset('assets/images/') }}/{{ $s['image'] }}" alt="{{ $s['title'] }}" class="w-12 mx-auto">
                <div class="flex flex-col mt-2">
                    <span class="font-semibold font-serif">{{ $s['title'] }}</span>
                    <span class="text-sm">{{ $s['desc'] }}</span>
                </div>
            </div>
        @endforeach
    </div>
@endsection
