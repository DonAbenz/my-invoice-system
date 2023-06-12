<?php

namespace App\Actions;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Services\CartService;
use App\Traits\CodeGenerator;

class UpdateInvoice
{
    use CodeGenerator;

    public function execute(
        $invoiceCode,
        $name,
    ): void {

        Invoice::where('code', $invoiceCode)->update([
            'customer_name' => $name,
        ]);

        InvoiceItem::where('invoice_code', $invoiceCode)->delete();

        $cartService = new CartService(instance: 'invoice-cart');

        $cartService->content()->each(function ($item, $key) use ($invoiceCode, $cartService) {
            InvoiceItem::create([
                'invoice_code' => $invoiceCode,
                'product_id' => $cartService->content()[$key]['id'],
                'quantity' => $cartService->content()[$key]['quantity'],
                'price' => $cartService->content()[$key]['price'],
                'total' => $cartService->content()[$key]['price'] * $cartService->content()[$key]['quantity'],
            ]);
        });
    }
}
