<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class QRCode extends Model
{
    use HasFactory;
    protected $fillable = ['url', 'qr', 'code', 'user_id'];

    public static function createQr($text, $user_id)
    {
        $writer = new Writer(
            new ImageRenderer(
                new RendererStyle(300),
                new SvgImageBackEnd()
            ),
        );
        $date = Carbon::now('Asia/Jakarta');
        $year = $date->year;
        $randomName =  $year . '_' . Str::random(4);
        $qrCode = $writer->writeString($text);
        Storage::disk('public')->put($randomName . '.svg', $qrCode);
        $data = [
            'url' => $text,
            'qr' => $randomName . '.svg',
            'code' => $randomName,
            'user_id' => $user_id
        ];
        QRCode::create($data);
        return $data;
    }
}
