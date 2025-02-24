<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // Retrieve 10 pizzas from the products table
        // You can also use pagination if you prefer: Product::paginate(10)
        $pizzas = Product::take(10)->get();

        // Pass the pizzas to the 'products.index' view
        return view('products.index', compact('pizzas'));
    }
}