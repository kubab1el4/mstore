<?php

namespace App\Livewire;

use App\Models\Media;
use App\Models\Product;
use Illuminate\Support\Collection;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Mary\Traits\WithMediaSync;

class AddMediaButton extends Component
{

     use WithFileUploads, WithMediaSync;

     #[Rule(['files.*' => 'image|max:1024'])]
     public array $files = [];

     #[Rule('required')]

     public Collection $library;

    public Product $product;


    public bool $addMediaModal = false;

    public function mount(): void
    {
        $this->library = new Collection;
    }

    public function render()
    {
        return view('livewire.add-media-button');
    }

    public function save()
    {
        $media = new Media;
        $this->syncMedia($media);
        dd($media);
        $this->addMediaModal = false;
        $this->dispatch('mediaAdded');
    }
}
