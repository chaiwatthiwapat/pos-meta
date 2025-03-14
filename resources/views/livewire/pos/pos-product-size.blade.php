<div>
    <div class="text-gray-600 font-medium mt-4">ขนาด</div>

    <div class="py-3 px-4 border border-blue-200 rounded-lg flex flex-wrap gap-4 bg-blue-50">
        <label class="relative cursor-pointer">
            <input type="radio" name="size" value="none" class="hidden peer" checked>
            <div class="px-4 py-2 border border-gray-300 rounded-lg bg-white shadow-sm text-gray-600 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500 duration-200">
                ไม่เลือก
            </div>
        </label>

        @foreach($this->sizes() as $row)
            <label class="relative cursor-pointer">
                <input type="radio" name="size" value="size{{ $loop->index }}" class="hidden peer">
                <div class="px-4 py-2 border border-gray-300 rounded-lg bg-white shadow-sm text-gray-600 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500 duration-200 select-none">
                    {{ $row->name }}
                </div>
            </label>
        @endforeach
    </div>
</div>
