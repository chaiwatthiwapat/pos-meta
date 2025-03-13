<div class="grid grid-cols-5 gap-3">
    @foreach($products as $product)
        <div x-data x-on:click="showModalProduct = true; $wire.call('productModal', {{ $product->id }})" class="border rounded p-3 hover:border-blue-500 duration-150 cursor-pointer">
            <img class="w-1/2 aspect-square object-cover mx-auto" src="{{ asset("storage/product-images/{$product->image}") }}" alt="pos product">
            <div class="text-center mt-2">
                {{ $product->name }}
            </div>
            <div class="text-center">
                <strong class="text-green-500">
                    {{ number_format($product->price ?? 0, 0) }}
                </strong>
            </div>
        </div>
    @endforeach
</div>
