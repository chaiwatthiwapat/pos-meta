<div
    x-data="{
        showInsert: false,
        showEdit: false,
        showDelete: false
    }"
>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    @include('livewire.topping.topping-table')
    @include('livewire.topping.topping-insert')
    @include('livewire.topping.topping-edit')
    @include('livewire.topping.topping-delete')
</div>



