<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class Other extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('category', 'other'); // Adjust category name as needed

        $this->applySorting($query, $request->get('sort', 'featured'));

        $items = $query->paginate(12);

        $brandname = 'Other Products';
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
                $query->orderBy('created_at', 'desc');
                break;
            case 'featured':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }
    }
}
