<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-4">
                    Your Order
                </h1>

                <!-- Show cart items in a table just like cart/index.blade.php -->
                @if(count($cart) > 0)
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600 mb-4">
                        <thead>
                            <tr>
                                <th class="py-3 px-6 text-left text-gray-900 dark:text-gray-100">Product</th>
                                <th class="py-3 px-6 text-left text-gray-900 dark:text-gray-100">Quantity</th>
                                <th class="py-3 px-6 text-left text-gray-900 dark:text-gray-100">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalPrice = 0; @endphp
                            @foreach($cart as $item)
                                @php
                                    $itemTotal = $item['price'] * $item['quantity'];
                                    $totalPrice += $itemTotal;
                                @endphp
                                <tr>
                                    <td class="py-4 px-6 text-gray-900 dark:text-gray-100">
                                        {{ $item['name'] }}
                                    </td>
                                    <td class="py-4 px-6 text-gray-900 dark:text-gray-100">
                                        {{ $item['quantity'] }}
                                    </td>
                                    <td class="py-4 px-6 text-gray-900 dark:text-gray-100">
                                        ${{ number_format($itemTotal, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2" class="py-4 px-6 font-bold text-right text-gray-900 dark:text-gray-100">
                                    Total:
                                </td>
                                <td class="py-4 px-6 font-bold text-gray-900 dark:text-gray-100">
                                    ${{ number_format($totalPrice, 2) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-900 dark:text-gray-100">Your cart is empty.</p>
                @endif
            </div>

            <!-- Delivery & Payment Form -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">Delivery Details</h2>
                
                <form action="{{ route('checkout.finalize') }}" method="POST">
                    @csrf
                    
                    <!-- Delivery Address -->
                    <div class="mb-4">
                        <label for="delivery_address" class="block text-gray-900 dark:text-gray-100 mb-1">
                            Address
                        </label>
                        <input 
                            type="text" 
                            name="delivery_address" 
                            id="delivery_address"
                            value="{{ old('delivery_address', $user->street . ' ' . $user->house_nr ?? '') }}"
                            class="w-full p-2 rounded dark:bg-gray-700 dark:text-gray-100"
                            required
                        >
                        @error('delivery_address')
                            <span class="text-red-600 dark:text-red-400">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Postal Code -->
                    <div class="mb-4">
                        <label for="delivery_postal_code" class="block text-gray-900 dark:text-gray-100 mb-1">
                            Postal Code
                        </label>
                        <input 
                            type="text" 
                            name="delivery_postal_code" 
                            id="delivery_postal_code"
                            value="{{ old('delivery_postal_code', $user->postal_code ?? '') }}"
                            class="w-full p-2 rounded dark:bg-gray-700 dark:text-gray-100"
                            required
                        >
                        @error('delivery_postal_code')
                            <span class="text-red-600 dark:text-red-400">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- City -->
                    <div class="mb-4">
                        <label for="delivery_city" class="block text-gray-900 dark:text-gray-100 mb-1">
                            City
                        </label>
                        <input 
                            type="text" 
                            name="delivery_city" 
                            id="delivery_city"
                            value="{{ old('delivery_city', $user->city ?? '') }}"
                            class="w-full p-2 rounded dark:bg-gray-700 dark:text-gray-100"
                            required
                        >
                        @error('delivery_city')
                            <span class="text-red-600 dark:text-red-400">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Payment Method -->
                    <div class="mb-4">
                        <label for="payment_method" class="block text-gray-900 dark:text-gray-100 mb-1">
                            Payment Method
                        </label>
                        <select 
                            name="payment_method" 
                            id="payment_method" 
                            class="w-full p-2 rounded dark:bg-gray-700 dark:text-gray-100"
                            required
                        >
                            <option value="" disabled selected>-- Choose a Payment Method --</option>
                            <option value="cash" {{ old('payment_method') === 'cash' ? 'selected' : '' }}>Cash</option>
                            <option value="credit_card" {{ old('payment_method') === 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                            <option value="paypal" {{ old('payment_method') === 'paypal' ? 'selected' : '' }}>PayPal</option>
                        </select>
                        @error('payment_method')
                            <span class="text-red-600 dark:text-red-400">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                    >
                        Complete Purchase
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>