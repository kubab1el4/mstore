<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Collection;
use Livewire\Component;
use Mary\Traits\Toast;
use Session;

class AdminPanel extends Component
{
    use Toast;

    public string $search = '';

    protected $listeners = ['productCreated' => '$refresh'];

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
        $this->warning("Will delete #$id", position: 'toast-bottom');
        $product = Product::find($id)->delete();
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
        $this->product = new Product;
        return view('livewire.admin-panel', [
            'products' => $this->products(),
            'headers' => $this->headers()
        ]);
    }
}
