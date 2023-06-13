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

        InvoiceItem::where('invoice_code', $invoiceCode)->delete();

        $invoiceItems->each(function ($item, $key) use ($invoiceCode, $invoiceItems) {
            InvoiceItem::create([
                'invoice_code' => $invoiceCode,
                'product_id' => $invoiceItems[$key]['id'],
                'quantity' => $invoiceItems[$key]['quantity'],
                'price' => $invoiceItems[$key]['price'],
                'total' => $invoiceItems[$key]['price'] * $invoiceItems[$key]['quantity'],
            ]);
        });
    }
}
