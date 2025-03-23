<div>
    <div class="text-gray-600 font-medium mt-4">
        ขนาด:
        <span x-text="size.price" class="text-blue-600 font-semibold"></span>
    </div>

    <div class="pt-3 px-4 border border-blue-200 rounded-lg bg-blue-50">
        <div class="pb-3 flex gap-3 overflow-auto w-full">
            <label x-on:click="size.name = ''; size.price = 0" x-on:refresh-options.window="$el.click()" class="relative cursor-pointer">
                <input type="radio" name="size" value="none" class="hidden peer" checked>
                <div class="px-4 py-2 border border-gray-300 rounded-lg bg-white shadow-sm text-gray-600 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500 duration-200">
                    ปกติ
                </div>
            </label>
    
            @foreach($this->sizes() as $row)
                <label x-on:click="size.name = '{{ $row->name }}'; size.price = {{ $row->price }}" class="relative cursor-pointer">
                    <input type="radio" name="size" value="size{{ $loop->index }}" class="hidden peer">
                    <div class="px-4 py-2 border border-gray-300 rounded-lg bg-white shadow-sm text-gray-600 peer-checked:bg-blue-500 
                        peer-checked:text-white peer-checked:border-blue-500 duration-200 select-none whitespace-nowrap">
                        {{ $row->name }}
                    </div>
                </label>
            @endforeach
        </div>
    </div>
</div>


