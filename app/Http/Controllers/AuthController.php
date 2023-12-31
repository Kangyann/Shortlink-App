<?php

namespace App\Http\Controllers;

use App\Models\Resetpassword;
use App\Models\User;
use App\Models\Verify;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $date;
    public function __construct()
    {
        $this->date = Carbon::now('Asia/Jakarta');
    }
    public function signup()
    {
        return view('auth.signup');
    }

    public function signin()
    {
        return view('auth.signin');
    }
    public function reset(Request $request, Resetpassword $resetpassword)
    {
        if ($request->has('auth')) {
            $tokenValid = $resetpassword->where('token', '=', $request->auth)->first();
            if (!$tokenValid) return abort(403);
            return view('auth.valid', compact('tokenValid'));
        }
        return view('auth.reset');
    }
    public function verify()
    {
        if (Auth()->user()->email_verified_at) return back();
        return view('auth.verify');
    }
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $req, User $user)
    {
        $validate = Validator::make($req->all(), [
            'name' => 'min:4|max:36|required',
            'username' => 'min:4|max:18|required|unique:users,username',
            'email' => 'email:rfs|required|unique:users,email',
            'password' => 'required|min:8|confirmed:confirm',
            'password_confirmation' => 'required|min:8',
        ]);
        if ($validate->fails()) {
            notyf()->addError('Periksa kembali data yang kamu isi.');
            return redirect()->route('auth@signup')->withErrors($validate)->withInput();
        }
        $data = [
            'name' => $req->name,
            'username' => $req->username,
            'email' => $req->email,
            'password' => $req->password,
            'api_key' => Str::random(32),
            'ip_address' => $req->ip(),
            'limit' => 100
        ];
        $data['password'] = bcrypt($data['password']);
        $user->create($data);
        notyf()->addSuccess('Pendaftaran berhasil.');
        return redirect()->route('auth@signin');
    }

    public function reset_create(Request $request, User $user)
    {
        $requestData = ['email' => 'email:rfs|required'];
        $validate = Validator::make($request->only('email'), $requestData);
        if ($validate->fails()) {
            notyf()->addError('Periksa kembali data yang akan dikirimkan');
            return back()->withErrors($validate);
        }
        $userPerson = $user->where('email', '=', $request->email)->first();
        if (!$userPerson) {
            notyf()->addError('Alamat email tidak ditemukan.');
            return back()->withInput();
        }
        $token = Str::random(40);
        $date = $this->date->addMinutes(30);
        $expires = $date->format('Y-m-d h:i:s');
        $requestPasswordData = ['email' => $request->email, 'token' => $token, 'expires_at' => $expires];
        $data = [
            'email' =>  $request->email,
            'text' => 'Link Resetpassword : ' . env('APP_URL') . 'auth=' . $token,
            'category' => 'Resetpassword'
        ];
        Verify::sendMail($data);
        Resetpassword::create($requestPasswordData);
        notyf()->addSuccess('Link reset password telah dikirim ke email anda.');
        notyf()->addSuccess('Cek inbox atau spam.');
        return back();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $validate = Validator::make($req->only('email', 'password'), [
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($validate->fails()) {
            notyf()->addError('Periksa kembali data anda.');
            return back()->withInput();
        }
        if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
            $req->session()->regenerateToken();
            $user = User::where('email', '=', $req->email)->first();
            if (!$user->email_verified_at) {
                $codeVerif = mt_rand(000000, 999999);
                $date = $this->date->addMinutes(30);
                $expires = $date->format('Y-m-d h:i:s');
                $data = [
                    'email' =>  $req->email,
                    'text' => 'Code Verifikasi Anda : ' . $codeVerif,
                    'category' => 'Verifikasi Akun'
                ];
                Verify::sendMail($data);
                Verify::create([
                    'username' => $user->username,
                    'token' => $codeVerif,
                    'expires_at' => $expires
                ]);
                notyf()->addSuccess('Berhasil masuk. Silakan verifikasi terlebih dahulu');
                return redirect()->route('auth@verify');
            }

            notyf()->addSuccess('Berhasil masuk.');
            return redirect('/');
        }
        notyf()->addError('Email atau password salah.');
        return redirect()->route('auth@signin')->withErrors($validate)->withInput();
    }

    public function reset_store(Request $request, Resetpassword $resetpassword, User $user)
    {
        $requestData = [
            'New_Password' => 'required|min:8',
            'Konfirmasi_New_Password' => 'required|min:8|same:New_Password'
        ];
        $validate = Validator::make($request->only('New_Password', 'Konfirmasi_New_Password'), $requestData);
        if ($validate->fails()) {
            notyf()->addError('Periksa kembali, dan isi password dengan sesuai');
            return back()->withErrors($validate);
        }
        $tokenValid = $resetpassword->where('token', $request->token)->first();
        $now = $this->date->format('Y-m-d h:i:s');
        $userPerson = $user->where('email', $tokenValid->email)->first();
        if ($tokenValid->expires_at < $now) {
            notyf()->addError('Link telah kadaluarsa. Silahkan kirim ulang.');
            $tokenValid->delete();
            return redirect()->route('auth@reset');
        }
        $userPerson->update(['password' => bcrypt($request->New_Password)]);
        $tokenValid->delete();
        notyf()->addSuccess('Password berhasil diperbaharui.');
        return redirect()->route('auth@signin');
    }
    public function verify_store_again(Verify $verify)
    {
        $token = mt_rand(000000, 999999);
        $date = $this->date->addMinutes(30);
        $expires = $date->format('Y-m-d h:i:s');
        $find = $verify->where('username', '=', Auth()->user()->username);
        if ($find) {
            $find->delete();
        }
        $data = [
            'email' =>  Auth::user()->email,
            'text' => 'Code Verifikasi Anda : ' . $token,
            'category' => 'Verifikasi Akun'
        ];
        Verify::sendMail($data);
        Verify::create([
            'username' => Auth::user()->username,
            'token' => $token,
            'expires_at' => $expires
        ]);
        $response = [
            'message' => 'Code berhasil dikirim. Cek Inbox atau Spam didalam email anda.',
        ];
        return response()->json($response, 201);
    }
    public function verify_store(Request $request, Verify $verify, User $user)
    {
        $requestData = ['token' => 'required'];
        $validate = Validator::make($request->only('token'), $requestData);
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }
        $token = $verify->where('token', '=', $request->token)->first();
        $now = $this->date->format('Y-m-d h:i:s');
        if (!$token) {
            notyf()->addError('Kode Verifikasi tidak valid.');
            return back()->withInput();
        } else if ($token->expires_at <= $now) {
            notyf()->addError('Kode Verifikasi telah kadaluarsa.');
            $token->delete();
            return back();
        }
        $userPerson = $user->where('username', '=', $token->username)->first();
        $userPerson->update(['email_verified_at' => $now]);
        notyf()->addSuccess('Verifikasi berhasil.');
        $token->delete();
        return redirect('/');
    }
    /**
     * Display the specified resource.
     */
    public function show(User $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $users)
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}
