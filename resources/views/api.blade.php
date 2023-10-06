@extends('app')
@section('title', 'API Docs')
@section('api')
    <h1 class="text-3xl font-bold font-serif text-info mb-5">API DOCS</h1>
    <div class="text-start shadow border p-3 rounded-sm mb-3 text-sm">
        <p class="text-xl font-semibold border-b font-serif">DOCUMENTATION</p>
        <div class="text-justify my-2">Tersedia api untuk generate QR Code dan Shortlink url di {{ config('app.url') }}.
            Dengan limit tersedia 100 Limit untuk pendaftar baru, bergabung sekarang untuk mendapatkan akses api_key anda.
        </div>
        <span class="font-semibold font-serif">Parameter Required : </span>
        <div class="grid lg:grid-cols-2 mb-2 gap-2">
            <div class="flex flex-col">
                <span class="font-semibold">Shortlink API : </span>
                <span>url -> required, type:string,url</span>
                <span>api_key -> required, type:string</span>
            </div>
            <div class="flex flex-col">
                <span class="font-semibold">QRCode API : </span>
                <span>text -> required, type:string</span>
                <span>api_key -> required, type:string</span>
            </div>
            <span class="my-2"><a href="" class="text-primary underline">Create account </a>for
                api_key</span>
        </div>
    </div>
    <div class="tabs flex justify-center translate-y-[0.06rem]">
        <a class="tab tab-lifted  tab-active transition-all border-0" data-page="link">Link API</a>
        <a class="tab tab-lifted transition-all border-0 " data-page="qr">QR API</a>
    </div>

    <div class="p-3 rounded-md border shadow-sm text-start">
        <div class="mockup-browser">
            <div class="mockup-browser-toolbar">
                <div class="input border border-base-300">{{ config('app.url') }}api/v1/</div>
            </div>
            <div class="list" id="link">
                <div class="p-3 my-3 rounded-md shadow-md border">
                    <form action="">
                        <span id="url_shortlink"
                            class="border px-2 py-2 rounded-sm text-sm select-none">{{ config('app.url') }}api/v1/shortlink</span>
                        <div class="join border w-full flex items-center rounded-sm text-sm mt-3 font-semibold">
                            <span class="join-item px-3 bg-info py-1 m-1 rounded-sm select-none">GET</span>
                            <input type="text" name="shortlink" class="pe-2 join-item outline-none w-full"
                                value="?url=URL&api_key=YOUR_API_KEY">
                            <button type="submit" class="join-item btn btn-sm btn-info text-white" id="shortlink">TEST
                                ENDPOINT</button>
                        </div>
                        <span class="text-sm">Example : <br>
                            {{ config('app.url') }}api/v1/shortlink?url=https://vilxys.com/&api_key=example123</span>
                    </form>
                    <div class="my-2 p-3 rounded-md text-sm overflow-auto hidden" id="ressult_shortlink" data-theme="dark">
                    </div>
                </div>

                <div class="join join-vertical w-full">
                    <div class="collapse collapse-arrow join-item border border-base-300">
                        <input type="radio" name="link" checked='checked' />
                        <div class="collapse-title font-semibold text-md font-serif">RESPONSE SUCCESS</div>
                        <div class="collapse-content overflow-x-auto text-sm">
                            <div class="mb-3 p-3 rounded-md overflow-auto" data-theme="dark">
                                <pre><code>{
    message : <span class="text-success">"Berhasil"</span>,
    data : {
        base_url : "https://example.ex/",
        short_url : "https://example.ex/",
        code : "code",
       },
    user_limit : 100,
}    </code></pre>
                            </div>
                        </div>
                    </div>
                    <div class="collapse collapse-arrow join-item border border-base-300 cursor-pointer">
                        <input type="radio" name="link" />
                        <div class="collapse-title font-semibold text-md font-serif">RESPONSE FAILED</div>
                        <div class="collapse-content overflow-x-auto text-sm">
                            <div class="mb-3 p-3 rounded-md overflow-auto" data-theme="dark">
                                <pre><code>{
    message : <span class="text-error">"Parameter url & api_key dibutuhkan."</span>
}    </code></pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--  --}}
            {{--  --}}
            <div class="list hidden" id="qr">
                <div class="p-3 my-3 rounded-md shadow-md border">
                    <form action="">
                        <span id="url_qr"
                            class="border px-2 py-2 rounded-sm text-sm select-none">{{ config('app.url') }}api/v1/qrcode</span>
                        <div class="join border w-full flex items-center rounded-sm text-sm mt-3 font-semibold">
                            <span class="join-item px-3 bg-info py-1 m-1 rounded-sm select-none">GET</span>
                            <input type="text" name="qrcode" class="pe-3 join-item outline-none w-full"
                                value="?text=TEXT&api_key=YOUR_API_KEY">
                            <button type="submit" name="qr" class="join-item btn btn-sm btn-info text-white"
                                id="qrcode">TEST
                                ENDPOINT</button>
                        </div>
                        <span class="text-sm">Example : <br>
                            {{ config('app.url') }}api/v1/qrcode?text=kangyann&api_key=example123</span>
                    </form>
                    <div class="my-2 p-3 rounded-md text-sm overflow-auto hidden" id="ressult_qr" data-theme="dark">
                    </div>
                </div>
                <div class="join join-vertical w-full">
                    <div class="collapse collapse-arrow join-item border border-base-300">
                        <input type="radio" name="qr" checked='checked' />
                        <div class="collapse-title font-semibold text-md font-serif">RESPONSE SUCCESS</div>
                        <div class="collapse-content overflow-x-auto text-sm">
                            <div class="mb-3 p-3 rounded-md overflow-auto" data-theme="dark">
                                <pre><code>{
    message : <span class="text-success">"Berhasil"</span>
    data : {
        string : "Lorem Ipsum",
        qr_code : "https://example.ex/file/{ex.png}",
        image : "code"
    },
    user_limit : 100,
}    </code></pre>
                            </div>
                        </div>
                    </div>
                    <div class="collapse collapse-arrow join-item border border-base-300 cursor-pointer">
                        <input type="radio" name="qr" />
                        <div class="collapse-title font-semibold text-md font-serif">RESPONSE FAILED</div>
                        <div class="collapse-content overflow-x-auto text-sm">
                            <div class="mb-3 p-3 rounded-md overflow-auto" data-theme="dark">
                                <pre><code>{
    message : <span class="text-error">"Parameter text & api_key dibutuhkan."</span>
}    </code></pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('js.api')
    <script type="text/javascript" defer>
        jQuery('.tab').each((i, x) => {
            jQuery(x).click((e) => {
                const _content = jQuery(`#${jQuery(x).attr('data-page')}`)
                jQuery('.list').each((i, x) => {
                    jQuery(x).addClass('hidden');
                })
                jQuery(_content).removeClass('hidden');
                jQuery('.tab').each((i, x) => {
                    jQuery(x).removeClass('tab-active')
                })
                jQuery(x).addClass('tab-active')
            })
        })

        jQuery(document).ready(() => {
            jQuery('#shortlink').click((e) => {
                e.preventDefault();
                jQuery('#ressult_shortlink').removeClass('hidden');
                const params = new URLSearchParams(jQuery('input[name="shortlink"]').val()),
                    data = {
                        url: params.get('url'),
                        api_key: params.get('api_key'),
                    }
                jQuery.ajax({
                    type: "method",
                    method: 'GET',
                    url: jQuery('#url_shortlink').text(),
                    data: data,
                    success: (response) => {
                        jQuery('#ressult_shortlink').html(
                            `<pre>${JSON.stringify(response,null,2)}</pre>`);
                    },
                    error: (xhr, textStatus, errorThrown) => {
                        if (xhr.responseJSON) {
                            jQuery('#ressult_shortlink').html(
                                `<pre>${JSON.stringify(xhr.responseJSON,null,2)}</pre>`);
                        }
                    }
                });
            });
            jQuery('#qrcode').click((e) => {
                e.preventDefault();
                jQuery('#ressult_qr').removeClass('hidden');
                const params = new URLSearchParams(jQuery('input[name="qrcode"]').val()),
                    data = {
                        text: params.get('text'),
                        api_key: params.get('api_key'),
                    }
                jQuery.ajax({
                    type: "method",
                    method: 'GET',
                    url: jQuery('#url_qr').text(),
                    data: data,
                    success: (response) => {
                        jQuery('#ressult_qr').html(
                            `<pre>${JSON.stringify(response,null,2)}</pre>`);
                    },
                    error: (xhr, textStatus, errorThrown) => {
                        if (xhr.responseJSON) {
                            jQuery('#ressult_qr').html(
                                `<pre>${JSON.stringify(xhr.responseJSON,null,2)}</pre>`);
                        }
                    }
                });
            });
        });
    </script>
@endsection
