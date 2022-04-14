<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google2FA as Google;
use PragmaRX\Google2FAQRCode\Google2FA;

class Google2faController extends Controller
{
    public function generateCode(){
        $google2fa = new Google2FA();
        // $google2fa = app('pragmarx.google2fa');

        return $google2fa->generateSecretKey();
        // return Google2FA::generateSecretKey();
    }

    public function sendCode(){
        $companyName = 'Muwonge Hassan';
        $companyEmail = 'hassansaava@gmail.com';
        $secretKey = $this->generateCode();

        $google2fa = new Google2FA();

        $inlineUrl = $google2fa->getQRCodeInline(
            $companyName,
            $companyEmail,
            $secretKey
        );
        $qrcode = Google::setQRCodeBackend('svg');
        // dd($inlineUrl);
        // $google2fa = new Google2FA();
        return view('google2fa.index', compact('inlineUrl','qrcode'));
    }
}
