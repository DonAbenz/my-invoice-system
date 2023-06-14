<?php

namespace App\Http\Livewire\Invoice;

use App\Jobs\ProcessInvoiceUpdate;
use App\Jobs\ProcessNewInvoice;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use App\Rules\ValidCurrentUserPassword;
use App\Services\CartService;
use Illuminate\Validation\ValidationException;
use LivewireUI\Modal\ModalComponent;

class PostModal extends ModalComponent
{
    public Invoice $invoice;
    public $name;
    public $password;
    public $action;

    public $cartQtys;
    public $total;
    public $content;
    protected $listeners = [
        'productAddedToCart' => 'updateCart',
    ];

    private $cartService;

    public function boot(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function mount(): void
    {
        $this->clearCart();

        if ($this->action == 'edit') {
            $this->name = $this->invoice->customer_name;

            InvoiceItem::where('invoice_code', $this->invoice->code)
                ->get()
                ->each(function ($item) {
                    $product = Product::find($item->product_id);
                    $this->cartService->add($product->id, $product->name, $product->price, $item->quantity);
                });
        }

        $this->updateCart();
    }


    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:50'],
        ];
    }

    public function render()
    {
        $products = Product::all();

        return view('livewire.invoice.post-modal', compact('products'));
    }

    public static function modalMaxWidth(): string
    {
        return '3xl';
    }

    public function updated($propertyName, $value)
    {
        $this->resetValidation($propertyName);

        $this->validateOnly($propertyName);
    }

    public function updatedCartQtys($qty, $id)
    {
        $qty = (!$qty || $qty < 1) ? 1 : $qty;

        $this->cartQtys[$id] = $qty;
        $this->cartService->setQuantity($id, $qty);
        $this->updateCart();
    }

    public function removeFromCart(string $id): void
    {
        $this->cartService->remove($id);
        $this->updateCart();
    }

    public function clearCart(): void
    {
        $this->cartService->clear();
        $this->updateCart();
    }

    public function updateCart()
    {
        $this->content = $this->cartService->content();

        $this->content->each(function ($item, $key) {
            $this->cartQtys[$key] = $item['quantity'];
        });

        $this->total = $this->cartService->total();
    }

    public function store()
    {
        try {

            if (sizeof($this->content) == 0) {
                $this->dispatchBrowserEvent('swal', [
                    'icon' => 'error',
                    'title' => 'Opps!',
                    'text' => 'Line item is currently empty.',
                ]);
                return 0;
            }

            $this->validate();

            ProcessNewInvoice::dispatch($this->name, $this->content);

            $this->dispatchBrowserEvent('swal:refresh', [
                'icon' => 'success',
                'title' => 'Success!',
                'text' => 'Invoice was created successfully',
            ]);

            $this->closeModalWithEvents([
                Index::class => 'pageRender',
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update()
    {
        try {

            if (sizeof($this->content) == 0) {
                $this->dispatchBrowserEvent('swal', [
                    'icon' => 'error',
                    'title' => 'Opps!',
                    'text' => 'Line item is currently empty.',
                ]);
                return 0;
            }

            $this->validate();

            ProcessInvoiceUpdate::dispatch(
                $this->invoice->code,
                $this->name,
                $this->content
            );

            $this->dispatchBrowserEvent('swal:refresh', [
                'icon' => 'success',
                'title' => 'Success!',
                'text' => 'Invoice was updated successfully',
            ]);

            $this->closeModalWithEvents([
                Index::class => 'pageRender',
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
