<div
    x-data="{
        showInsert: false,
        showEdit: false,
        showDelete: false
    }"
>
    {{-- Do your work, then step back. --}}
    @include('livewire.user.user-table')
    @include('livewire.user.user-insert')
    @include('livewire.user.user-edit')
    @include('livewire.user.user-delete')
</div>



