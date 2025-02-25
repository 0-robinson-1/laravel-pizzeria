<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>

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

                <div class="px-6 pb-6 text-gray-900 dark:text-gray-100">
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

                <!-- "See Our Menu" button -->
                <div class="flex items-center justify-center mt-8">
                    <a
                        href="{{ route('products.index') }}"
                        class="
                            text-white
                            font-semibold
                            py-4
                            px-12
                            text-lg
                            hover:bg-[#7f8c8d]
                            shadow-md
                            border-2
                            border-white
                            rounded
                        "
                    >
                        See Our Menu
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>