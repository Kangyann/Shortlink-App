<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifyAccount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (!Auth::user()->email_verified_at)
            notyf()->addWarning('Akun anda belum terverifikasi');
            notyf()->addWarning('Cek kode yang telah dikirimkan ke Email anda.');
                return redirect()->route('auth@verify');
        }
        return $next($request);
    }
}
