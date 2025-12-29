<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Fortify\Features;

class TwoFactorAuthenticationController extends Controller
{
    public function show(Request $request)
    {
        if (! Features::enabled(Features::twoFactorAuthentication())) {
            abort(403);
        }

        return view('settings.two-factor', [
            'user' => $request->user(),
        ]);
    }
}
