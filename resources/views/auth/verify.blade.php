@extends('auth.app')
@section('auth.verify')
    <form action="{{ route('auth@verify_store') }}" method="POST" class="flex flex-col items-center text-center gap-3">
        @method('PATCH')
        @csrf
        <div class="">
            <span>Masukan Kode Verifikasi</span>
            <div class="my-3">
                <input type="text" name="token"
                    class="text-base font-semibold text-center input input-sm border-b border-0 rounded-none border-b-base-300 transition duration-500 ease-in-out w-32 focus:outline-none focus:border-b-info"
                    maxlength="6" placeholder="XXXXXX" style="letter-spacing: 5px">
            </div>
            @error('token')
                <span class="text-error text-sm">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-sm w-full text-white btn-info rounded-sm">Verifikasi</button>
    </form>
@endsection
