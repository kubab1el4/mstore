<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class AddProductButton extends Component
{

    public bool $addProductModal = false;

    public string $name;

    public string $description;

    public string $category;

    public float $price;

    public function render()
    {
        return view('livewire.add-product-button');
    }

    public function save()
    {
        $product = new Product;
        $product->name = $this->name;
        $product->description = $this->description;
        $product->price = $this->price;
        $product->category_id = $this->category;
        $product->save();
        $this->addProductModal = false;
        $this->dispatch('productCreated');
    }
}
