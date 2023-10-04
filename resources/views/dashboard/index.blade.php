@extends('dashboard.app')
@section('title', 'Dashboard')
@section('dashboard.index')
    <div class="relative pb-1 mb-5">
        <h1 class="text-2xl font-semibold">DASHBOARD ANALYTICS</h1>
        <hr class="w-10 h-1 bg-slate-700">
    </div>
    <div class="grid lg:grid-cols-4 sm:grid-cols-2 gap-2 w-full mb-5">
        <div class="flex flex-col p-3 mb-2 items-center border-s-4 border-slate-700 shadow rounded-md">
            <span class="font-semibold">Ip Address</span>
            <span>@if(auth()->user()->ip_address == null) 127.0.0.1 @else {{ auth()->user()->ip_address }} @endif</span>
        </div>
        <div class="flex flex-col p-3 mb-2 items-center border-s-4 border-slate-700 shadow rounded-md">
            <span class="font-semibold">Visitor ALL</span>
            <span>{{ $totalVisitor }}</span>
        </div>
        <div class="flex flex-col p-3 mb-2 items-center border-s-4 border-slate-700 shadow rounded-md">
            <span class="font-semibold">Link Active</span>
            <span>{{ $active }}</span>
        </div>
        <div class="flex flex-col p-3 mb-2 items-center border-s-4 border-slate-700 shadow rounded-md">
            <span class="font-semibold">Type Account</span>
            <span>{{ Auth()->user()->type }}</span>
        </div>
    </div>
    <div class="mb-5 border p-3 rounded-md shadow-sm">
        {{-- <div class="flex lg:flex-row md:flex-row flex-col gap-3 items-center justify-between mb-3">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="fill-current w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
                <input type="text" class="border outline-none rounded-md input-sm">
                <button class="btn btn-sm btn-neutral">Search</button>
            </div>
            <a href="" class="btn btn-neutral btn-sm rounded-md">Download Report</a>
        </div> --}}
        <div class="overflow-x-auto">
            <table class="table w-full text-center p-2 whitespace-nowrap">
                <thead class="">
                    <tr>
                        <td class="p-2 flex items-center justify-center">
                            <span>ID</span>
                            <label class="swap swap-rotate">
                                <input type="checkbox">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="swap-off fill-current w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="swap-on fill-current w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                </svg>
                            </label>
                        </td>
                        <td class="p-2">LINK</td>
                        <td class="p-2 flex items-center justify-center">
                            <span>STATUS</span>
                            <label class="swap swap-rotate">
                                <input type="checkbox">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="swap-off fill-current w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="swap-on fill-current w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                </svg>
                            </label>
                        </td>
                        <td class="p-2">EXPIRES</td>
                        <td class="p-2">VISITOR</td>
                        <td class="p-2">ACTION</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $x)
                        <tr>
                            <td class="p-2">{{ $data->firstItem() + $key }}</td>
                            <td class="p-2">{{ $x->to_link }}</td>
                            <td class="p-2">
                                @if ($x->status == 1)
                                    <span class="badge badge-success text-white font-serif badge-sm">Active</span>
                                @else
                                    <span class="badge badge-error text-white font-serif badge-sm">Non Active</span>
                                @endif
                            </td>
                            <td class="p-2">
                                @if ($x->expires_at == null)
                                    -
                                @else
                                    {{ $x->expires_at }}
                                @endif
                            </td>
                            <td class="p-2">{{ $x->visitor }}</td>
                            <td class="p-2">
                                <button class="btn btn-sm btn-neutral"
                                    onclick="D{{ $x->code }}.showModal()">Details</button>
                                <dialog id="D{{ $x->code }}" class="modal modal-bottom sm:modal-middle">
                                    <div class="modal-box text-start select-none">
                                        <h3 class="font-bold text-lg">This more details info !</h3>
                                        <hr>
                                        <div class="grid grid-cols-2 place-content-start gap-2 my-2 mt-5 whitespace-normal">
                                            <span>Base URL :</span>
                                            <span><a href="{{ $x->from_link }}"
                                                    class="hover:text-primary transition duration-300">{{ $x->from_link }}</a></span>
                                            <span>Short URL :</span>
                                            <span><a href="{{ $x->to_link }}"
                                                    class="hover:text-primary transition duration-300">{{ $x->to_link }}</a></span>
                                            <span>Status</span>
                                            <span>
                                                @if ($x->status == 1)
                                                    <span
                                                        class="badge badge-success text-white font-serif badge-sm">Active</span>
                                                @else
                                                    <span class="badge badge-error text-white font-serif badge-sm">Non
                                                        Active</span>
                                                @endif
                                            </span>
                                            <span>Visitor :</span>
                                            <span>{{ $x->visitor }}</span>
                                            <span>Custom Link :</span>
                                            <span>
                                                @if ($x->custom == null)
                                                    <span>False</span>
                                                @else
                                                    <span>True</span>
                                                @endif
                                            </span>
                                            <span>Expires Date :</span>
                                            <span>
                                                @if ($x->expires_at == null)
                                                    -
                                                @else
                                                    {{ $x->expires_at }}
                                                @endif
                                            </span>
                                            <span>Created Date :</span>
                                            <span>{{ $x->created_at }}</span>

                                        </div>
                                        <div class="modal-action">
                                            <form method="dialog">
                                                <button class="btn">Close</button>
                                            </form>
                                        </div>
                                    </div>
                                </dialog>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($data->total() > 5)
            <div class="flex justify-between my-5">
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
    </div>
    @endif
@endsection
