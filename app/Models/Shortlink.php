<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Shortlink extends Model
{
    use HasFactory;

    protected $fillable = ['from_link', 'to_link', 'code', 'qr', 'user_id', 'expires_at'];
    private static $source = [
        [
            'image' => 'shield.png',
            'title' => 'Shield',
            'desc' => 'Fast and secure. URL shortener with data encryption and secure protocol'
        ],        [
            'image' => 'link.png',
            'title' => 'Short Link',
            'desc' => 'Make your address simpler and faster for many people to access'
        ],        [
            'image' => 'search.png',
            'title' => 'Search',
            'desc' => 'Makes it easier for users to search, with short URLs'
        ],        [
            'image' => 'dimensions.png',
            'title' => 'Device',
            'desc' => 'Responsive and dynamic display, supports multiple devices'
        ],
        [
            'image' => 'server.png',
            'title' => 'Storage',
            'desc' => 'There is no maximum limit for its use, and have many services'
        ],
        [
            'image' => 'flag.png',
            'title' => 'Features',
            'desc' => 'Save your progress and enjoy some of the features it has'
        ],

    ];

    public static function assets()
    {
        return static::$source;
    }

    public static function getMethod($request, $err)
    {
    }
    public static function postMethod($request)
    {
    }
    public static function createShortlink($url)
    {
        $randomStr = Str::random(4);
        $data = [
            "from_link" => $url,
            'to_link' => env('APP_URL') . $randomStr,
            'code' => $randomStr,
            'user_id' => 1
        ];
        Shortlink::create($data);
        return $data;
    }
}
