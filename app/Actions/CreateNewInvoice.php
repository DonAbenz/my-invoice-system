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
        $invoiceItems,
    ): void {

        $createdInvoice = Invoice::create([
            'code' => $this->generateCode('invoices'),
            'customer_name' => $name,
        ]);

        $invoiceItems->each(function ($item, $key) use ($createdInvoice, $invoiceItems) {
            InvoiceItem::create([
                'invoice_code' => $createdInvoice->code,
                'product_id' => $invoiceItems[$key]['id'],
                'quantity' => $invoiceItems[$key]['quantity'],
                'price' => $invoiceItems[$key]['price'],
                'total' => $invoiceItems[$key]['price'] * $invoiceItems[$key]['quantity'],
            ]);
        });
    }
}
