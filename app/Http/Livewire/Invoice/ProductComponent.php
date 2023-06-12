<?php

namespace App\Http\Livewire\Invoice;

use App\Services\CartService;
use Livewire\Component;

class ProductComponent extends Component
{

    public $product;
    public $quantity;
    public $instance;
    /**
     * Mounts the component on the template.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->quantity = 1;
    }

    public function render()
    {
        return view('livewire.invoice.product-component');
    }

    /**
     * Adds an item to cart.
     *
     * @return void
     */
    public function addToCart(): void
    {
        (new CartService(instance: $this->instance))->add($this->product->id, $this->product->name, $this->product->price, $this->quantity);
        $this->emit('productAddedToCart', $this->product->id);
    }
}
