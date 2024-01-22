@php
    $session_id = Session::getId();
    $cart = \Cart::session($session_id);
    $items = $cart->getContent();
@endphp
<div>
    @foreach($items as $item)
    <x-list-item :item="$item" sub-value="price"/>
    <x-badge value="{{$item['quantity']}}" class="badge-primary" />
    <x-button class="btn-circle btn-outline" icon="o-minus" wire:click="remove({{ $item['id'] }})" spinner />
    <x-button class="btn-circle btn-outline" icon="o-x-mark" wire:click="removeAll()" />
    @endforeach
</div>
