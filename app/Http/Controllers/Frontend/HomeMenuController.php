<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class HomeMenuController extends Controller

{
    public function index()
    {
$categories = Category::where('is_active', true)
    ->orderBy('created_at', 'asc')
    ->get();

        $products = Product::with('category')
            ->where('is_available', true)
            ->latest()
            ->get();

        return view('frontend.pages.home', compact(
            'categories',
            'products'
        ));
    }
}

