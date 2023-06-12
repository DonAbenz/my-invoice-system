<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;

class CartService
{
    const MINIMUM_QUANTITY = 1;
    const DEFAULT_INSTANCE = 'shopping-cart';

    protected $session;
    protected $instance;

    public function __construct($instance = null)
    {
        $this->session = resolve(SessionManager::class);
        $this->instance = $instance ?? self::DEFAULT_INSTANCE;
    }

    public function add($id, $name, $price, $quantity, $options = []): void
    {
        $cartItem = $this->createCartItem($id, $name, $price, $quantity, $options);

        $content = $this->getContent();

        if ($content->has($id)) {
            $cartItem->put('quantity', $content->get($id)->get('quantity') + $quantity);
        }

        $content->put($id, $cartItem);

        $this->session->put(
            $this->instance,
            $content
        );
    }

    public function update(string $id, string $action): void
    {
        $content = $this->getContent();

        if ($content->has($id)) {
            $cartItem = $content->get($id);

            switch ($action) {
                case 'plus':
                    $cartItem->put('quantity', $content->get($id)->get('quantity') + 1);
                    break;
                case 'minus':
                    $updatedQuantity = $content->get($id)->get('quantity') - 1;

                    if ($updatedQuantity < self::MINIMUM_QUANTITY) {
                        $updatedQuantity = self::MINIMUM_QUANTITY;
                    }

                    $cartItem->put('quantity', $updatedQuantity);
                    break;
            }

            $content->put($id, $cartItem);

            $this->session->put(
                $this->instance,
                $content
            );
        }
    }

    public function setQuantity(string $id, int $qty): void
    {
        $content = $this->getContent();

        if ($content->has($id)) {
            $cartItem = $content->get($id);

            $cartItem->put('quantity', $qty);

            $content->put($id, $cartItem);

            $this->session->put(
                $this->instance,
                $content
            );
        }
    }

    public function remove(string $id): void
    {
        $content = $this->getContent();

        if ($content->has($id)) {
            $this->session->put(
                $this->instance,
                $content->except($id)
            );
        }
    }

    public function clear(): void
    {
        $this->session->forget(
            $this->instance
        );
    }

    public function content(): Collection
    {
        return is_null($this->session->get($this->instance)) ? collect([]) : $this->session->get($this->instance);
    }

    public function total(): float
    {
        $content = $this->getContent();

        $total = $content->reduce(function ($total, $item) {
            return $total += $item->get('price') * $item->get('quantity');
        });

        return $total ?? 0;
    }

    protected function getContent(): Collection
    {
        return $this->session->has($this->instance) ? $this->session->get($this->instance) : collect([]);
    }

    protected function createCartItem(string $id, string $name, string $price, string $quantity, array $options): Collection
    {
        $price = floatval($price);
        $quantity = intval($quantity);

        if ($quantity < self::MINIMUM_QUANTITY) {
            $quantity = self::MINIMUM_QUANTITY;
        }

        return collect([
            'id' => $id,
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
            'options' => $options,
        ]);
    }
}
