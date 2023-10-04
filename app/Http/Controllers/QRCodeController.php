<?php

namespace App\Http\Controllers;

use App\Models\QRCode;
use App\Http\Requests\StoreQRCodeRequest;
use App\Http\Requests\UpdateQRCodeRequest;

class QRCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreQRCodeRequest $request)
    {
        //
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
    public function update(UpdateQRCodeRequest $request, QRCode $qRCode)
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
