<?php

namespace App\Http\Controllers;

use App\Models\Shortlink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ShortlinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Shortlink $shortlink)
    {
        $source = $shortlink->assets();
        return view('home', compact('source'));
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
    public function store(Request $req, Shortlink $shortlink)
    {
        $randomStr = Str::random(3);
        $userId = 1;
        $toUrl = config('app.url') . $randomStr;
        $valid = Validator::make($req->all(), [
            'url' => 'url'
        ]);
        if ($valid->fails()) {
            notyf()->addError('Data yang dimasukan harus berisi URL.');
            return back()->withErrors($valid)->withInput();
        }
        if ($req->submit != 'guest') {
            $userId = Auth::user()->id;
        }
        $data = [
            "from_link" => $req->url,
            "to_link" => $toUrl,
            "code" => $randomStr,
            "user_id" => $userId,
        ];
        $shortlink->create($data);
        $req->session()->put('data', $toUrl);
        notyf()->addSuccess('Shorten URL berhasil.');
        return back();
    }
    /**
     * Display the specified resource.
     */
    public function show(Request $req, Shortlink $shortlink, $code)
    {
        $firstData = $shortlink->where('code', $code)->first();
        if ($firstData) {
            $userVisit = 'user_' . $req->ip() . '_' . $firstData->code;
            if (!Cache::has($userVisit)) {
                Cache::put($userVisit, true, now()->addSeconds(15));
                $firstData->update(['visitor' => $firstData->visitor + 1]);
            }
            return redirect($firstData->from_link);
        }
        return abort(403, 'URL TIDAK VALID');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shortlink $shortlink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Shortlink $shortlink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shortlink $shortlink)
    {
        //
    }

    public function privacy()
    {
        return view('privacy');
    }
    public function terms()
    {
        return view('terms');
    }
    public function contact()
    {
        return view('contact');
    }
}
