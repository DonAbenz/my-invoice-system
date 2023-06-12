<?php

namespace App\Http\Livewire\Order;

use App\Filters\OrderFilter;
use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $searchTerm;

    public function render()
    {
        $results = Order::query()
            ->with('orderDetails')
            ->filter(new OrderFilter([
                'search' => $this->searchTerm,
            ]))
            ->latest()
            ->paginate(5);

        return view('livewire.order.index', compact('results'));
    }
}
