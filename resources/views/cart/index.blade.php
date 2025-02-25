<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Your Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if (session('success'))
                    <div class="mb-4 text-green-600 dark:text-green-400">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 text-red-600 dark:text-red-400">
                        {{ session('error') }}
                    </div>
                @endif

                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">
                    Shopping Cart
                </h1>

                @if(count($cart) > 0)
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                        <thead>
                            <tr>
                                <th class="py-3 px-6 text-left text-gray-900 dark:text-gray-100">Product</th>
                                <th class="py-3 px-6 text-left text-gray-900 dark:text-gray-100">Quantity</th>
                                <th class="py-3 px-6 text-left text-gray-900 dark:text-gray-100">Price</th>
                                <th class="py-3 px-6"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $item)
                                <tr>
                                    <td class="py-4 px-6 text-gray-900 dark:text-gray-100">
                                        {{ $item['name'] }}
                                    </td>
                                    <td class="py-4 px-6 text-gray-900 dark:text-gray-100">
                                        {{ $item['quantity'] }}
                                    </td>
                                    <td class="py-4 px-6 text-gray-900 dark:text-gray-100">
                                        ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                            <button 
                                                type="submit" 
                                                class="text-red-600 hover:text-red-800"
                                            >
                                                Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Buttons section -->
                    <div class="mt-6 flex space-x-4">
                        <!-- Clear Cart Button -->
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button 
                                type="submit" 
                                class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                            >
                                Clear Cart
                            </button>
                        </form>

                        <!-- Continue Shopping Button -->
                        <a 
                            href="{{ route('products.index') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        >
                            Continue Shopping
                        </a>

                        <!-- Checkout Button (links to the intermediate checkout page) -->
                        <a 
                            href="{{ route('checkout.show') }}"
                            class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                        >
                            Checkout
                        </a>
                    </div>
                @else
                    <p class="text-gray-900 dark:text-gray-100">Your cart is empty.</p>
                    
                    <!-- "Go to Menu" Button when cart is empty -->
                    <div class="mt-4">
                        <a
                            href="{{ route('products.index') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        >
                            Go to Menu
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>