<div class="flex-1">
    @php use App\Traits\Set; @endphp

    <div class="lg:w-fit">
        <div class="mb-4">
            {{ $products->links('components.paginate') }}
        </div>

        <div class="h-[60vh]">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-3 2xl:grid-cols-5 gap-4 items-start max-h-[100%] overflow-auto">
                @foreach($products as $product)
                    <div
                        x-data
                        x-on:click="
                            showModalProduct = true;
                            $wire.call('product', {{ $product->id }});
                            $wire.dispatch('refresh-options');
                        "
                        class="border border-gray-200  rounded-lg p-2 lg:p-4 shadow-xs hover:border-blue-500 transition duration-200 bg-white cursor-pointer"
                    >
                        <img
                            class="w-20 h-20 lg:w-28 lg:h-28 mx-auto object-cover rounded-lg"
                            src="{{ asset("storage/product-images/{$product->image}") }}"
                            alt="pos product"
                        >
                        <div class="text-center mt-3 font-medium text-gray-700 text-sm">
                            {{ Set::textLimit($product->name, 20, '...') }}
                        </div>
                        <div class="text-center lg:mt-1">
                            <strong class="text-green-600 text-sm">
                                {{ number_format($product->price ?? 0, 0) }}
                            </strong>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

        <div class="mt-4 lg:hidden">
            <button x-on:click="showCart = true" class="bg-blue-500 text-white hover:bg-blue-600 duration-200 px-4 py-2 rounded-lg font-medium cursor-pointer flex items-center justify-center w-full">
                ตะกร้า
            </button>
        </div>
    </div>
</div>
