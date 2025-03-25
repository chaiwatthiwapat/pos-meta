<div
    x-data="{
        amount: 0,
        get_money: 0,
        addMoney(value) {
            this.get_money += value;
        },
        clearMoney() {
            this.get_money = 0;
        },
        get change_money() {
            return this.get_money - this.amount;
        }
    }"
    x-init="$store.payment = $data"
    x-show="showPaymentModal"
    x-on:hidden-payment.window="
        showPaymentModal = false,
        get_money = 0;
        change_money = 0;
    "
    class="fixed inset-0 bg-black/50 flex items-center justify-center z-[2100]"
    style="display: none;"
>
    <div class="bg-white w-full max-w-md p-6 rounded-xl">
        <h2 class="text-xl font-bold mb-4">จ่ายเงิน</h2>

        <div class="mb-4 bg-blue-100 p-4 rounded-lg">
            <div class="text-blue-500 flex">
                <div class="w-28">ยอดที่ต้องชำระ: </div>
                <div class="text-red-500 w-16 text-end font-bold" x-text="amount.toLocaleString()"></div>
            </div>
            <div class="text-blue-500 flex">
                <div class="w-28">ลูกค้าจ่าย: </div>
                <div class="text-blue-500 w-16 text-end font-bold" x-text="get_money.toLocaleString()"></div>
            </div>
            <div class="text-blue-500 flex">
                <div class="w-28">เงินทอน: </div>
                <div class="text-green-500 w-16 text-end font-bold" x-text="change_money < 1 ? 0 : change_money.toLocaleString()"></div>
            </div>
        </div>

        <div class="grid grid-cols-4 gap-2 mb-4">
            <template x-for="note in [1000, 500, 100, 50, 20, 10, 5, 1]" :key="note">
                <button
                    x-on:click="addMoney(note)"
                    class="bg-blue-100 text-blue-500 rounded-xl p-2 shadow-lg font-bold"
                    x-text="note.toLocaleString()"
                ></button>
            </template>
        </div>

        <div class="flex justify-between mt-4">
            <button x-on:click="clearMoney()" type="button"
                class="bg-red-100 text-red-500 hover:bg-red-200 duration-200  xxx px-4 py-3 h-10 xxx  rounded-lg font-medium text-xs cursor-pointer">
                ล้าง
            </button> 

            <div class="flex gap-2">
                <button type="button" x-on:click="showPaymentModal = false"
                    class="bg-gray-200 text-gray-700 hover:bg-gray-300 duration-200  xxx px-4 py-3 h-10 xxx  rounded-lg font-medium text-xs cursor-pointer">
                    ปิด
                </button>

                <button
                    x-on:click="
                        if(get_money >= amount) {
                            let items = JSON.parse(localStorage.getItem('cartItem'));
                            items ? $wire.call('ordersInsert', items, { get_money, change_money }) : null;
                        }
                        else {
                            $store.alertMessage.message = '<span class=\'text-red-700\'>จำนวนเงินไม่ถูกต้อง</span>';
                            $store.alert.showAlert = true;
                        }
                    "
                    type="button" wire:loading.attr="disabled"
                    class="bg-blue-500 text-white hover:bg-blue-600 duration-200  xxx px-4 py-3 h-10 xxx  rounded-lg font-medium text-xs cursor-pointer flex items-center justify-center min-w-[80px]">
                    {{--  --}}
                    <span wire:loading.class="hidden">ตกลง</span>
                    <div wire:loading class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                </button>
            </div>
        </div>
    </div>
</div>
