<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display cart page.
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        $subtotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return view(
            'frontend.pages.cart',
            compact('cart', 'subtotal')
        );
    }


    /**
     * Add product to cart.
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => [
                'required',
                'exists:products,id',
            ],

            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);


        $product = Product::findOrFail(
            $request->product_id
        );


        // Check availability

        if (!$product->is_available) {

            return response()->json([
                'success' => false,
                'message' => 'This product is currently unavailable.',
            ], 422);

        }


        // Get cart

        $cart = session()->get('cart', []);


        // Get selling price

        $price = $product->discount_price
            ?? $product->price;


        // If product already exists

        if (isset($cart[$product->id])) {

            $cart[$product->id]['quantity']
                += $request->quantity;

        } else {

            // Add new product

            $cart[$product->id] = [

                'id' => $product->id,

                'name' => $product->name,

                'price' => $price,

                'image' => $product->main_image,

                'quantity' => $request->quantity,

            ];

        }


        // Save cart

        session()->put(
            'cart',
            $cart
        );


        // Calculate cart count

        $cartCount = collect($cart)
            ->sum('quantity');


        // Calculate subtotal

        $subtotal = collect($cart)
            ->sum(function ($item) {

                return $item['price']
                    * $item['quantity'];

            });


        return response()->json([

            'success' => true,

            'message' => 'Product added to cart successfully.',

            'cartCount' => $cartCount,

            'subtotal' => $subtotal,

        ]);
    }


    /**
     * Update cart quantity.
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],

        ]);


        $cart = session()->get(
            'cart',
            []
        );


        if (!isset($cart[$id])) {

            return response()->json([

                'success' => false,

                'message' => 'Product not found in cart.',

            ], 404);

        }


        // Update quantity

        $cart[$id]['quantity']
            = $request->quantity;


        // Save cart

        session()->put(
            'cart',
            $cart
        );


        // Item total

        $itemTotal =
            $cart[$id]['price']
            * $cart[$id]['quantity'];


        // Cart count

        $cartCount = collect($cart)
            ->sum('quantity');


        // Subtotal

        $subtotal = collect($cart)
            ->sum(function ($item) {

                return $item['price']
                    * $item['quantity'];

            });


        return response()->json([

            'success' => true,

            'quantity' => $cart[$id]['quantity'],

            'itemTotal' => $itemTotal,

            'cartCount' => $cartCount,

            'subtotal' => $subtotal,

        ]);
    }


    /**
     * Remove product from cart.
     */
    public function remove($id)
    {
        $cart = session()->get(
            'cart',
            []
        );


        if (isset($cart[$id])) {

            unset($cart[$id]);

        }


        session()->put(
            'cart',
            $cart
        );


        $cartCount = collect($cart)
            ->sum('quantity');


        $subtotal = collect($cart)
            ->sum(function ($item) {

                return $item['price']
                    * $item['quantity'];

            });


        return response()->json([

            'success' => true,

            'cartCount' => $cartCount,

            'subtotal' => $subtotal,

        ]);
    }


    /**
     * Clear entire cart.
     */
    public function clear()
    {
        session()->forget('cart');


        return response()->json([

            'success' => true,

            'cartCount' => 0,

            'subtotal' => 0,

        ]);
    }
}