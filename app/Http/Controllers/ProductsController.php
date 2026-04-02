<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
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
            $validated = $request->validate([
                'title' => 'required|string',
                'price' => 'required|numeric',
                'description' => 'required|string',
                'brand' => 'nullable|string',
                'stock' => 'required|numeric|min:0',
                'category' => 'nullable|string',
                'images' => 'nullable|array',
                'images.*' => 'image|max:2048',
            ]);

            $product = new Product();
            $product->title = $validated['title'];
            $product->price = $validated['price'];
            $product->brand = $validated['brand'] ?? null;
            $product->stock = $validated['stock'];
            $product->description = $validated['description'];
            $product->category = $validated['category'] ?? null;
            $product->image = null;
            $product->save();

            if ($request->hasFile('images')) {
                $productsPath = base_path('../public_html/products');

                if (!File::exists($productsPath)) {
                    File::makeDirectory($productsPath, 0755, true, true);
                }

                foreach ($request->file('images') as $index => $image) {
                    if (!$image->isValid()) {
                        continue;
                    }

                    $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move($productsPath, $filename);

                    $path = 'products/' . $filename;

                    $productImage = new ProductImage([
                        'path' => $path,
                        'is_primary' => $index === 0,
                    ]);

                    $product->images()->save($productImage);

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
            $product = Product::with('images')->findOrFail($id);

            $validated = $request->validate([
                'title' => 'required|string',
                'price' => 'required|numeric',
                'description' => 'required|string',
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

            $deleteIds = $request->input('delete_image_ids', []);
            if (!empty($deleteIds)) {
                $imagesToDelete = $product->images()->whereIn('id', $deleteIds)->get();

                foreach ($imagesToDelete as $img) {
                    $fullPath = public_path($img->path);

                    if (File::exists($fullPath)) {
                        File::delete($fullPath);
                    }

                    $img->delete();
                }
            }

            if ($request->hasFile('images')) {
                $productsPath = base_path('../public_html/products');

                if (!File::exists($productsPath)) {
                    File::makeDirectory($productsPath, 0755, true, true);
                }

                $hasAnyImagesAlready = $product->images()->count() > 0;

                foreach ($request->file('images') as $index => $file) {
                    if (!$file->isValid()) {
                        continue;
                    }

                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move($productsPath, $filename);

                    $path = 'products/' . $filename;

                    $isPrimary = !$hasAnyImagesAlready && $index === 0;

                    $product->images()->create([
                        'path' => $path,
                        'is_primary' => $isPrimary,
                    ]);

                    if ($isPrimary) {
                        $product->image = $path;
                    }
                }
            }

            $product->load('images');

            if ($product->images->count() === 0 && !empty($product->image)) {
                $product->images()->create([
                    'path' => $product->image,
                    'is_primary' => true,
                ]);

                $product->load('images');
            }

            $primary = $product->images->firstWhere('is_primary', true);

            if ($primary) {
                $product->image = $primary->path;
            } else {
                $firstImage = $product->images->first();

                if ($firstImage) {
                    ProductImage::where('product_id', $product->id)->update(['is_primary' => false]);
                    $firstImage->update(['is_primary' => true]);
                    $product->image = $firstImage->path;
                } else {
                    $product->image = null;
                }
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
            $product = Product::with('images')->findOrFail($id);

            foreach ($product->images as $image) {
                $imagePath = public_path($image->path);

                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            if ($product->image) {
                $legacyPath = public_path($product->image);

                if (File::exists($legacyPath)) {
                    File::delete($legacyPath);
                }
            }

            $product->images()->delete();
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
