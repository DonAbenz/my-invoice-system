<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Traits\CodeGenerator;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    use CodeGenerator;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $createdOrder = Order::create([
                'code' => $this->generateCode('orders'),
                'customer_name' => $faker->name()
            ]);

            for ($j = 0; $j < rand(2, 5); $j++) {

                $product = Product::find(rand(1, 5));
                $quantity = rand(1, 5);

                OrderDetail::create([
                    'order_code' => $createdOrder->code,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'total' => $product->price * $quantity,
                ]);
            }
        }
    }
}
