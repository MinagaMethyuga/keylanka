<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
    /**
     * Public product detail page (used by all products).
     */
    public function show($id)
    {
        $product = Product::with('images')->findOrFail($id);
        $categoryRoute = $this->categoryRoute($product->category);
        $categoryName = $this->categoryName($product->category);
        return view('ProductShow', compact('product', 'categoryRoute', 'categoryName'));
    }

    private function categoryRoute(?string $category): string
    {
        return match ($category) {
            'locksmith-tools' => route('products.index'),
            'flip-key' => route('FlipKey.index'),
            'key-shell' => route('KeyShells.index'),
            'remote' => route('Remote.index'),
            'smart' => route('Smart.index'),
            'key-cover' => route('KeyCover.index'),
            'other-list', 'other' => route('Other.index'),
            default => route('Other.index'),
        };
    }

    private function categoryName(?string $category): string
    {
        return match ($category) {
            'locksmith-tools' => 'Locksmith Tools',
            'flip-key' => 'Flip Keys',
            'key-shell' => 'Key Shells',
            'remote' => 'Remote Keys',
            'smart' => 'Smart Keys',
            'key-cover' => 'Key Covers',
            'other-list', 'other' => 'Others',
            default => 'Products',
        };
    }

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
                'images' => 'nullable|array',
                'images.*' => 'image|max:2048',
            ]);

            // Create product
            $product = new Product();
            $product->title = $validated['title'];
            $product->price = $validated['price'];
            $product->brand = $validated['brand'] ?? null;
            $product->stock = $validated['stock'];
            $product->description = $validated['description'];
            $product->category = $validated['category'] ?? null;
            $product->save();

            // Handle multiple image uploads
            if ($request->hasFile('images')) {
                $images = $request->file('images');

                // Create products directory if it doesn't exist
                $productsPath = public_path('products');
                if (!File::exists($productsPath)) {
                    File::makeDirectory($productsPath, 0755, true);
                }

                foreach ($images as $index => $image) {
                    $filename = time() . '_' . $image->getClientOriginalName();
                    $image->move($productsPath, $filename);
                    $path = 'products/' . $filename;

                    $productImage = new ProductImage([
                        'path' => $path,
                        'is_primary' => $index === 0,
                    ]);

                    $product->images()->save($productImage);

                    // Also keep the first image as the legacy single image field
                    if ($index === 0) {
                        $product->image = $path;
                    }
                }

                $product->save();
            }

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
            $product = Product::findOrFail($id);

            $validated = $request->validate([
                'title' => 'required',
                'price' => 'required|numeric',
                'description' => 'required',
                'brand' => 'nullable|string',
                'stock' => 'required|numeric|min:0',
                'category' => 'nullable|string',
                'images' => 'nullable|array',
                'images.*' => 'image|max:2048',
                'delete_image_ids' => 'nullable|array',
                'delete_image_ids.*' => 'integer|exists:product_images,id',
            ]);

            $product->title = $validated['title'];
            $product->price = $validated['price'];
            $product->brand = $validated['brand'] ?? null;
            $product->stock = $validated['stock'];
            $product->description = $validated['description'];
            $product->category = $validated['category'] ?? null;

            // Remove images that were marked for deletion
            $deleteIds = $request->input('delete_image_ids', []);
            if (!empty($deleteIds)) {
                $toDelete = $product->images()->whereIn('id', $deleteIds)->get();
                foreach ($toDelete as $img) {
                    $path = public_path($img->path);
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $img->delete();
                }
            }

            // Add new images
            if ($request->hasFile('images')) {
                $productsPath = public_path('products');
                if (!File::exists($productsPath)) {
                    File::makeDirectory($productsPath, 0755, true);
                }
                $isFirst = $product->images()->count() === 0;
                foreach ($request->file('images') as $index => $file) {
                    $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                    $file->move($productsPath, $filename);
                    $path = 'products/' . $filename;
                    $product->images()->create([
                        'path' => $path,
                        'is_primary' => $isFirst && $index === 0,
                    ]);
                    if ($isFirst && $index === 0) {
                        $product->image = $path;
                    }
                    $isFirst = false;
                }
            }

            // Ensure we have a primary image and product.image set
            $primary = $product->images()->where('is_primary', true)->first();
            if (!$primary) {
                $first = $product->images()->first();
                if ($first) {
                    $first->update(['is_primary' => true]);
                    $product->image = $first->path;
                } else {
                    $product->image = null;
                }
            } else {
                $product->image = $primary->path;
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

            // Delete all associated images from disk
            foreach ($product->images as $image) {
                $imagePath = public_path($image->path);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            // Also delete legacy single image if set and not already covered
            if ($product->image) {
                $legacyPath = public_path($product->image);
                if (File::exists($legacyPath)) {
                    File::delete($legacyPath);
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
            $product = Product::with('images')->findOrFail($id);
            return response()->json($product);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }
}
