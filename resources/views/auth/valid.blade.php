@extends('auth.app')
@section('title', 'Reset Password')
@section('header', 'Reset Password')
@section('auth.reset_valid')
    <form action="{{ route('auth@reset_store') }}" method="POST" class="flex flex-col gap-3 text-sm my-3">
        @method('PATCH')
        @csrf
        <div class="">
            <span>Password Baru : </span>
            <div class="join w-full">
                <input type="password" name="New Password"
                    class="input input-sm input-bordered rounded-sm join-item w-full px-2 focus:outline-none">
                <div class="join-item flex items-center rounded-sm border px-2">
                    <label class="swap swap-rotate">
                        <input type="checkbox" data-name="New Password">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="swap-off text-info w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="swap-on text-info w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </label>
                </div>
            </div>
            @error('New_Password')
                <span class="text-error">{{ $message }}</span>
            @enderror
        </div>
        <div class="">
            <span>Konfirmasi Password Baru : </span>
            <div class="join w-full">
                <input type="password" name="Konfirmasi New Password"
                    class="input input-sm input-bordered rounded-sm join-item w-full px-2 focus:outline-none">
                <div class="join-item flex items-center rounded-sm border px-2">
                    <label class="swap swap-rotate">
                        <input type="checkbox" data-name="Konfirmasi New Password">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="swap-off text-info w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="swap-on text-info w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </label>
                </div>
            </div>
            @error('Konfirmasi_New_Password')
                <span class="text-error">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-sm btn-info rounded-sm w-full text-white">Simpan Perubahan</button>
    </form>
@endsection
@section('js.reset')
    <script type="text/javascript" defer>
        jQuery(document).ready(() => {
            jQuery('input[type="checkbox"]').each((i, x) => {
                jQuery(x).click((e) => {
                    _i = jQuery(`input[name="${jQuery(x).attr('data-name')}"]`)
                    if (_i[0].type === "password") return _i[0].type = 'text';
                    return _i[0].type = 'password'
                });
            })
        });
    </script>
@endsection
