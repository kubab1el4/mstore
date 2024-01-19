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
        $cart->update($product, array(
            'quantity' => -1
        ));
        $storage = new DBStorage;
        $storage->put($session_id, $cart->getContent());
        $this->dispatch('cartUpdated');
    }

    public function removeAll(): void
    {
        $session_id = Session::getId();
        $cart = \Cart::session($session_id);
        $items = $cart->getContent();
        foreach ($items as $item) {
            $cart->remove($item['id']);
        }
        $storage = new DBStorage;
        $storage->put($session_id, $cart->getContent());
        $this->dispatch('cartUpdated');
    }
}
