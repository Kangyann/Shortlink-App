@extends('dashboard.app')
@section('profile.index')
    <div class="flex lg:flex-row md:flex-row flex-col justify-center items-center gap-3 mt-10">
        <div class="flex flex-col items-center p-3 px-6 rounded-md border shadow-sm lg:w-80 md:w-80">
            <span class="text-xl font-medium font-serif">UBAH PASSWORD</span>
            <hr class="mb-3 w-full">
            <div class="avatar w-24">
                <img src="https://daisyui.com//images/stock/photo-1534528741775-53994a69daeb.jpg" alt=""
                    class="rounded-full">
            </div>
            <span class="mt-1 mb-3">{{ auth()->user()->type }}</span>
            <form action="{{ route('profile.update', ['profile' => auth()->user()->id]) }}" method="POST"
                class="w-full text-sm">
                @csrf
                @method('PATCH')
                <div class="mb-2">
                    <span>Password Baru</span>
                    <div class="join w-full border mt-1">
                        <input type="password" name="New Password"
                            class="input input-sm focus:outline-none w-full join-item" placeholder="Password Baru">
                        <div class="join-item px-3 flex items-center">
                            <label class="swap swap-rotate">
                                <input type="checkbox" data-name="New Password">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="swap-off w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="swap-on w-6 h-6">
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
                <div class="mb-2">
                    <span>Ulangi Password Baru</span>
                    <div class="join w-full border mt-1">
                        <input type="password" name="New Password Confirmation"
                            class="input input-sm focus:outline-none w-full join-item" placeholder="Ulangi Password Baru">
                        <div class="join-item px-3 flex items-center">
                            <label class="swap swap-rotate">
                                <input type="checkbox" data-name="New Password Confirmation">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="swap-off w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="swap-on w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </label>
                        </div>
                    </div>
                    @error('New_Password_Confirmation')
                        <span class="text-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-2">
                    <span>Konfirmasi Password</span>
                    <div class="join w-full border mt-1">
                        <input type="password" name="Old Password"
                            class="input input-sm focus:outline-none w-full join-item" placeholder="Password Lama">
                        <div class="join-item px-3 flex items-center ">
                            <label class="swap swap-rotate">
                                <input type="checkbox" data-name="Old Password">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="swap-off w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="swap-on w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </label>
                        </div>
                    </div>
                </div>
                <button type="submit" name="changepassword" class="btn btn-sm btn-primary">SAVE CHANGES</button>
            </form>
        </div>
        <div class="p-3 px-6 rounded-md border shadow-sm lg:w-[500px] md:w-[500px]">
            <span class="text-xl font-medium font-serif">INFORMASI PRIBADI</span>
            <hr class="mb-3 w-full">
            <form action="{{ route('profile.update', ['profile' => auth()->user()->id]) }}" class="text-sm"
                method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-2">
                    <span>Nama</span>
                    <div class="mt-1">
                        <input type="text" class="input input-sm input-bordered focus:outline-none rounded-md w-full"
                            value="{{ auth()->user()->name }}" name="Name" placeholder="Nama">
                    </div>
                    @error('Name')
                        <span class="text-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-2">
                    <span>Email</span>
                    <div class="mt-1">
                        <input type="text" class="input input-sm input-bordered focus:outline-none rounded-md w-full"
                            value="{{ auth()->user()->email }}" placeholder="Email" disabled>
                    </div>
                </div>
                <div class="mb-2">
                    <span>Username</span>
                    <div class="mt-1">
                        <input type="text" class="input input-sm input-bordered focus:outline-none rounded-md w-full"
                            value="{{ auth()->user()->username }}" name="Username" placeholder="Username">
                    </div>
                    @error('Username')
                        <span class="text-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-2">
                    <span>Api Key</span>
                    <div class="join w-full mt-1 ">
                        <input type="text"
                            class="input input-sm input-bordered focus:outline-none rounded-md w-full join-item"
                            value="{{ auth()->user()->api_key }}" placeholder="Api Key" disabled>
                        <button type="submit" class="btn btn-sm btn-primary join-item">GENERATE</button>
                    </div>
                </div>
                <div class="mb-2">
                    <span>White List IP</span>
                    <div class="my-1">
                        <input type="text" class="input input-sm input-bordered focus:outline-none rounded-md w-full"
                            name="White List IP" value="{{ auth()->user()->whitelist_ip }}"
                            placeholder="Ex : 127.0.0.1 , 192.168.0.1">
                    </div>
                    <span>Jika lebih dari 1. gunakan ( , ). Whitelist semua IP gunakan 1.</span>
                </div>
                <div class="mb-2">
                    <span>Konfirmasi Password</span>
                    <div class="mt-1">
                        <input type="password" class="input input-sm input-bordered focus:outline-none rounded-md w-full"
                            name="Password" placeholder="Password Lama">
                    </div>
                </div>
                <button type="submit" name="changeperson" class="btn btn-sm btn-primary">SAVE CHANGES</button>
            </form>
        </div>
    </div>
@endsection
@section('js.profile')
    <script type="text/javascript" defer>
        $('input[type="checkbox"]').each((i, x) => {
            jQuery(x).click((e) => {
                _i = jQuery(`input[name="${jQuery(x).attr('data-name')}"]`)
                if (_i[0].type === "password") return _i.type = 'text'
                return _i.type = 'password'
            })
        })
    </script>
@endsection
