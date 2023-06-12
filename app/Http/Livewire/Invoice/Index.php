<?php

namespace App\Http\Livewire\Invoice;

use App\Filters\InvoiceFilter;
use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $searchTerm;

    public function getListeners()
    {
        return ['pageRender' => '$refresh'];
    }

    public function render()
    {
        $results = Invoice::query()
            ->with('invoiceItems')
            ->filter(new InvoiceFilter([
                'search' => $this->searchTerm,
            ]))
            ->latest()
            ->paginate(5);

        return view('livewire.invoice.index', compact('results'));
    }
}
