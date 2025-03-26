<div x-data="{ showDelete: false }">
    {{-- The Master doesn't talk, he acts. --}}

    @include('livewire.orders.orders-table')
    @include('livewire.orders.orders-delete')
    @include('livewire.orders.orders-bills')
</div>
