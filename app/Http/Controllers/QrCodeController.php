<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function show()
    {
        $data =  QrCode::size(200)
            ->format('png')
            ->merge('/public/img/icons/icon-48x48.png')
            ->errorCorrection('M')
            ->margin(1)->generate(
                'Hello, World!',
            );

        return response($data)
            ->header('Content-type', 'image/png');
    }

    public function download()
    {
        return response()->streamDownload(
            function () {
                echo QrCode::size(200)
                    ->format('png')
                    ->generate('https://google.com');
            },
            'qr-code.png',
            [
                'Content-Type' => 'image/png',
            ]
        );
    }
}
