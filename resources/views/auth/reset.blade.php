@extends('auth.app')
@section('title', 'Reset Password')
@section('header', 'Reset Password')
@section('auth.reset')
        <form action="{{ route('auth@reset_create') }}" method="POST" class="flex flex-col gap-3 text-sm">
            @csrf
            <span class="text-justify mt-3 text-base">Masukan alamat email yang terkait dengan akun Anda agar kami dapat
                mengirimkan tautan untuk mengatur ulang
                kata sandi akun anda.</span>
            <div class="">
                <span>Email : </span>
                <div class="">
                    <input type="email" name="email"
                        class="input input-sm input-bordered focus:outline-none rounded-sm w-full"
                        value="{{ old('email') }}">
                </div>
                @error('email')
                    <span class="text-error">{{ $message }}</span>
                @enderror
            </div>
                <button type="submit" class="btn btn-sm btn-info rounded-sm w-full text-white">Lanjutkan</button>
            <span>Tidak mempunyai akun ? <a href="{{ route('auth@signup') }}" class="text-info font-medium">Daftar Sekarang.</a></span>
        </form>
@endsection
