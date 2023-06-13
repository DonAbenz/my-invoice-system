<?php

namespace App\Http\Livewire\Invoice;

use App\Models\Invoice;
use LivewireUI\Modal\ModalComponent;

class Show extends ModalComponent
{
    public Invoice $invoice;

    public function render()
    {
        return view('livewire.invoice.show');
    }

    public static function modalMaxWidth(): string
    {
        return '3xl';
    }
}
