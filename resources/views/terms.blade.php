@extends('app')
@section('title', 'Terms of Service')
@section('terms')
    <div class="text-start">
        <h1 class="text-3xl font-semibold font-serif">Terms of Service</h1>
        <hr class="w-12 h-1 bg-base-content mb-5">
        <ul class="list-decimal ms-5 mb-5">
            <li class="font-semibold font-serif">Pengenalan</li>
            <ol class="ms-5">
                <li>Selamat datang di <a href="{{ config('app.url') }}" class="text-info">https://fdevs.biz.id/</a> (Web/App URL Shortener ). Ada beberapa Syarat dan Ketentuan sebagai berikut.</li>
            </ol>
            <li class="font-semibold font-serif">Pengumpulan Data</li>
            <ol class="list-disc ms-5">
                <li>Anda boleh membuat akun secara gratis untuk mendapatkan Akses Beberapa Fitur premium yang tersedia.</li>
                <li>Anda bertanggung jawab penuh atas keamanan akun Anda dan segala aktivitas yang terjadi di dalamnya.</li>
                <li>Anda tidak boleh memberikan akses ke akun Anda kepada pihak ketiga tanpa izin tertulis dari kami.</li>
            </ol>
            <li class="font-semibold font-serif">Penggunaan Data</li>
            <ol class="ms-5">
                <li>Kami berhak untuk membatasi akses Anda ke Website atau layanan kami jika Anda melanggar Syarat dan Ketentuan ini atau jika kami menganggap bahwa aktivitas Anda dapat merugikan Website atau pengguna lain.</li>
            </ol>
            <li class="font-semibold font-serif">Keamanan Data</li>
            <ol class="list-disc ms-5">
                <li>Kami dapat menyediakan akses ke API (Antarmuka Pemrograman Aplikasi) secara gratis. Penggunaan API ini tunduk pada Syarat dan Ketentuan khusus yang mungkin kami tetapkan.</li>
                <li>Kami berhak untuk menghentikan atau mengubah akses Anda ke API secara sewaktu-waktu.</li>
            </ol>
            <li class="font-semibold font-serif">Perubahan pada Syarat dan Ketentuan</li>
            <ol class="ms-5">
                <li>Kami berhak untuk mengubah Syarat dan Ketentuan ini kapan saja tanpa pemberitahuan sebelumnya. Perubahan tersebut akan berlaku segera setelah diposting di Website.</li>
            </ol>
        </ul>
        <span>Terms of Service ❤️ by <a href="https://chat.openai.com/" class="text-info underline decoration-wavy font-semibold">AI</a></span>
    </div>
@endsection
