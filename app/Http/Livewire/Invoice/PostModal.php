<?php

namespace App\Http\Livewire\Invoice;

use App\Actions\CreateNewInvoice;
use App\Actions\UpdateInvoice;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use App\Rules\ValidCurrentUserPassword;
use App\Services\CartService;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class PostModal extends ModalComponent
{
    public Invoice $invoice;
    public $name;
    public $password;
    public $action;

    public $cartQtys;
    public $content;
    protected $listeners = [
        'productAddedToCart' => 'updateCart',
    ];

    private $cartService;

    public function boot()
    {
        $this->cartService = new CartService(instance: 'invoice-cart');
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
            'name' => ['required'],
            'password' => [
                'required',
                new ValidCurrentUserPassword()
            ],
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

    public function updatedCartQtys($qty, $id)
    {
        $qty = (!$qty || $qty < 1) ? 1 : $qty;

        $this->cartQtys[$id] = $qty;
        $this->cartService->setQuantity($id, $qty);
        $this->updateCart();
    }

    public function updateCart()
    {
        $this->resetValidation('items');

        $this->content = $this->cartService->content();

        $this->content->each(function ($item, $key) {
            $this->cartQtys[$key] = $this->content[$key]['quantity'];
        });
    }

    public function store(CreateNewInvoice $createNewInvoice)
    {
        DB::beginTransaction();
        try {

            if (sizeof($this->content) == 0) {
                $this->dispatchBrowserEvent('swal', [
                    'icon' => 'error',
                    'title' => 'Opps!',
                    'text' => 'Cart is empty. Please select atleast one product.',
                ]);
                return 0;
            }

            $this->validate();

            $createNewInvoice->execute(
                $this->name,
            );


            DB::commit();

            $this->cartService->clear();
            $this->updateCart();

            $this->dispatchBrowserEvent('swal', [
                'icon' => 'success',
                'title' => 'Success!',
                'text' => 'Invoice was created successfully',
            ]);

            $this->closeModalWithEvents([
                Index::class => 'pageRender',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function update(UpdateInvoice $updateInvoice)
    {
        DB::beginTransaction();
        try {

            if (sizeof($this->content) == 0) {
                throw ValidationException::withMessages(['items' => 'Please add at least one product.']);
            }

            $this->validate();

            $updateInvoice->execute(
                $this->invoice->code,
                $this->name
            );

            DB::commit();

            $this->dispatchBrowserEvent('swal', [
                'icon' => 'success',
                'title' => 'Success!',
                'text' => 'Invoice was updated successfully',
            ]);

            $this->closeModalWithEvents([
                Index::class => 'pageRender',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
