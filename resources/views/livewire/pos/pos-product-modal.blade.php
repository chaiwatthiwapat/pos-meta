<div
    x-data="{
        product: {
            id: @entangle('id'),
            name: @entangle('name'),
            price: @entangle('price'),
            qty: @entangle('qty')
        },
        size: { name: '', price: 0 },
        type: { name: '', price: 0 },
        topping: { name: [], price: [] },
        updateTopping(name, price, event) {
            if(event.target.checked) {
                this.topping.name.push(name);
                this.topping.price.push(price);
            }
            else {
                let index = this.topping.name.indexOf(name);
                if(index !== -1) {
                    this.topping.name.splice(index, 1);
                    this.topping.price.splice(index, 1);
                }
            }
        },
        get optionPrice() {
            return this.size.price + this.type.price + this.topping.price.reduce((sum, p) => sum + p, 0);
        },
        get amount() {
            return this.product.qty * (this.product.price + this.optionPrice);
        }
    }"
    x-show="showModalProduct"
    x-on:keydown.escape.window="showModalProduct = false"
    style="display: none" class="fixed inset-0 flex items-center justify-center bg-gray-900/50 z-[3000]">
    {{--  --}}
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg mx-4 relative overflow-hidden">
        {{-- Header --}}
        <h2 data-modal-header class="text-xl font-bold mb-4">เมนู</h2>

        <div>
            <p class="text-gray-600 mb-2">
                {{ $productData?->name }}
                <span class="text-blue-600 font-semibold">
                    {{ $price }}
                </span>
            </p>

            <div class="flex gap-4 p-4 bg-white rounded-lg shadow-lg">
                <div class="w-24 h-24 overflow-hidden rounded-lg border border-gray-200  border-gray-200 shadow-md flex items-center justify-center">
                    <img class="w-full h-full object-cover" src="{{ asset('storage/product-images/' . ($productData?->image ?? 'default.png')) }}" alt="pos product">
                </div>

                <div class="flex flex-col justify-between flex-1">
                    <div class="mb-1">
                        <div class="text-gray-600 text-sm">จำนวน</div>
                        <div class="flex items-center text-sm font-semibold text-gray-700">
                            <button x-on:click="product.qty > 1 ? product.qty-- : null" class="select-none px-2 py-1 bg-blue-200 text-blue-500 rounded-lg hover:bg-blue-300 duration-200 cursor-pointer">
                                -
                            </button>
                            <div x-text="product.qty" class="w-[40px] text-center select-none"></div>
                            <button x-on:click="product.qty++" class="select-none px-2 py-1 bg-blue-200 text-blue-500 rounded-lg hover:bg-blue-300 duration-200 cursor-pointer">
                                +
                            </button>
                        </div>
                    </div>

                    <div class="px-4 py-2 bg-blue-50 text-blue-600 font-semibold rounded-lg">
                        <span>ราคา:</span>
                        <span x-text="amount"></span>
                    </div>
                </div>
            </div>

            <div>
                @include('livewire.pos.pos-product-size')
                @include('livewire.pos.pos-product-type')
                @include('livewire.pos.pos-product-topping')
            </div>
        </div>

        <div class="mt-4 flex justify-end gap-1">
            <button x-on:click="showModalProduct = false" class="bg-gray-200 text-gray-700 hover:bg-gray-300 duration-200  xxx px-4 py-3 h-10 xxx  rounded-lg font-medium text-xs cursor-pointer">
                ปิด
            </button>

            <button
                x-on:click="
                    let items = JSON.parse(localStorage.getItem('cartItem')) || [];
                    items.push({ product, size, type, topping, optionPrice, amount });
                    localStorage.setItem('cartItem', JSON.stringify(items));

                    showModalProduct = false;
                    $store.cart.data = JSON.parse(localStorage.getItem('cartItem')) || [];
                    $store.alertMessage.message = '<span class=\'text-green-700\'>เพิ่มแล้ว</span>';
                    $store.alert.showAlert = true;
                "
                class="bg-blue-500 text-white hover:bg-blue-600 duration-200  xxx px-4 py-3 h-10 xxx  rounded-lg font-medium text-xs cursor-pointer flex items-center justify-center min-w-[80px]"
            >
                ตกลง
            </button>
        </div>
    </div>
</div>
