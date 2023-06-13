<?php

namespace App\Actions;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Services\CartService;
use App\Traits\CodeGenerator;

class CreateNewInvoice
{
    use CodeGenerator;

    public function execute(
        $name,
    ): void {

        $createdInvoice = Invoice::create([
            'code' => $this->generateCode('invoices'),
            'customer_name' => $name,
        ]);

        $cartService = new CartService();

        $cartService->content()->each(function ($item, $key) use ($createdInvoice, $cartService) {
            InvoiceItem::create([
                'invoice_code' => $createdInvoice->code,
                'product_id' => $cartService->content()[$key]['id'],
                'quantity' => $cartService->content()[$key]['quantity'],
                'price' => $cartService->content()[$key]['price'],
                'total' => $cartService->content()[$key]['price'] * $cartService->content()[$key]['quantity'],
            ]);
        });
    }
}
