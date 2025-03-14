<div
    x-data="{
        showInsert: false,
        showEdit: false,
        showDelete: false
    }"
>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    @include('livewire.type.type-table')
    @include('livewire.type.type-insert')
    @include('livewire.type.type-edit')
    @include('livewire.type.type-delete')
</div>


