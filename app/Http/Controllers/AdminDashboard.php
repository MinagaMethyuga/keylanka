<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminDashboard extends Controller
{
    public function index()
    {
        $ProductCount = Product::all()->count();

        return view('dashboard', compact('ProductCount'));
    }

    public function ManageKeyIndex(){
        $items = Product::all();

        return view('AdminManageProducts', compact('items'));
    }
}
