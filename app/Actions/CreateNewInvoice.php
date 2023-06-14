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

        $invoiceItems->each(function ($item) use ($createdInvoice) {
            InvoiceItem::create([
                'invoice_code' => $createdInvoice->code,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total' => $item['price'] * $item['quantity'],
            ]);
        });
    }
}
