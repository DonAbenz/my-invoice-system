<div>
    <div class="px-4 py-5 sm:px-6 lg:px-8">
        <div class="sm:flex items-center">
            <div class="sm:flex-auto">
                <h1 class="text-2xl font-semibold leading-6 text-gray-900">Invoice</h1>
            </div>
            {{-- <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <button type="button"
                    class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Print</button>
            </div> --}}
        </div>
        <div class="mt-8 sm:flex items-start justify-between">
            <div class="sm:flex-auto">
                <h1 class="text-lg font-semibold leading-6 text-gray-900"># {{ $invoice->code }}</h1>
            </div>
            <div class="flex flex-col mt-4 sm:ml-16 sm:mt-0 text-right">
                <span>{{ \Carbon\Carbon::parse($invoice->created_at)->toFormattedDateString() }}</span>
                <span>{{ ucwords($invoice->customer_name) }}</span>
            </div>
        </div>
        <div class="-mx-4 mt-8 flow-root sm:mx-0">
            <table class="min-w-full">
                <colgroup>
                    <col class="w-full sm:w-1/2">
                    <col class="sm:w-1/6">
                    <col class="sm:w-1/6">
                    <col class="sm:w-1/6">
                </colgroup>
                <thead class="border-b border-gray-300 text-gray-900">
                    <tr>
                        <th scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                            Product</th>
                        <th scope="col"
                            class="hidden px-3 py-3.5 text-right text-sm font-semibold text-gray-900 sm:table-cell">
                            Price
                        </th>
                        <th scope="col"
                            class="hidden px-3 py-3.5 text-right text-sm font-semibold text-gray-900 sm:table-cell">
                            Quantity
                        </th>
                        <th scope="col"
                            class="py-3.5 pl-3 pr-4 text-right text-sm font-semibold text-gray-900 sm:pr-0">
                            Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoice->invoiceItems as $item)
                        <tr class="border-b border-gray-200">
                            <td class="max-w-0 py-5 pl-4 pr-3 text-sm sm:pl-0">
                                <div class="font-medium text-gray-900">{{ $item->product->name }}</div>
                                {{-- <div class="mt-1 truncate text-gray-500">New logo and digital asset playbook.</div> --}}
                            </td>
                            <td class="hidden px-3 py-5 text-right text-sm text-gray-500 sm:table-cell">
                                {{ (new NumberFormatter('en_US', NumberFormatter::CURRENCY))->formatCurrency($item->price, 'USD') }}
                            </td>
                            <td class="hidden px-3 py-5 text-right text-sm text-gray-500 sm:table-cell">
                                {{ $item->quantity }} x
                            </td>
                            <td class="py-5 pl-3 pr-4 text-right text-sm text-gray-500 sm:pr-0">
                                {{ (new NumberFormatter('en_US', NumberFormatter::CURRENCY))->formatCurrency($item->total, 'USD') }}
                            </td>
                        </tr>
                    @endforeach

                    <!-- More projects... -->
                </tbody>
                <tfoot>
                    <tr>
                        <th scope="row" colspan="3"
                            class="hidden pl-4 pr-3 pt-4 text-right text-xl font-semibold text-gray-900 sm:table-cell sm:pl-0">
                            Total</th>
                        <th scope="row"
                            class="pl-6 pr-3 pt-4 text-left text-xl font-semibold text-gray-900 sm:hidden">
                            Total</th>
                        <td class="pl-3 pr-4 pt-4 text-right text-xl font-semibold text-gray-900 sm:pr-0">
                            {{ (new NumberFormatter('en_US', NumberFormatter::CURRENCY))->formatCurrency($invoice->invoiceItems->sum('total'), 'USD') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>
