<div
    x-data="{
        showInsert: false,
        showEdit: false,
        showDelete: false
    }"
>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

    @include('livewire.size.size-table')
    @include('livewire.size.size-insert')
    @include('livewire.size.size-edit')
    @include('livewire.size.size-delete')
</div>
