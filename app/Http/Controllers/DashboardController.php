<?php

namespace App\Http\Controllers;

use App\Charts\DashboardChart;
use App\Models\QRCode;
use App\Models\Shortlink;
use App\Models\User;
use Illuminate\Http\Request;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $data;
    private $user;
    private $qr;
    public function __construct(Shortlink $shortlink, User $users, QRCode $qr)
    {
        $this->data = $shortlink;
        $this->user = $users;
        $this->qr = $qr;
    }
    public function index(DashboardChart $chart)
    {
        $get = $this->data->all()->where('user_id', Auth::user()->id);
        $data = $this->data->where('user_id', Auth::user()->id)->paginate(5);
        $active = $get->where('status', 1)->count();
        $totalVisitor = 0;
        foreach ($get as $visitor) {
            $totalVisitor += $visitor->visitor;
        }
        return view('dashboard.index', compact('active', 'data', 'totalVisitor'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function qr()
    {
        $data = $this->data->where('user_id', '=', Auth::user()->id)->paginate(5);
        $qr = $this->qr->where('user_id', '=', Auth::user()->id)->paginate(5);
        return view('dashboard.qr', compact('data', 'qr'));
    }
    public function createQR(Request $request, QRCode $qRCode)
    {
        if (request()->p) {
            $data = ['url' => 'required|url|unique:q_r_codes'];
            $validate = Validator::make(request()->only('url'), $data);
            if ($validate->fails()) {
                notyf()->addError('Periksa kembali data yang akan dikirim.');
                return back()->withErrors($validate);
            }
            $qRCode->createQr($request->url, Auth()->user()->id);
            notyf()->addSuccess('QR Code berhasil dibuat.');
            return back();
        }
        $writer = new Writer(
            new ImageRenderer(
                new RendererStyle(300),
                new SvgImageBackEnd()
            ),
        );
        $finds = $this->data->findOrFail(request()->id);
        $qrCode = $writer->writeString($finds->to_link);
        $filename = $finds->code . '.svg';
        Storage::disk('public')->put($filename, $qrCode);
        $finds->update([
            'qr' => $filename
        ]);
        notyf()->addSuccess('QR Code berhasil dibuat.');
        return back();
    }
    public function api()
    {
        return view('api');
    }
    public function custom()
    {
        return view('dashboard.custom');
    }
    public function createCustom()
    {
        $req = [
            'code' => 'required|max:24|unique:shortlinks,code',
            'url' => 'required|url',
        ];
        $validate = Validator::make(request()->only('code', 'url'), $req);
        if ($validate->fails()) {
            notyf()->addError('Periksa kembali data yang akan dikirim.');
            return redirect()->route('dashboard@custom')->withErrors($validate)->withInput();
        }
        $data = [
            'to_link' => env('APP_URL') . request()->code,
            'from_link' => request()->url,
            'code' => request()->code,
            'user_id' => Auth::user()->id,
        ];
        $find = $this->user->findOrFail(Auth::user()->id);
        $find->update(['limit' => $find->limit - 1]);
        if (request()->expires_at) {
            $expires = ['expires_at' => request()->expires_at];
            $data = array_merge($data, $expires);
        };
        $this->data->create($data);
        notyf()->addSuccess('Custom Link berhasil dibuat.');
        return back();
    }

    public function profile()
    {
        return view('dashboard.profile.index');
    }
}
