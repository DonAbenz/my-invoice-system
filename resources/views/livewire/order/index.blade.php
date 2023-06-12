<div>
    <div>
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-lg font-semibold leading-6 text-gray-900">Invoices</h1>
                    {{-- <p class="mt-2 text-sm text-gray-700">Your team is on the <strong
                            class="font-semibold text-gray-900">Startup</strong> plan. The next payment of $80 will be due on
                        August 4, 2022.</p> --}}
                </div>
                {{-- <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <a type="button" href="{{ route('orders.create') }}"
                        class="block rounded-md bg-[#4F4537] px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-[#4F4537] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#4F4537]">
                        <div class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                            </svg>


                            <span>Order Sale</span>
                        </div>
                    </a>
                </div> --}}
            </div>
            <div class="mt-4 sm:flex gap-2 sm:items-end">
                <div class="flex-initial sm:w-[20rem]">
                    <label for="search" class="text-xs font-semibold ml-1">Search</label>
                    <div class="relative rounded-md">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <!-- Heroicon name: solid/search -->
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input wire:model="searchTerm" type="search" name="search" id="search"
                            class="focus:ring-[#4F4537] focus:border-[#4F4537] block w-full pl-10 sm:text-sm border-gray-300 rounded-md"
                            placeholder="Code | Name">
                    </div>
                </div>
            </div>
            <div class="-mx-4 mt-5 ring-1 ring-gray-300 sm:mx-0 sm:rounded-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                        <tr>
                            <th scope="col"
                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                Date Created</th>
                            <th scope="col"
                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                Code</th>
                            <th scope="col"
                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                Customer Name</th>
                            <th scope="col" class="pl-4 pr-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                Total
                            </th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                <span class="sr-only">Select</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($results->first())
                            @foreach ($results as $key => $item)
                                <tr>
                                    <td
                                        class="relative whitespace-nowrap py-2 pl-4 pr-3 text-sm text-gray-500 sm:pl-6 {{ $key > 0 ? 'border-t border-transparent' : '' }}">
                                        {{ \Carbon\Carbon::parse($item->created_at)->toFormattedDateString() }}
                                        @if ($key > 0)
                                            <div class="absolute -top-px left-6 right-0 h-px bg-gray-200"></div>
                                        @endif
                                    </td>
                                    <td
                                        class="relative py-3 pl-4 pr-3 text-sm sm:pl-6 {{ $key > 0 ? 'border-t border-gray-200' : '' }}">
                                        <div class="font-medium text-gray-500">
                                            {{ $item->code }}
                                        </div>
                                    </td>
                                    <td
                                        class="relative py-3 pl-4 pr-3 text-sm sm:pl-6 {{ $key > 0 ? 'border-t border-gray-200' : '' }}">
                                        <div class="font-medium text-gray-500">
                                            {{ $item->customer_name }}
                                        </div>
                                    </td>
                                    <td
                                        class="relative py-3 pl-4 pr-3 text-sm {{ $key > 0 ? 'border-t border-gray-200' : '' }}">
                                        {{ (new NumberFormatter('en_US', NumberFormatter::CURRENCY))->formatCurrency($item->invoiceItems->sum('total'), 'USD') }}
                                    </td>
                                    <td
                                        class="relative py-2 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 {{ $key > 0 ? 'border-t border-transparent' : '' }}">
                                        <button type="button"
                                            wire:click="$emit('openModal', 'admin.orders.show', {{ json_encode(['order' => $item->code]) }})"
                                            class="inline-flex items-center text-sm font-semibold text-gray-900 disabled:cursor-not-allowed disabled:opacity-30">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                            </svg>

                                            <span class="sr-only">Show</span>
                                        </button>
                                        @if ($key > 0)
                                            <div class="absolute -top-px left-0 right-6 h-px bg-gray-200"></div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            @include('layouts.errors.no-data')
                        @endif
                        <!-- More plans... -->
                    </tbody>
                </table>

            </div>
            {{ $results->links('layouts.nav.pagination-livewire') }}
        </div>

    </div>

</div>
