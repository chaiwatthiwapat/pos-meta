<div>
    <div class="text-gray-600 font-medium mt-4">ท็อปปิ้ง</div>
    <div class="py-3 px-4 border border-blue-200 rounded-lg flex flex-wrap gap-4 bg-blue-50">
        @for($i = 0; $i < 4; $i++)
            <label class="relative cursor-pointer">
                <input :checked="unchecked" type="checkbox" name="topping" value="topping{{ $i }}" class="hidden peer">
                <div class="px-4 py-2 border border-gray-300 rounded-lg bg-white shadow-md text-gray-600 
                            peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500 duration-200 select-none">
                    ท็อปปิ้ง {{ $i + 1 }}
                </div>
            </label>
        @endfor
    </div>
</div>
