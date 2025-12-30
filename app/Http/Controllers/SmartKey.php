<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SmartKey extends Controller
{
    private $mainBrands = ['Toyota', 'Honda', 'Suzuki', 'Nissan', 'Mazda', 'Benz', 'Daihatsu'];

    public function index(Request $request)
    {
        $query = Product::where('category', 'smart'); // Adjust category name as needed

        $this->applySorting($query, $request->get('sort', 'featured'));

        $items = $query->paginate(12);

        $brandname = 'Smart Keys';
        return view('ProductsShowCase', compact('items', 'brandname'));
    }

    public function showByBrand(Request $request, $brand)
    {
        $displayBrand = ucfirst($brand);

        if (strtolower($brand) === 'others') {
            $query = Product::where('category', 'smart') // Adjust category name
            ->whereNotIn('brand', $this->mainBrands);

            $brandname = "Smart Keys (Others)";
        } else {
            $query = Product::where('category', 'smart-keys') // Adjust category name
            ->where('brand', $displayBrand);

            $brandname = "Smart Keys ({$displayBrand})";
        }

        $this->applySorting($query, $request->get('sort', 'featured'));

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
                $query->orderBy('created_at', 'desc');
                break;
            case 'featured':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }
    }
}
