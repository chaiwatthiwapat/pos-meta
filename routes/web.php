<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AdminStaffMiddleware;
use App\Http\Middleware\NoAuthMiddleware;
use App\Livewire\Auth\Login;
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


Route::get('/', fn() => redirect()->route('login'))->middleware(NoAuthMiddleware::class);
Route::get('/login', Login::class)->name('login')->middleware(NoAuthMiddleware::class);
Route::get('/logout', [Login::class, 'logout'])->name('logout');
Route::get('/home', HomeIndex::class)->name('home.index')->middleware(AdminStaffMiddleware::class);
Route::get('/pos', PosIndex::class)->name('pos.index')->middleware(AdminStaffMiddleware::class);
Route::get('/orders', OrdersIndex::class)->name('orders.index')->middleware(AdminStaffMiddleware::class);
Route::get('/product', ProductIndex::class)->name('product.index')->middleware(AdminMiddleware::class);
Route::get('/size', SizeIndex::class)->name('size.index')->middleware(AdminMiddleware::class);
Route::get('/type', TypeIndex::class)->name('type.index')->middleware(AdminMiddleware::class);
Route::get('/topping', ToppingIndex::class)->name('topping.index')->middleware(AdminMiddleware::class);
Route::get('/users', UserIndex::class)->name('users.index')->middleware(AdminMiddleware::class);

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
