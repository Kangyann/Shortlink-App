<?php

namespace App\Http\Controllers\Api;

use App\Models\Shortlink;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShortlinkAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $shortlink;
    public function __construct(Shortlink $short)
    {
        $this->shortlink = $short;
    }
    public function index(Request $request)
    {
        $validator = Validator::make($request->only('url'), [
            'url' => ['required', 'url']
        ]);
        if (!$request->url || !$request->api_key) {
            return response()->json(['message' => 'Parameter url & api_key dibutuhkan.'], 400);
        }

        $user = User::where('api_key', '=', $request->api_key)->first();
        if (!$user) {
            return response()->json(['message' => 'Parameter api_key tidak valid.'], 400);
        }
        $ipCurrent = explode(',', $user->whitelist_ip);
        if (!in_array($request->ip(), $ipCurrent, false) && $user->whitelist_ip != 1) {
            return response()->json(['message' => 'IP Tidak Diizinkan.'], 401);
        }
        if ($user->limit == 0) {
            return response()->json(['message' => 'Maaf Limit anda habis.', 'user_limit' => $user->limit], 400);
        }
        $data = $this->shortlink->createShortlink($request->url);
        $user->update(['limit' => $user->limit - 1]);
        $response = [
            "message" => "Berhasil.",
            "data" => [
                "base_url" => $data['from_link'],
                "short_url" => $data['to_link'],
                "code" => $data['code']
            ],
            "user_limit" => $user->limit
        ];
        return response()->json($response);
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
        $validator = Validator::make($request->all(), [
            'url' => ['required', 'url']
        ]);
        if (!$request->url) {
            return response()->json([
                'message' => 'Gagal. Parameter url harus ada.'
            ]);
        } else if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('url')) {
                return response()->json(['message' => 'Gagal. URL tidak valid.',], 400);
            }
        }
        $data = $this->shortlink->createShortlink($request->url);
        $response = [
            "message" => "Berhasil",
            "data" => [
                "base_url" => $data['from_link'],
                "short_url" => $data['to_link'],
                "code" => $data['code']
            ],
        ];
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(Shortlink $shortlink)
    {
        //
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
    public function update(Request $request, Shortlink $shortlink)
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
}
