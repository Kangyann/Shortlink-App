@extends('auth.app')
@section('auth.verify')
    <form action="{{ route('auth@verify_store') }}" method="POST" class="flex flex-col items-center text-center gap-3">
        @method('PATCH')
        @csrf
        <div class="">
            <span>Masukan Kode Verifikasi</span>
            <div class="mt-3">
                <input type="text" name="token"
                    class="text-base font-semibold text-center input input-sm border-b border-0 rounded-none border-b-base-300 tracking-wide transition duration-500 ease-in-out w-32 focus:outline-none focus:border-b-info"
                    maxlength="6" placeholder="XXXXXX" value="{{ old('token') }}">
            </div>
            @error('token')
                <span class="text-error text-sm">{{ $message }}</span>
            @enderror
        </div>
        <span class="text-sm text-success flex flex-col font-medium line" id="ressult">
        </span>
        <span class="text-sm countdown">Tidak mendapatkan kode ? <span id="countdown-time" style="--value:10;"></span><a
                id="send_again" name="{{ auth()->user()->id }}" class="cursor-pointer text-info"> Kirim
                Ulang.</a></span>
        <button type="submit" class="btn btn-sm w-full text-white btn-info rounded-sm">Verifikasi</button>
    </form>
@endsection
@section('js.verify')
    <script type="text/javascript" defer>
        jQuery(document).ready(() => {
            btn = jQuery('#send_again');
            jQuery(btn).click((e) => {
                e.preventDefault()
                jQuery.ajax({
                    method: "POST",
                    url: window.location.href,
                    data: {
                        id: jQuery(btn).attr('name'),
                        _token: jQuery('input[name="_token"]').val()
                    },
                    success: function(response) {
                        let counter = 60
                        interval = setInterval(() => {
                            if (counter > 0) {
                                counter--
                                btn.addClass('hidden')
                                jQuery('#ressult').text(`${response.message}`);
                                jQuery('#countdown-time').text(`${counter} sec`)
                            } else {
                                btn.removeClass('hidden')
                                jQuery('#countdown-time').text('')
                                jQuery('#ressult').text('');
                                clearInterval(interval);
                                return 0;
                            }
                            jQuery('#countdown-time').prop('--value', counter)
                        }, 1000)
                    }
                });
            })
        });
    </script>
@endsection
