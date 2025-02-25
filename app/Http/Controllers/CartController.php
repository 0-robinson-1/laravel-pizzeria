<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Show the cart items.
     */
    public function index(Request $request)
    {
        // Retrieve cart from session, or set to empty array if none
        $cart = $request->session()->get('cart', []);

        return view('cart.index', compact('cart'));
    }

    /**
     * Add an item to the cart.
     */
    public function add(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'product_id' => 'required|integer|exists:products,product_id',
            'quantity'   => 'required|integer|min:1',
        ]);

        // Retrieve cart from session
        $cart = $request->session()->get('cart', []);

        // Find the product
        $product = Product::findOrFail($request->product_id);

        // If the product is already in the cart, increment quantity. Otherwise add it.
        if (isset($cart[$product->product_id])) {
            $cart[$product->product_id]['quantity'] += $request->quantity;
        } else {
            $cart[$product->product_id] = [
                'id'        => $product->product_id,
                'name'      => $product->product_name,
                'price'     => $product->price,
                'quantity'  => $request->quantity,
            ];
        }

        // Store updated cart back into session
        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    /**
     * Remove an item from the cart.
     */
    public function remove(Request $request)
    {
        // Validate product_id
        $request->validate([
            'product_id' => 'required|integer|exists:products,product_id',
        ]);

        $cart = $request->session()->get('cart', []);

        if (isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
        }

        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }

    /**
     * Clear the entire cart.
     */
    public function clear(Request $request)
    {
        $request->session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Cart cleared!');
    }
}