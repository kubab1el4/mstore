<?php

namespace App\Livewire;

use App\Models\Product;
use App\Storage\DBStorage;
use Darryldecode\Cart\Cart;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Mary\Traits\Toast;

class Welcome extends Component
{
    use Toast;

    public string $search = '';

    public bool $drawer = false;

    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    // Clear filters
    public function clear(): void
    {
        $this->reset();
        $this->success('Filters cleared.', position: 'toast-bottom');
    }

    // Delete action
    public function delete($id): void
    {
        $this->warning("Will delete #$id", 'It is fake.', position: 'toast-bottom');
    }

    public function addToCart($product): void
    {
        $product = Product::find($product);
        $session_id = Session::getId();
        $cart = \Cart::session($session_id);
        $items = $cart->getContent();
        $cartProductID = $product->category . $product->id;
        if ($cart->get($cartProductID) != null)
        {
            $cart->update($cartProductID,[
                'quantity' => 1
                ]);
        } else
        {
            $cart->add([
            'id' => $cartProductID,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $product
            ]);
        }
        $storage = new DBStorage;
        $storage->put($session_id, $cart->getContent());
        $this->dispatch('itemAddedToCart');
    }

    // Table headers
    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'name', 'label' => 'Name', 'class' => 'w-64'],
            ['key' => 'description', 'label' => 'Description', 'class' => 'w-20'],
            ['key' => 'price', 'label' => 'Price', 'class' => 'w-64'],
            ['key' => 'category', 'label' => 'Category'],
        ];
    }

    /**
     * For demo purpose, this is a static collection.
     *
     * On real projects you do it with Eloquent collections.
     * Please, refer to Mary docs to see the eloquent examples.
     */
    public function products(): Collection
    {
        return Product::all();
    }

    public function render()
    {
        return view('livewire.welcome', [
            'products' => $this->products(),
            'headers' => $this->headers()
        ]);
    }
}
