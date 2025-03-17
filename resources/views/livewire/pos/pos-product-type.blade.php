<div>
    <div class="text-gray-600 font-medium mt-4">
        ประเภท
        <span x-text="type.price" class="text-blue-600 font-semibold"></span>
    </div>

    <div class="py-3 px-4 border border-blue-200 rounded-lg flex flex-wrap gap-4 bg-blue-50">
        <label x-on:click="type.name = ''; type.price = 0" class="relative cursor-pointer">
            <input type="radio" name="type" value="none" class="hidden peer" checked>
            <div class="px-4 py-2 border border-gray-300 rounded-lg bg-white shadow-md text-gray-600
                peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500 duration-200">
                ปกติ
            </div>
        </label>

        @foreach($this->types() as $row)
            <label x-on:click="type.name = '{{ $row->name }}'; type.price = {{ $row->price }}" class="relative cursor-pointer">
                <input type="radio" name="type" value="type{{ $loop->index }}" class="hidden peer">
                <div class="px-4 py-2 border border-gray-300 rounded-lg bg-white shadow-md text-gray-600
                            peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500 duration-200 select-none">
                    {{ $row->name }}
                </div>
            </label>
        @endforeach
    </div>
</div>
