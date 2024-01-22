<?php

namespace App\Livewire;

use App\Models\Product;
use App\Storage\DBStorage;
use Livewire\Component;
use Session;

class ItemList extends Component
{
    public function render()
    {
        return view('livewire.item-list');
    }

    public function remove($product): void
    {
        $session_id = Session::getId();
        $cart = \Cart::session($session_id);
        $productBean = $cart->get($product);
        if ($cart->get($product)->quantity > 1) {
        $cart->update($product, [
            'quantity' => -1
        ]);
        } else {
            $cart->remove($product);
        }
        $storage = new DBStorage;
        $storage->put($session_id, $cart->getContent());
        $this->dispatch('cartUpdated');
    }

    public function removeAll(): void
    {
        $session_id = Session::getId();
        $cart = \Cart::session($session_id);
        $products = $cart->getContent();
        foreach ($products as $product) {
            $cart->remove($product['id']);
        }
        $storage = new DBStorage;
        $storage->put($session_id, $cart->getContent());
        $this->dispatch('cartUpdated');
    }
}
