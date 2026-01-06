<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'title' => 'required',
                'price' => 'required|numeric',
                'description' => 'required',
                'brand' => 'nullable|string',
                'stock' => 'required|numeric|min:0',
                'category' => 'nullable|string',
                'image' => 'nullable|image|max:2048',
            ]);

            // Create product
            $product = new Product();
            $product->title = $validated['title'];
            $product->price = $validated['price'];
            $product->brand = $validated['brand'] ?? null;
            $product->stock = $validated['stock'];
            $product->description = $validated['description'];
            $product->category = $validated['category'] ?? null;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '_' . $image->getClientOriginalName();

                // Create products directory if it doesn't exist
                $productsPath = public_path('products');
                if (!File::exists($productsPath)) {
                    File::makeDirectory($productsPath, 0755, true);
                }

                // Move image to public/products
                $image->move($productsPath, $filename);

                // Save path as: products/filename.jpg
                $product->image = 'products/' . $filename;
            }

            $product->save();

            return redirect()->back()->with('success', 'Product added successfully!');

        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to add product: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Find the product
            $product = Product::findOrFail($id);

            // Validate input
            $validated = $request->validate([
                'title' => 'required',
                'price' => 'required|numeric',
                'description' => 'required',
                'brand' => 'nullable|string',
                'stock' => 'required|numeric|min:0',
                'category' => 'nullable|string',
                'image' => 'nullable|image|max:2048',
            ]);

            // Update product fields
            $product->title = $validated['title'];
            $product->price = $validated['price'];
            $product->brand = $validated['brand'] ?? null;
            $product->stock = $validated['stock'];
            $product->description = $validated['description'];
            $product->category = $validated['category'] ?? null;

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($product->image) {
                    $oldImagePath = public_path($product->image);
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    }
                }

                $image = $request->file('image');
                $filename = time() . '_' . $image->getClientOriginalName();

                // Create products directory if it doesn't exist
                $productsPath = public_path('products');
                if (!File::exists($productsPath)) {
                    File::makeDirectory($productsPath, 0755, true);
                }

                // Move image to public/products
                $image->move($productsPath, $filename);

                // Save path as: products/filename.jpg
                $product->image = 'products/' . $filename;
            }

            $product->save();

            return redirect()->back()->with('success', 'Product updated successfully!');

        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update product: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);

            // Delete image if exists
            if ($product->image) {
                // Check in public_html first
                $imagePath = base_path('../public_html/' . $product->image);
                if (!File::exists($imagePath)) {
                    // Fallback to standard public path
                    $imagePath = public_path($product->image);
                }

                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            $product->delete();

            return redirect()->back()->with('success', 'Product deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete product: ' . $e->getMessage());
        }
    }

    public function getProduct($id)
    {
        try {
            $product = Product::findOrFail($id);
            return response()->json($product);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }
}
