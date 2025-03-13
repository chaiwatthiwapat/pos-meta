<div x-data="{ showModalProduct: false }">
    {{-- Because she competes with no one, no one can compete with her. --}}

    <div class="flex gap-3 items-start">
        @include('livewire.pos.pos-product-card')
        @include('livewire.pos.pos-cart')
        @include('livewire.pos.pos-product-modal')
    </div>
</div>

