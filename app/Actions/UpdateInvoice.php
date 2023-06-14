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
        $invoiceItems,
    ): void {

        Invoice::where('code', $invoiceCode)->update([
            'customer_name' => $name,
        ]);

        InvoiceItem::where('invoice_code', $invoiceCode)->forceDelete();

        $invoiceItems->each(function ($item) use ($invoiceCode) {
            InvoiceItem::create([
                'invoice_code' => $invoiceCode,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total' => $item['price'] * $item['quantity'],
            ]);
        });
    }
}
