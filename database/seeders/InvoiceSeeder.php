<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use App\Traits\CodeGenerator;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    use CodeGenerator;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $createdInvoice = Invoice::create([
                'code' => $this->generateCode('invoices'),
                'customer_name' => $faker->name()
            ]);

            $limitRandomArrayValues = range(1, rand(2, 5));
            shuffle($limitRandomArrayValues);

            foreach ($limitRandomArrayValues as $number) {
                $product = Product::find($number);
                $quantity = rand(1, 5);
                InvoiceItem::create([
                    'invoice_code' => $createdInvoice->code,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'total' => $product->price * $quantity,
                ]);
            }
        }
    }
}
