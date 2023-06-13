<?php

namespace App\Http\Livewire\Invoice;

use App\Actions\DeleteInvoice;
use App\Filters\InvoiceFilter;
use App\Traits\AuthChecker;
use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, AuthChecker;

    public $searchTerm;
    public $selectedInvoiceCode;

    public function getListeners()
    {
        return [
            'pageRender' => '$refresh',
            'destroy',
        ];
    }

    public function render()
    {
        $results = Invoice::query()
            ->with('invoiceItems')
            ->filter(new InvoiceFilter([
                'search' => $this->searchTerm,
            ]))
            ->paginate(10);

        return view('livewire.invoice.index', compact('results'));
    }

    public function confirmDelete($code)
    {
        $this->selectedInvoiceCode = $code;

        $this->dispatchBrowserEvent('swal:confirm.password', [
            'icon' => 'warning',
            'title' => 'Delete Invoice',
            'text' => 'For security, please confirm your password to continue.',
            'confirmButtonText' => 'Proceed',
            'denyButtonText' => 'No, Cancel!',
            'actionMethod' => 'destroy',
        ]);
    }

    public function destroy($data, DeleteInvoice $deleteInvoice)
    {
        if ($this->checkAuth($data[0])) {
            return 0;
        }

        $deleteInvoice->execute($this->selectedInvoiceCode);

        $this->dispatchBrowserEvent('swal', [
            'icon' => 'success',
            'title' => 'Destroyed!',
            'text' => 'Invoice was successfully deleted.',
        ]);
    }
}
