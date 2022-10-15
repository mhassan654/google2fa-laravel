<?php

namespace App\Http\Controllers;

use Google2FA as Google;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FAQRCode\Google2FA;

class Google2faController extends Controller
{
    public function generateCode()
    {
        $google2fa = new Google2FA();
        // $google2fa = app('pragmarx.google2fa');

        return $google2fa->generateSecretKey(64);
        // return Google2FA::generateSecretKey();
    }

    public function sendCode()
    {
        $data['companyName'] = 'Muwonge Hassan';
        $data['companyEmail'] = 'hassansaava@gmail.com';
        $data['secretKey'] = $this->generateCode();

        $google2fa = new Google2FA();

        $inlineUrl = $google2fa->getQRCodeInline(
            $data['companyName'],
            $data['companyEmail'],
            $data['secretKey']
        );
        $qrcode = Google::setQRCodeBackend('svg');
        // dd($inlineUrl);
        // $google2fa = new Google2FA();
        return view('google2fa.index', compact('inlineUrl', 'qrcode'), $data);
    }

    public function post(Request $request)
    {
        $google2fa = new Google2FA();
        $registration_data = $request->all();

        $registration_data["google2fa_secret"] = $this->generateCode();

        // Save the registration data to the user session for just the next request
        $request->session()->flash('registration_data', $registration_data);
        
        $secret = $request->input('secretKey');
        $user = request()->user();

        dd(app('pragmarx.google2fa'));

        $valid = $google2fa->verifyKey($user->google2fa_secret, $secret);
        dd($valid);
        // https://www.sitepoint.com/2fa-in-laravel-with-google-authenticator-get-secure/
        // https://laracasts.com/discuss/channels/laravel/in-laravel-google-authenticator-how-to-setup
    }
}
