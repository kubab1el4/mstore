<div>
    <!-- HEADER -->
    <x-header title="Hello" separator progress-indicator>
        <x-slot:actions>
            <livewire:add-product-button />
        </x-slot:actions>
    </x-header>

    <!-- TABLE  -->
    <x-card>
        <x-table :headers="$headers" :rows="$products" :sort-by="$sortBy">
            @scope('actions', $product)
            <x-button icon="m-x-circle" wire:click="delete({{ $product['id'] }})" spinner class="btn-ghost btn-sm text-red-500" />
            @endscope
            {{-- <x-image-library
            wire:model="files"                 {{-- Temprary files --}}
            wire:library="library"             {{-- Library metadata property --}}
            :preview="$library"                {{-- Preview control --}}
            label="Product images"
            hint="Max 100Kb" /> --}}
        </x-table>
    </x-card>

    <!-- FILTER DRAWER -->
    <x-drawer wire:model.live="drawer" title="Filters" right separator with-close-button class="lg:w-1/3">
        <x-input placeholder="Search..." wire:model.live.debounce="search" icon="o-magnifying-glass" @keydown.enter="$wire.drawer = false" />

        <x-slot:actions>
            <x-button label="Reset" icon="o-x-mark" wire:click="clear" spinner />
            <x-button label="Done" icon="o-check" class="btn-primary" @click="$wire.drawer = false" />
        </x-slot:actions>
    </x-drawer>
</div>
