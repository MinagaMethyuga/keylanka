<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class RemoteKeys extends Controller
{
    // Define the main brands shown in navbar
    private $mainBrands = ['Toyota', 'Honda', 'Suzuki', 'Nissan', 'Mazda', 'Benz', 'Daihatsu'];

    public function index(Request $request)
    {
        $query = Product::where('category', 'remote');

        // Apply sorting
        $this->applySorting($query, $request->get('sort', 'featured'));

        // Use paginate instead of get
        $items = $query->paginate(12);

        $brandname = 'Remote Keys';
        return view('ProductsShowCase', compact('items', 'brandname'));
    }

    public function showByBrand(Request $request, $brand)
    {
        // Capitalize first letter for display
        $displayBrand = ucfirst($brand);

        // Check if this is the "Others" category
        if (strtolower($brand) === 'others') {
            // Get all products NOT in the main brands list
            $query = Product::where('category', 'remote')
                ->whereNotIn('brand', $this->mainBrands);

            $brandname = "Remote Keys (Others)";
        } else {
            // Get products filtered by specific brand
            $query = Product::where('category', 'remote')
                ->where('brand', $displayBrand);

            $brandname = "Remote Keys ({$displayBrand})";
        }

        // Apply sorting
        $this->applySorting($query, $request->get('sort', 'featured'));

        // Use paginate instead of get
        $items = $query->paginate(12);

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
