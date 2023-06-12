<?php

namespace App\Actions;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Services\CartService;
use App\Traits\CodeGenerator;

class DeleteInvoice
{
    use CodeGenerator;

    public function execute(
        $invoiceCode,
    ): void {
        Invoice::where('code', $invoiceCode)->delete();
        InvoiceItem::where('invoice_code', $invoiceCode)->delete();
    }
}
