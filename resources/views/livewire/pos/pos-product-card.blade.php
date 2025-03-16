<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
    @foreach($products as $product)
        <div
            x-data
            x-on:click="showModalProduct = true; $wire.call('product', {{ $product->id }})"
            class="border rounded-lg p-4 shadow-sm hover:border-blue-500 transition duration-200 bg-white cursor-pointer"
        >
            <img
                class="w-[50%] mx-auto md:h-40 object-cover rounded-lg"
                src="{{ asset("storage/product-images/{$product->image}") }}"
                alt="pos product"
            >
            <div class="text-center mt-3 font-medium text-gray-700">
                {{ $product->name }}
            </div>
            <div class="text-center mt-1">
                <strong class="text-green-600 text-lg">
                    {{ number_format($product->price ?? 0, 0) }}
                </strong>
            </div>
        </div>
    @endforeach
</div>
