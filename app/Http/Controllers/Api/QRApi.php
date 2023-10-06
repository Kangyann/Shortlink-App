<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QRCode;
use App\Models\User;
use Illuminate\Http\Request;

class QRApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $qr;
    public function __construct(QRCode $qRCode)
    {
        $this->qr = $qRCode;
    }
    public function index(Request $request)
    {
        if (!$request->text || !$request->api_key) {
            return response()->json(['message' => 'Parameter text & api_key dibutuhkan.',], 400);
        }
        $user = User::where('api_key', $request->api_key)->first();
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
        $data = $this->qr->createQr($request->text, 1);
        $user->update(['limit' => $user->limit - 1]);
        $response = [
            'message' => 'Berhasil',
            'data' => [
                'url' => $data['url'],
                'qr' => env('APP_URL') . 'storage/' . $data['qr'],
                'code' => $data['code']
            ],
            'user_limit' => $user->limit
        ];
        return response()->json($response, 201);
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
        if (!$request->text) {
            return response()->json([
                'message' => 'Parameter text tidak valid.',
            ], 400);
        };
        $data = $this->qr->createQr($request->text, 1);
        $response = [
            'message' => 'Berhasil',
            'data' => [
                'url' => $data['url'],
                'qr' => env('APP_URL') . 'storage/' . $data['qr'],
                'code' => $data['code']
            ],
        ];
        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(QRCode $qRCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QRCode $qRCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QRCode $qRCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QRCode $qRCode)
    {
        //
    }
}
