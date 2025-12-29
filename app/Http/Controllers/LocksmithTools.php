<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class LocksmithTools extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('category', 'locksmith-tools');

        // Apply sorting
        $this->applySorting($query, $request->get('sort', 'featured'));

        // Use paginate instead of get
        $items = $query->paginate(12);

        $brandname = 'Locksmith Tools';
        return view('ProductsShowCase', compact('items', 'brandname'));
    }

    public function KeyDIYIndex(Request $request)
    {
        $query = Product::where('category', 'locksmith-tools')
            ->where('brand', 'KeyDiy');

        // Apply sorting
        $this->applySorting($query, $request->get('sort', 'featured'));

        // Use paginate instead of get
        $items = $query->paginate(12);

        $brandname = 'Locksmith Tools (KeyDiy)';
        return view('ProductsShowCase', compact('items', 'brandname'));
    }

    public function xHorseIndex(Request $request)
    {
        $query = Product::where('category', 'locksmith-tools')
            ->where('brand', 'xHorse');

        // Apply sorting
        $this->applySorting($query, $request->get('sort', 'featured'));

        // Use paginate instead of get
        $items = $query->paginate(12);

        $brandname = 'Locksmith Tools (Xhorse)';
        return view('ProductsShowCase', compact('items', 'brandname'));
    }

    public function OtherIndex(Request $request)
    {
        $query = Product::where('category', 'locksmith-tools')
            ->where('brand', 'Other');

        // Apply sorting
        $this->applySorting($query, $request->get('sort', 'featured'));

        // Use paginate instead of get
        $items = $query->paginate(12);

        $brandname = 'Locksmith Tools (Other)';
        return view('ProductsShowCase', compact('items', 'brandname'));
    }

    private function applySorting($query, $sort)
    {
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'rating':
                // If you have a rating column, use it here
                // $query->orderBy('rating', 'desc');
                // Otherwise fall back to created_at
                $query->orderBy('created_at', 'desc');
                break;
            case 'featured':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }
    }
}
