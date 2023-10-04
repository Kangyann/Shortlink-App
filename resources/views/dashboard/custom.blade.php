@extends('dashboard.app')
@section('title', 'Custom Link')
@section('dashboard.custom')
    <div class="">
        <div class="relative pb-1 mb-5">
            <h1 class="text-2xl font-semibold">CUSTOM LINK</h1>
            <hr class="w-10 h-1 bg-gray-700 rounded-full">
        </div>
        <small>Easy custom for your link own.</small>
        <div class="my-1 p-3 border rounded-md">
            <div class="breadcrumbs text-sm font-semibold">
                <ul>
                    <li>Custom Limit</li>
                    <li>{{ auth()->user()->limit }}</li>
                </ul>
                <hr class="w-10 h-1 bg-gray-700 rounded-full">
            </div>
            <div class="relative flex flex-col gap-3 p-2 rounded-md">
                @if (auth()->user()->limit == 0)
                    <div class="absolute top-0 left-0 rounded-md p-2 z-[2] w-full h-full">
                        <div class="flex flex-col items-center justify-center h-full">
                            <span class="font-semibold text-xl">Limit Reached </span>
                            <a href="https://wa.me/6283895886895/?text=Upgrade Account!" class="text-blue-500 btn btn-neutral btn-sm my-1">Upgrade your account
                                now.</a>
                        </div>
                    </div>
                @endif
                <form action="{{ route('custom@create') }}"
                    method="POST"@if (auth()->user()->limit == 0) class="blur-[2px] select-none" @endif>
                    <div>
                        <span>Custom Code </span>
                        <div class="input-group w-full">
                            <span class="text-sm">{{ config('app.url') }}</span>
                            <input type="text" name="code" class="border outline-none input-sm w-full"
                                placeholder="Kangyann" value="{{ old('code') }}">
                        </div>
                        @error('code')
                            <span class="text-sm text-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <span>To URL </span>
                        <input type="text" name="url" class="border outline-none rounded-md input-sm w-full"
                            placeholder="Ex. {{ config('app.url') }}" value="{{ old('url') }}">
                        @error('url')
                            <span class="text-sm text-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <span>Expires (Optional) </span>
                        <input type="datetime-local" name="expires_at"
                            class="border outline-none rounded-md input-sm w-full">
                    </div>
                    @method('PATCH')
                    @csrf
                    <div class="my-3">
                        <button type="submit" class="btn btn-sm btn-neutral">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
