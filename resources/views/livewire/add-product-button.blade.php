<div>
    <x-button label="Dodaj produkt" class="btn-primary" wire:click="$toggle('addProductModal')" />

    <x-modal class="justify-center" wire:model="addProductModal" title="Wpisz cechy produktu">

        <x-slot:actions>
        <x-form wire:submit="save">
            <x-input label="Nazwa" wire:model="name" />
            <x-input label="Opis" wire:model="description"/>
            <x-input label="Cena" wire:model="price" prefix="PLN" money />
            @php
            $categories = App\Models\Category::all();
            @endphp
            <x-select
            label="Kategoria"
            :options="$categories"
            option-value="id"
            option-label="name"
            placeholder="Wybierz kategorię"
            placeholder-value="0" {{-- Set a value for placeholder. Default is `null` --}}
            wire:model="category" />

            <x-slot:actions>
                <x-button label="Anuluj" wire:click="$toggle('addProductModal')" />
                <x-button label="Zapisz" class="btn-primary" type="submit" spinner="save"/>
            </x-slot:actions>
        </x-form>
        </x-slot:actions>
    </x-modal>
</div>


