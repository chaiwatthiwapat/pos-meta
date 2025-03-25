@php
    if(!isset($scrollTo)) {
        $scrollTo = 'body';
    }

    $scrollIntoViewJsSnippet = '';

    if($scrollTo !== false) {
        $scrollIntoViewJsSnippet = <<<JS
            (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
        JS;
    }
@endphp

<div>
    @if($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">

            {{-- จอเล็ก --}}
            <div class="flex justify-between flex-1 sm:hidden">
                <span>
                    @if($paginator->onFirstPage())
                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-blue-500 bg-white border border-gray-200  border-gray-300 cursor-default leading-5 rounded-md dark:bg-gray-800 dark:border-gray-600 dark:text-blue-300 dark:focus:border-blue-500 dark:active:bg-gray-700 dark:active:text-blue-300">
                            {!! __('pagination.previous') !!}
                        </span>
                    @else
                        <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before" class="cursor-pointer relative inline-flex items-center px-4 py-2 text-sm font-medium text-blue-500 bg-white border border-gray-200  border-gray-300 leading-5 rounded-md hover:text-blue-500 focus:outline-hidden focus:ring ring-blue-300 focus:border-blue-300 active:bg-gray-100 active:text-blue-500 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-blue-300 dark:focus:border-blue-500 dark:active:bg-gray-700 dark:active:text-blue-300">
                            {!! __('pagination.previous') !!}
                        </button>
                    @endif
                </span>

                <span>
                    @if($paginator->hasMorePages())
                        <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before" class="cursor-pointer relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-blue-500 bg-white border border-gray-200  border-gray-300 leading-5 rounded-md hover:text-blue-500 focus:outline-hidden focus:ring ring-blue-300 focus:border-blue-300 active:bg-gray-100 active:text-blue-500 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-blue-300 dark:focus:border-blue-500 dark:active:bg-gray-700 dark:active:text-blue-300">
                            {!! __('pagination.next') !!}
                        </button>
                    @else
                        <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-blue-500 bg-white border border-gray-200  border-gray-300 cursor-default leading-5 rounded-md dark:text-blue-600 dark:bg-gray-800 dark:border-gray-600">
                            {!! __('pagination.next') !!}
                        </span>
                    @endif
                </span>
            </div>

            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-blue-500 leading-5 dark:text-blue-400">
                        <span>แสดง</span>
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        <span>ถึง</span>
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                        <span>จากทั้งหมด</span>
                        <span class="font-medium">{{ $paginator->total() }}</span>
                    </p>
                </div>

                <div>
                    <span class="relative z-0 inline-flex rtl:flex-row-reverse rounded-md shadow-xs">
                        <span>
                            {{-- ก่อนหน้า --}}
                            @if($paginator->onFirstPage())
                                <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                                    <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-blue-500 bg-white border border-gray-200  border-gray-300 cursor-default rounded-l-md leading-5 dark:bg-gray-800 dark:border-gray-600" aria-hidden="true">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </span>
                            @else
                                <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after" class="cursor-pointer relative inline-flex items-center px-2 py-2 text-sm font-medium text-blue-500 bg-white border border-gray-200  border-gray-300 rounded-l-md leading-5 hover:text-blue-400 focus:z-10 focus:outline-hidden focus:border-blue-300 focus:ring ring-blue-300 active:bg-gray-100 active:text-blue-500 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="{{ __('pagination.previous') }}">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            @endif
                        </span>

                        {{-- กลุ่มตัวเลข --}}
                        @foreach ($elements as $element)
                            {{-- ... --}}
                            @if(is_string($element))
                                <span aria-disabled="true">
                                    <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-blue-500 bg-white border border-gray-200  border-gray-300 cursor-default leading-5 dark:bg-gray-800 dark:border-gray-600 dark:text-blue-300">{{ $element }}</span>
                                </span>
                            @endif

                            {{-- ตัวเลข --}}
                            @if(is_array($element))
                                @foreach ($element as $page => $url)
                                    <span wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">
                                        @if($page == $paginator->currentPage())
                                            <span aria-current="page">
                                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-blue-500 border border-gray-200  border-blue-500 cursor-default leading-5 dark:bg-gray-800 dark:border-gray-600">{{ $page }}</span>
                                            </span>
                                        @else
                                            <button type="button" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" class="cursor-pointer relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-blue-500 bg-white border border-gray-200  border-gray-300 leading-5 hover:text-blue-500 focus:z-10 focus:outline-hidden focus:border-blue-300 focus:ring ring-blue-300 active:bg-gray-100 active:text-blue-500 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-blue-400 dark:hover:text-blue-300 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                                {{ $page }}
                                            </button>
                                        @endif
                                    </span>
                                @endforeach
                            @endif
                        @endforeach

                        <span>
                            @if($paginator->hasMorePages())
                                <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after" class="cursor-pointer relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-blue-500 bg-white border border-gray-200  border-gray-300 rounded-r-md leading-5 hover:text-blue-400 focus:z-10 focus:outline-hidden focus:border-blue-300 focus:ring ring-blue-300 active:bg-gray-100 active:text-blue-500 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="{{ __('pagination.next') }}">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            @else
                                <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                                    <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-blue-500 bg-white border border-gray-200  border-gray-300 cursor-default rounded-r-md leading-5 dark:bg-gray-800 dark:border-gray-600" aria-hidden="true">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </span>
                            @endif
                        </span>

                    </span>
                </div>
            </div>
        </nav>
    @endif
</div>
