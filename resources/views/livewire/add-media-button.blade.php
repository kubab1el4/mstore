<div>
    <x-button icon="o-photo" wire:click="$toggle('addMediaModal')" />

    <x-modal class="justify-center min-h-96 min-w-96" wire:model="addMediaModal" title="Wybierz zdjęcia">

        <x-slot:actions>
            <x-image-library
            wire:model="files"
            wire:library="library"
            :preview="$library"
            hint="Max 100Kb" />
        </x-slot:actions>
    </x-modal>
</div>


