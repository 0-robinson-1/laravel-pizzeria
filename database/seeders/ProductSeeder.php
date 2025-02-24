<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; // Make sure this matches your actual namespace!

class ProductSeeder extends Seeder
{
    public function run()
    {
        $pizzas = [
            [
                'product_name' => 'Margherita',
                'price'        => 7.99,
                'composition'  => 'Tomato sauce, mozzarella, fresh basil'
            ],
            [
                'product_name' => 'Pepperoni',
                'price'        => 8.99,
                'composition'  => 'Tomato sauce, mozzarella, pepperoni'
            ],
            [
                'product_name' => 'Hawaiian',
                'price'        => 9.50,
                'composition'  => 'Tomato sauce, mozzarella, ham, pineapple'
            ],
            [
                'product_name' => 'BBQ Chicken',
                'price'        => 10.50,
                'composition'  => 'BBQ sauce, chicken, red onions, mozzarella'
            ],
            [
                'product_name' => 'Meat Lovers',
                'price'        => 11.99,
                'composition'  => 'Tomato sauce, mozzarella, pepperoni, ham, sausage, bacon'
            ],
            [
                'product_name' => 'Veggie Delight',
                'price'        => 9.99,
                'composition'  => 'Tomato sauce, mozzarella, bell peppers, onions, mushrooms, olives'
            ],
            [
                'product_name' => 'Quattro Formaggi',
                'price'        => 10.99,
                'composition'  => 'Tomato sauce, mozzarella, gorgonzola, parmesan, goat cheese'
            ],
            [
                'product_name' => 'Buffalo Chicken',
                'price'        => 10.49,
                'composition'  => 'Buffalo sauce, mozzarella, chicken, red onions, ranch drizzle'
            ],
            [
                'product_name' => 'Mushroom & Spinach',
                'price'        => 9.49,
                'composition'  => 'Alfredo sauce, mozzarella, mushrooms, spinach, garlic'
            ],
            [
                'product_name' => 'Seafood Special',
                'price'        => 12.99,
                'composition'  => 'Tomato sauce, mozzarella, shrimp, calamari, garlic, parsley'
            ],
        ];

        foreach ($pizzas as $pizza) {
            Product::create($pizza);
        }
    }
}