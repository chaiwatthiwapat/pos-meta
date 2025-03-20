<?php

use App\Livewire\Home\HomeIndex;
use App\Livewire\Orders\OrdersIndex;
use App\Livewire\Pos\PosIndex;
use App\Livewire\Product\ProductIndex;
use App\Livewire\Size\SizeIndex;
use App\Livewire\Topping\ToppingIndex;
use App\Livewire\Type\TypeIndex;
use App\Livewire\User\UserIndex;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeIndex::class)->name('home.index');
Route::get('/pos', PosIndex::class)->name('pos.index');
Route::get('/orders', OrdersIndex::class)->name('orders.index');
Route::get('/product', ProductIndex::class)->name('product.index');
Route::get('/size', SizeIndex::class)->name('size.index');
Route::get('/type', TypeIndex::class)->name('type.index');
Route::get('/topping', ToppingIndex::class)->name('topping.index');
Route::get('/users', UserIndex::class)->name('users.index');

Route::get('/storage-link', function () {
    $storagePath = storage_path('app/public');
    $rootStorage = $_SERVER['DOCUMENT_ROOT'] . '/storage';

    if(symlink($storagePath, $rootStorage)) {
        echo "Storage link.";
    }
    else {
        echo "Error.";
    }
});

Route::get('storage-unlink', function () {
    $rootStorage = "$_SERVER[DOCUMENT_ROOT]/storage";

    if(file_exists($rootStorage)) {
        unlink($rootStorage);
        echo "Storage unlink.";
    }
    else {
        echo "Error.";
    }
});

Route::get('/getpassword/{password}', fn($password) => Hash::make($password));
