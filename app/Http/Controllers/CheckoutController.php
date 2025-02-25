<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page with cart contents + address/payment form.
     */
    public function showCheckoutForm(Request $request)
    {
        // Retrieve cart from session
        $cart = $request->session()->get('cart', []);

        // If the cart is empty, redirect to cart page
        if (count($cart) === 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Optionally, fetch user's existing address to prefill the form
        $user = Auth::user();

        return view('checkout.index', [
            'cart' => $cart,
            'user' => $user,
        ]);
    }

    /**
     * Finalize the purchase (Create order + order details).
     */
    public function finalizePurchase(Request $request)
    {
        // 1. Validate form data (delivery address, payment, etc.)
        $request->validate([
            'delivery_address'      => 'required|string|max:255',
            'delivery_postal_code'  => 'required|string|max:10',
            'delivery_city'         => 'required|string|max:50',
            'payment_method'        => 'required|string', // e.g. 'cash', 'credit_card', 'paypal'
        ]);

        // 2. Retrieve the cart from the session
        $cart = $request->session()->get('cart', []);
        if (count($cart) === 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // 3. Calculate total price
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // 4. Create a new Order
        //    (Adjust column names to match your `orders` table and user foreign key)
        $order = Order::create([
            'id'                    => Auth::id(), // The user foreign key in your `orders` table
            'order_date'            => Carbon::now(),
            'total_price'           => $totalPrice,
            'delivery_address'      => $request->delivery_address,
            'delivery_postal_code'  => $request->delivery_postal_code,
            'delivery_city'         => $request->delivery_city,
            // Optionally store payment method or a 'status' column
            // 'payment_method' => $request->payment_method,
        ]);

        // 5. Create OrderDetails for each cart item
        foreach ($cart as $item) {
            OrderDetail::create([
                'order_id'   => $order->order_id,   // PK in your `orders` table
                'product_id' => $item['id'],        // product reference from the cart
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],     // price at time of purchase
            ]);
        }

        // 6. Clear the cart from session
        $request->session()->forget('cart');

        // 7. Redirect with a success message (or to a confirmation page if you prefer)
        return redirect()->route('cart.index')
            ->with('success', 'Your order has been placed successfully!');
    }
}