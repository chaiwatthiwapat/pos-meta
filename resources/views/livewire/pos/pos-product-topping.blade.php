<div>
    <div class="text-gray-600 font-medium mt-4">
        ท็อปปิ้ง
        <span x-text="topping.price.reduce((sum, p) => sum + p, 0)" class="text-blue-600 font-semibold"></span>
    </div>
    <div class="pt-3 px-4 border border-blue-200 rounded-lg bg-blue-50">
        <div class="pb-3 flex gap-3 overflow-auto w-full">

            @foreach($this->toppings() as $row)
                <label class="relative cursor-pointer">
                    <input type="checkbox" name="topping"
                        value="topping{{ $loop->index }}"
                        class="hidden peer"
                        x-on:refresh-options.window="$el.checked ? $el.click() : null"
                        x-on:change="updateTopping('{{ $row->name }}', {{ $row->price }}, $event)">

                    <div class="px-4 py-2 border border-gray-300 rounded-lg bg-white shadow-md text-gray-600
                        peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500 duration-200 select-none whitespace-nowrap">
                        {{ $row->name }}
                    </div>
                </label>
            @endforeach

        </div>
    </div>
</div>
