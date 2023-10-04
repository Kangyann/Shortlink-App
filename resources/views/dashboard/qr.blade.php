@extends('dashboard.app')
@section('title', 'API Docs')
@section('dashboard.qr')
    <div>
        <div class="relative pb-1 mb-5">
            <h1 class="text-2xl font-semibold">QR Generate</h1>
            <hr class="w-10 h-1 bg-gray-700 rounded-full">
        </div>
        <div class="overflow-x-auto border p-3 rounded-md mb-5 shadow-sm">
            <table class="table text-center whitespace-nowrap">
                <thead>
                    <tr>
                        <td class="p-2">ID</td>
                        <td class="p-2">To URL</td>
                        <td class="p-2">From URL</td>
                        <td class="p-2">Expires Date</td>
                        <td class="p-2">Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $x)
                        <tr>
                            <td class="p-2">{{ $data->firstItem() + $key }}</td>
                            <td class="p-2">{{ $x->to_link }}</td>
                            <td class="p-2">{{ $x->from_link }}</td>
                            <td class="p-2">@if($x->expires_at == null) - @else {{ $x->expires_at }} @endif</td>
                            <td class="p-2">
                                @if ($x->qr == null)
                                    <form action="{{ route('qr@create', ['id' => $x->id]) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-neutral">Create</button>
                                    </form>
                                @else
                                    <button class="btn btn-sm btn-neutral" onclick="Q{{ $x->code }}.showModal()"><svg
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </button>
                                    <dialog id="Q{{ $x->code }}" class="modal modal-bottom sm:modal-middle">
                                        <div class="modal-box">
                                            <h3 class="font-bold text-lg">This your QR Code</h3>
                                            <div class="flex justify-center mb-3">
                                                <img src="{{ asset('storage/') }}/{{ $x->qr }}" alt=""
                                                    type="image/svg+xml">
                                            </div>
                                            <span>{{ $x->to_link }}</span>
                                            <p class="py-4">Press ESC key or click the button below to close</p>
                                            <div class="modal-action">
                                                <form method="dialog">
                                                    <button class="btn">Close</button>
                                                </form>
                                            </div>
                                        </div>
                                    </dialog>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($data->total() > 5)
                <div class="flex justify-between mt-5">
                    <div class="text-sm">
                        <span>
                            Showing {{ $data->firstItem() }}
                            to {{ $data->lastItem() }}
                            of {{ $data->total() }} entries
                        </span>
                    </div>
                    <div class="join rounded-sm">
                        <a href="{{ $data->previousPageUrl() }}" class="join-item btn btn-outline btn-xs"
                            @if ($data->onFirstPage()) disabled @endif>Previous</a>
                        <a href="{{ $data->nextPageUrl() }}" @if ($data->currentPage() == $data->lastPage()) disabled @endif
                            class="join-item btn btn-outline btn-xs">Next</a>
                    </div>
                </div>
            @endif
        </div>
        <form action="{{ route('qr@create', ['p' => true]) }}" class="border p-3 rounded-md shadow-sm" method="POST">
            @csrf
            <span>Generate from other Link you have.</span>
            <div class="mb-3 mt-1">
                <input type="text" name="url" class="input-sm border rounded-md w-full outline-none"
                    placeholder="https://domain.ex/example">
                @error('url')
                    <span class="text-sm text-error">{{ $message }}</span>
                @enderror
            </div>
            <input type="submit" value="Generate" class="btn btn-neutral rounded-md btn-sm">
        </form>
        <div class="overflow-x-auto border p-3 rounded-md my-5 shadow-sm">
            <table class="table text-center whitespace-nowrap">
                <thead>
                    <tr>
                        <td class="p-2">ID</td>
                        <td class="p-2">URL</td>
                        <td class="p-2">QR</td>
                        <td class="p-2">Created Date</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($qr as $key => $x)
                        <tr>
                            <td>{{ $qr->firstItem() + $key }}</td>
                            <td>{{ $x->url }}</td>
                            <td class="p-2"><button class="btn btn-sm btn-neutral"
                                    onclick="C{{ $x->code }}.showModal()"><svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </button>
                                <dialog id="C{{ $x->code }}" class="modal modal-bottom sm:modal-middle">
                                    <div class="modal-box">
                                        <h3 class="font-bold text-lg">This your QR Code</h3>
                                        <div class="flex justify-center mb-3">
                                            <img src="{{ asset('storage/') }}/{{ $x->qr }}" alt=""
                                                type="image/svg+xml">
                                        </div>
                                        <span>{{ $x->url }}</span>
                                        <p class="py-4">Press ESC key or click the button below to close</p>
                                        <div class="modal-action">
                                            <form method="dialog">
                                                <!-- if there is a button in form, it will close the modal -->
                                                <button class="btn">Close</button>
                                            </form>
                                        </div>
                                    </div>
                                </dialog>
                            </td>
                            <td>{{ $x->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($qr->total() > 5)
                <div class="flex justify-between mt-5">
                    <div class="text-sm">
                        <span>
                            Showing {{ $qr->firstItem() }}
                            to {{ $qr->lastItem() }}
                            of {{ $qr->total() }} entries
                        </span>
                    </div>
                    <div class="join rounded-sm">
                        <a href="{{ $qr->previousPageUrl() }}" class="join-item btn btn-outline btn-xs"
                            @if ($qr->onFirstPage()) disabled @endif>Previous</a>
                        <a href="{{ $qr->nextPageUrl() }}" @if ($qr->currentPage() == $qr->lastPage()) disabled @endif
                            class="join-item btn btn-outline btn-xs">Next</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
