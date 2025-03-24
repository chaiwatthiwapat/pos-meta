<div x-data="{ showModalProduct: false, showCart: false, showPaymentModal: false }" class="relative">
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div x-show="showCart" class="fixed inset-0 flex items-center justify-center bg-gray-900/50 z-[1000] lg:hidden" style="display: none;"></div>

    <div class="flex gap-3 items-start">
        @include('livewire.pos.pos-product-card')
        @include('livewire.pos.pos-modal-cart')
        @include('livewire.pos.pos-product-modal')
        @include('livewire.pos.pos-payment')
    </div>
</div>

