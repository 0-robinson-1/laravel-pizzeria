<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pizza Overview') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Main container styled like your dashboard --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                {{-- Title --}}
                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">
                    Our Pizzas
                </h1>

                <!-- Start Cart Summary Snippet -->
                @php
                    $cart = session('cart', []);
                    $itemCount = 0;
                    $totalPrice = 0;
                    foreach ($cart as $item) {
                        $itemCount += $item['quantity'];
                        $totalPrice += $item['price'] * $item['quantity'];
                    }
                @endphp

                <div class="mb-6 text-gray-900 dark:text-gray-100">
                    @if ($itemCount > 0)
                        <p class="mb-2">
                            <strong>Cart Summary:</strong><br>
                            You have {{ $itemCount }} item(s) in your cart,
                            totaling ${{ number_format($totalPrice, 2) }}.
                        </p>
                        <a 
                            href="{{ route('cart.index') }}" 
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        >
                            Go to Cart
                        </a>
                    @else
                        <p>Your cart is empty.</p>
                    @endif
                </div>
                <!-- End Cart Summary Snippet -->
                
                {{-- Grid container for pizzas --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($pizzas as $pizza)
                        <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded shadow">
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">
                                {{ $pizza->product_name }}
                            </h2>
                            <p class="text-gray-900 dark:text-gray-100">
                                <strong>Price:</strong> ${{ $pizza->price }}
                            </p>
                            <p class="text-gray-900 dark:text-gray-100">
                                <strong>Ingredients:</strong> {{ $pizza->composition }}
                            </p>

                            <!-- Add to Cart Form -->
                            <form action="{{ route('cart.add') }}" method="POST" class="mt-4">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $pizza->product_id }}">
                                <label for="quantity" class="block text-gray-900 dark:text-gray-100">
                                    Quantity:
                                </label>
                                <input 
                                    type="number" 
                                    name="quantity" 
                                    value="1" 
                                    min="1"
                                    class="w-16 dark:bg-gray-600 dark:text-gray-100 text-gray-900 text-center rounded"
                                >
                                <button 
                                    type="submit"
                                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2"
                                >
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>