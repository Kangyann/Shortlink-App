<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.profile.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        if ($request->has('changeperson')) {
            $profile = [
                'Name' => 'min:8',
                'Username' => 'min:8',
            ];
            $validate = Validator::make($request->only(['Name', 'Username', 'White_List_IP']), $profile);
            if ($validate->fails()) {
                return back()->withErrors($validate);
            }
            if (Hash::check($request->Password, $user->password)) {
                $user->update([
                    'name' => $request->Name,
                    'username' => $request->Username,
                    'whitelist_ip' => $request->White_List_IP
                ]);
                notyf()->addSuccess('Profile berhasil diperbaharui.');
                return back();
            }
            notyf()->addError('Password salah. Coba kembali');
            return back();
        } else if ($request->has('changepassword')) {
            $changepassword = [
                'New_Password' => 'min:8',
                'New_Password_Confirmation' => 'min:8|same:New_Password'
            ];
            $validate = Validator::make($request->only('New_Password', 'New_Password_Confirmation'), $changepassword);
            if ($validate->fails()) {
                notyf()->addError('Periksa kembali data yang akan dikirimkan.');
                return back()->withErrors($validate);
            }
            if (Hash::check($request->Old_Password, $user->password)) {
                $password = bcrypt($request->New_Password);
                $user->update([
                    'password' => $password
                ]);
                notyf()->addSuccess('Password berhasil diperbaharui.');
                return back();
            }
            notyf()->addError('Password salah. Coba kembali');
            return back();
        } 
        $newKey = Str::random(32);
        $user->update(['api_key' => $newKey ]);
        notyf()->addSuccess('Api Key berhasil diperbaharui.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
