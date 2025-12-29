<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('CheckoutPage');
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'address' => 'required|string',
        ]);

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = 'User';
        $user->phone_number = $validated['phone_number'];
        $user->address = $validated['address'];

        $user->save();
        return back()->with('success', 'User Created');
    }
}
