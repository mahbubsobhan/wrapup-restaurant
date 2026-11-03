<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->get();

        return view('admin.products.index', compact('products'));
    }


    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        // Get ALL categories
        $categories = Category::orderBy('name')->get();

        return view(
            'admin.products.create',
            compact('categories')
        );
    }


    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
                'unique:products,name',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'discount_price' => [
                'nullable',
                'numeric',
                'min:0',
                'lt:price',
            ],

            'main_image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:2048',
            ],

        ]);


        // Generate slug
        $validated['slug'] = Str::slug($validated['name']);


        // Upload product image
        if ($request->hasFile('main_image')) {

            $validated['main_image'] = $request
                ->file('main_image')
                ->store('products', 'public');
        }


        // Product status
        $validated['is_available'] = $request->boolean('is_available');

        $validated['is_featured'] = $request->boolean('is_featured');

        $validated['is_best_seller'] = $request->boolean('is_best_seller');


        // Create product
        Product::create($validated);


        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }


    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        $product->load('category');

        return view(
            'admin.products.show',
            compact('product')
        );
    }


    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        // Get ALL categories
        $categories = Category::orderBy('name')->get();

        return view(
            'admin.products.edit',
            compact('product', 'categories')
        );
    }


    /**
     * Update the specified product.
     */
    public function update(
        Request $request,
        Product $product
    ) {
        $validated = $request->validate([

            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
                'unique:products,name,' . $product->id,
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'discount_price' => [
                'nullable',
                'numeric',
                'min:0',
                'lt:price',
            ],

            'main_image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:2048',
            ],

        ]);


        // Generate slug
        $validated['slug'] = Str::slug($validated['name']);


        // Upload new product image
        if ($request->hasFile('main_image')) {

            // Delete old image
            if (
                $product->main_image &&
                Storage::disk('public')->exists(
                    $product->main_image
                )
            ) {
                Storage::disk('public')
                    ->delete($product->main_image);
            }


            // Store new image
            $validated['main_image'] = $request
                ->file('main_image')
                ->store('products', 'public');
        }


        // Product status
        $validated['is_available'] = $request->boolean(
            'is_available'
        );

        $validated['is_featured'] = $request->boolean(
            'is_featured'
        );

        $validated['is_best_seller'] = $request->boolean(
            'is_best_seller'
        );


        // Update product
        $product->update($validated);


        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }


    /**
     * Remove the specified product.
     */
    public function destroy(Product $product)
    {
        // Delete product image
        if (
            $product->main_image &&
            Storage::disk('public')->exists(
                $product->main_image
            )
        ) {
            Storage::disk('public')
                ->delete($product->main_image);
        }


        // Delete product
        $product->delete();


        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}