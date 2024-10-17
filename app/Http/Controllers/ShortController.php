<?php

namespace App\Http\Controllers;

use App\Models\Short;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ShortController extends Controller
{
    public function make(Request $request)
    {
        $url = $request->url;
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            $randomString = randomString();
            $short = Short::create(['long_url' => $url]);
            $short->kalta()->create([
                'url' => $randomString,
                'user_id' => 1,
                'ip' => $request->ip()
            ]);

            $qrCode = QrCode::size(300)->generate(asset($randomString));

            // Return the view with the generated QR code
            return view('kalta.qr', compact('qrCode', 'randomString', 'url'));
        }
    }
}