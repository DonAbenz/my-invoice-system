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
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <button wire:click="$emit('openModal', 'invoice.post-modal', {{ json_encode(['action' => 'add']) }})"
                        class="block rounded-md bg-[#4F4537] px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-[#4F4537] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#4F4537]">
                        <div class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>


                            <span>Create Invoice</span>
                        </div>
                    </button>
                </div>
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
                            placeholder="Invoice Number | Customer Name">
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
                                Invoice Number</th>
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
                                        <p>{{ $item->score }}</p>
                                    </td>
                                    <td
                                        class="relative py-3 pl-4 pr-3 text-sm {{ $key > 0 ? 'border-t border-gray-200' : '' }}">
                                        {{ (new NumberFormatter('en_US', NumberFormatter::CURRENCY))->formatCurrency($item->invoiceItems->sum('total'), 'USD') }}
                                    </td>
                                    <td
                                        class="relative py-2 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 {{ $key > 0 ? 'border-t border-transparent' : '' }}">
                                        <button type="button"
                                            wire:click="$emit('openModal', 'invoice.post-modal', {{ json_encode(['invoice' => $item->code, 'action' => 'edit']) }})"
                                            class="inline-flex items-center text-sm font-semibold text-gray-900 disabled:cursor-not-allowed disabled:opacity-30">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>


                                            <span class="sr-only">Edit</span>
                                        </button>

                                        <button type="button"
                                            wire:click="confirmDelete('{{ $item->code }}')"
                                            class="ml-3 inline-flex items-center text-sm font-semibold text-gray-900 disabled:cursor-not-allowed disabled:opacity-30">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>



                                            <span class="sr-only">Delete</span>
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
