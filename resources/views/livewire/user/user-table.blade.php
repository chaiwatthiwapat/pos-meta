<div>
    @php use App\Traits\Set; @endphp

    <div class="w-full max-h-[80vh] overflow-auto">
        <table x-data="{ showDecimal: false }" class="table-fixed w-full">
            <thead class="sticky top-0 z-[501]">
                <tr class="hover:bg-blue-50">
                    <th class="px-5 py-3 border-b-2 border-blue-200 bg-blue-100 text-blue-500 text-left font-semibold w-24">
                        <div class="w-fit">
                            <button x-on:click="showInsert = true; $wire.call('clearForm')"
                                class="bg-blue-500 text-white hover:bg-blue-600 duration-200 px-4 py-3 h-10 w-16 rounded-lg font-medium cursor-pointer text-xs">
                                เพิ่ม
                            </button>
                        </div>
                    </th>
                    <th class="px-5 py-3 border-b-2 border-blue-200 bg-blue-100 text-blue-500 text-center text-xs font-semibold w-32">
                        ภาพ
                    </th>
                    <th class="px-5 py-3 border-b-2 border-blue-200 bg-blue-100 text-blue-500 text-start text-xs font-semibold w-32">
                        ชื่อ
                    </th>
                    <th class="px-5 py-3 border-b-2 border-blue-200 bg-blue-100 text-blue-500 text-center text-xs font-semibold w-32">
                        หน้าที่
                    </th>
                    <th class="px-5 py-3 border-b-2 border-blue-200 bg-blue-100 text-blue-500 text-center text-xs font-semibold">
                        {{-- empty --}}
                    </th>
                    <th class="px-5 py-3 border-b-2 border-blue-200 bg-blue-100 text-blue-500 text-center text-xs font-semibold w-48">
                        {{-- actions --}}
                    </th>
                </tr>
            </thead>

            <tbody>

                @foreach($data as $row)
                    <tr class="hover:bg-blue-50">
                        <td class="px-5 py-3 border-b-2 border-blue-200 text-center text-xs font-semibold text-gray-700">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-5 py-3 border-b-2 border-blue-200 text-left text-xs font-semibold text-gray-700">
                            <img class="w-12 h-12 object-cover mx-auto" src="{{ asset('storage/user-images/' . ($row->image ?? 'default.png')) }}" alt="user">
                        </td>
                        <td class="px-5 py-3 border-b-2 border-blue-200 text-start text-xs font-semibold text-gray-700">
                            {{ Set::textLimit($row->name, 50, '...') }}
                        </td>
                        <td class="px-5 py-3 border-b-2 border-blue-200 text-xs font-semibold text-gray-700">
                            <div class="px-3 py-2 rounded-lg text-center flex items-center justify-center gap-1 {{ $row->role == 'admin' ? 'text-blue-500 bg-blue-100' : 'text-green-500  bg-green-100' }}">
                                @if($row->id == 1 || $row->id == 2)
                                    <div class="mb-[2px]">🔒</div>
                                @endif
                                {{ Set::textLimit($row->role, 50, '...') }}
                            </div>
                        </td>
                        <td class="px-5 py-3 border-b-2 border-blue-200 text-start text-xs font-semibold text-gray-700">
                            {{-- empty --}}
                        </td>
                        <td class="px-5 py-3 border-b-2 border-blue-200 text-center text-xs font-semibold text-gray-700">
                            <div class="flex justify-end gap-1">
                                @if($row->id == 1 || $row->id == 2)
                                    <button class="bg-blue-500 text-white hover:bg-blue-600 duration-200 px-4 py-3 h-10 w-16 rounded-lg font-medium text-xs opacity-50" disabled>
                                        แก้ไข
                                    </button>
                                    <button class="bg-red-500 text-white hover:bg-red-600 duration-200 px-4 py-3 h-10 w-16 rounded-lg font-medium text-xs opacity-50" disabled>
                                        ลบ
                                    </button>
                                @else
                                    <button x-on:click="showEdit = true; $wire.call('clearForm'); $wire.call('edit', {{ $row->id }})"
                                        class="bg-blue-500 text-white hover:bg-blue-600 duration-200 px-4 py-3 h-10 w-16 rounded-lg font-medium cursor-pointer text-xs">
                                        แก้ไข
                                    </button>
                                    <button x-on:click="showDelete = true; $store.delete.id = {{ $row->id }}"
                                        class="bg-red-500 text-white hover:bg-red-600 duration-200 px-4 py-3 h-10 w-16 rounded-lg font-medium cursor-pointer text-xs">
                                        ลบ
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $data->links('components.paginate') }}
    </div>
</div>
