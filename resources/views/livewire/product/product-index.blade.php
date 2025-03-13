<div
    x-data="{
        showInsert: false,
        showEdit: false,
        showDelete: false
    }"
>
    {{-- Be like water. --}}

    @include('livewire.product.product-table')
    @include('livewire.product.product-insert')
    @include('livewire.product.product-edit')
    @include('livewire.product.product-delete')
</div>
