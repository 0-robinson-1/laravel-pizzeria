<!-- resources/views/products/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pizza Overview</title>
    <style>
        /* Parent container to arrange pizza cards in a grid */
        .pizza-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            grid-gap: 1rem; /* spacing between the cards */
            margin: 1rem;
        }

        /* Card styling for each pizza */
        .pizza-card {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 1rem;
            text-align: center; /* Optional: center text */
        }

        /* Make the card a perfect square (optional) */
        /* This approach can crop taller content, so only do this if you want squares specifically */
        /* .pizza-card {
            aspect-ratio: 1 / 1;
            overflow: hidden;
        } */

        .pizza-card h2 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <h1>Our Pizzas</h1>
    <div class="pizza-grid">
        @foreach ($pizzas as $pizza)
            <div class="pizza-card">
                <h2>{{ $pizza->product_name }}</h2>
                <p><strong>Price:</strong> ${{ $pizza->price }}</p>
                <p><strong>Ingredients:</strong> {{ $pizza->composition }}</p>
                {{-- Later, you can add your "Add to Cart" button here --}}
            </div>
        @endforeach
    </div>
</body>
</html>