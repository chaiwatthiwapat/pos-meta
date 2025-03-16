<div>
    <table x-data="{ showDecimal: false }" class="table-auto w-full">
        <thead class="sticky top-0 z-[1000]">
            <tr>
                <th class="px-5 py-3 border-b-2 border-blue-200 bg-blue-100 text-blue-700 text-left font-semibold w-fit">
                    <div class="w-fit">
                        <button x-on:click="showInsert = true; $wire.call('clearErrors'); $wire.call('clearForm');"
                            class="bg-blue-500 text-white hover:bg-blue-600 duration-200 px-5 py-3 rounded-lg font-medium flex items-center justify-center text-xs">
                            เพิ่ม
                        </button>
                    </div>
                </th>
                <th class="px-5 py-3 border-b-2 border-blue-200 bg-blue-100 text-blue-700 text-center text-xs font-semibold" style="width: 100px !important;">
                    ภาพ
                </th>
                <th class="px-5 py-3 border-b-2 border-blue-200 bg-blue-100 text-blue-700 text-start text-xs font-semibold" style="width: 200px !important;">
                    ผู้ใช้งาน
                </th>
                <th class="px-5 py-3 border-b-2 border-blue-200 bg-blue-100 text-blue-700 text-center text-xs font-semibold">
                    {{-- actions --}}
                </th>
            </tr>
        </thead>

        <tbody>

            @foreach($userData as $row)
                <tr>
                    <td class="w-[20px] px-5 py-3 border-b-2 border-blue-200 text-center text-xs font-semibold text-gray-700">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-5 py-3 border-b-2 border-blue-200 text-left text-xs font-semibold text-gray-700">
                        <img class="w-[50px] h-[50px] object-cover mx-auto" src="{{ asset('storage/user-images/' . ($row->image ?? 'default.png')) }}" alt="user">
                    </td>
                    <td class="px-5 py-3 border-b-2 border-blue-200 text-start text-xs font-semibold text-gray-700">
                        {{ Str::limit($row->name, 20, '...') }}
                    </td>
                    <td class="px-5 py-3 border-b-2 border-blue-200 text-center text-xs font-semibold text-gray-700">
                        <div class="flex justify-end gap-1">
                            <button x-on:click="showEdit = true; $wire.call('clearErrors'); $wire.call('clearForm'); $wire.call('edit', {{ $row->id }})"
                                class="bg-blue-500 text-white hover:bg-blue-600 duration-200 px-5 py-3 rounded-lg font-medium flex items-center justify-center">
                                แก้ไข
                            </button>
                            <button x-on:click="showDelete = true; $store.delete.id = {{ $row->id }}"
                                class="bg-red-500 text-white hover:bg-red-600 duration-200 px-5 py-3 rounded-lg font-medium flex items-center justify-center">
                                ลบ
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
