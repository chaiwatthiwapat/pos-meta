<div>
    <div class="text-gray-600 font-medium mt-4">
        ประเภท
        <span x-text="type.price" class="text-blue-600 font-semibold"></span>
    </div>

    <div class="pt-3 px-4 border border-gray-200  border-blue-200 rounded-lg bg-blue-50">
        <div class="pb-3 flex gap-3 overflow-auto w-full">
            <label x-on:click="type.name = ''; type.price = 0" x-on:refresh-options.window="$el.click()" class="relative cursor-pointer">
                <input type="radio" name="type" value="none" class="hidden peer" checked>
                <div class="px-4 py-2 border border-gray-200  border-gray-300 rounded-lg bg-white shadow-md text-gray-600
                    peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500 duration-200">
                    ปกติ
                </div>
            </label>

            @foreach($this->types() as $row)
                <label x-on:click="type.name = '{{ $row->name }}'; type.price = {{ $row->price }}" class="relative cursor-pointer">
                    <input type="radio" name="type" value="type{{ $loop->index }}" class="hidden peer">
                    <div class="px-4 py-2 border border-gray-200  border-gray-300 rounded-lg bg-white shadow-md text-gray-600
                        peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500 duration-200 select-none whitespace-nowrap">
                        {{ $row->name }}
                    </div>
                </label>
            @endforeach
        </div>
    </div>
</div>
