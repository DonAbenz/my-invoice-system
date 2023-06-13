<div>
    <div class="mx-auto max-w-2xl px-4 py-14 sm:px-6 lg:max-w-7xl lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
            {{ $action == 'edit' ? 'Edit Invoice' : 'Create Invoice' }} <span
                class="text-lg ml-2">{{ $invoice->code ?? '' }}</span></h1>
        <p class="mt-2">Please fill in the information below. The field labels marked with <span
                class="text-rose-500">*</span> are required input fields.
        </p>
        <form wire:submit.prevent="{{ $action == 'edit' ? 'update' : 'store' }}" class="md:col-span-2 mt-4 justify-center">
            <div class="grid grid-cols-1 gap-x-2 gap-y-4 sm:grid-cols-12">
                {{-- <div class="col-span-full flex items-center gap-x-8">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                        alt="" class="h-24 w-24 flex-none rounded-lg bg-gray-800 object-cover">
                    <div>
                        <button type="button"
                            class="block rounded-md bg-[#4F4537] px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-[#4F4537] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#4F4537]">Change
                            avatar</button>
                        <p class="mt-2 text-xs leading-5 text-gray-400">JPG, GIF or PNG. 1MB max.</p>
                    </div>
                </div> --}}

                <div class="col-span-full">
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">
                        Name <span class="text-rose-500">*</span>
                    </label>
                    {{-- <sub>Provide user code if you want send code to your memebers</sub> --}}
                    <div class="relative mt-2 rounded-md shadow-sm">
                        <input type="text" wire:model.debounce.300ms="name" name="name" id="name"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#4F4537] sm:text-sm sm:leading-6"
                            placeholder="">
                    </div>

                    @error('name')
                        <span class="text-sm text-[#C1554D]">{{ $message }}</span>
                    @enderror
                </div>
                {{-- product list --}}
                <div class="col-span-full">
                    <h2 id="cart-heading" class="sr-only">Product Items</h2>

                    <div x-data="Components.menu({ open: false })" x-init="init()"
                        @keydown.escape.stop="open = false; focusButton()" @click.away="onClickAway($event)">
                        <label id="listbox-label" class="block text-sm font-medium leading-6 text-gray-900">
                            Product Items <span class="text-rose-500">*</span>
                            @error('items')
                                <span class="pl-5 font-normal text-sm text-[#C1554D]">{{ $message }}</span>
                            @enderror
                        </label>
                        <div class="relative mt-2">
                            <button type="button" @click="open = true"
                                class="relative w-full cursor-pointer rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-[#4F4537] sm:text-sm sm:leading-6"
                                aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
                                <span class="flex items-center">
                                    {{-- <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    alt="" class="h-5 w-5 flex-shrink-0 rounded-full"> --}}
                                    <svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                                    </svg>

                                    <span class="ml-3 block truncate text-gray-500">Please add product to list</span>
                                </span>
                                <span
                                    class="pointer-events-none absolute inset-y-0 right-0 ml-3 flex items-center pr-2">
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </button>

                            <ul x-cloak x-show="open" x-transition:leave="transition ease-in duration-100"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                class="absolute z-10 mt-1 max-h-52 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                                tabindex="-1" role="listbox" aria-labelledby="listbox-label"
                                aria-activedescendant="listbox-option-3">

                                @foreach ($products as $product)
                                    <livewire:invoice.product-component :product='$product'
                                        wire:key="{{ time() }}" />
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-span-full">
                    @if ($content->count() > 0)
                        <ul role="list" class="mt-4 divide-y divide-gray-200 border-b border-t border-gray-200">
                            @foreach ($content as $id => $item)
                                <li class="flex py-3" wire:key="{{ $id . time() }}">
                                    {{-- <div class="flex-shrink-0">
                                    <img src="https://tailwindui.com/img/ecommerce-images/shopping-cart-page-01-product-01.jpg"
                                        alt="Front of men&#039;s Basic Tee in sienna."
                                        class="h-24 w-24 rounded-md object-cover object-center sm:h-48 sm:w-48">
                                </div> --}}

                                    <div class="ml-4 flex flex-1 flex-col justify-between sm:ml-6">
                                        <div class="relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0">
                                            <div>
                                                <div class="flex justify-between">
                                                    <h3 class="text-sm">
                                                        <a href="#"
                                                            class="font-medium text-gray-700 hover:text-gray-800">
                                                            {{ $item['name'] }}
                                                        </a>
                                                    </h3>
                                                </div>
                                                <div class="mt-1 flex text-sm">
                                                    <p class="text-gray-600">Price</p>
                                                    <p class="ml-4 border-l border-gray-200 pl-4 text-gray-500">
                                                        {{ (new NumberFormatter('en_US', NumberFormatter::CURRENCY))->formatCurrency($item['price'], 'USD') }}
                                                    </p>
                                                </div>
                                                <div class="mt-1 flex text-sm">
                                                    <p class="text-gray-600">Subtotal</p>
                                                    <p class="ml-4 border-l border-gray-200 pl-4 text-gray-500">
                                                        {{ (new NumberFormatter('en_US', NumberFormatter::CURRENCY))->formatCurrency($item['price'] * $item['quantity'], 'USD') }}
                                                    </p>
                                                </div>
                                                {{-- <p class="mt-1 text-sm font-medium text-gray-900">PHP
                                                {{ $item['price'] }}</p> --}}
                                            </div>

                                            <div class="mt-4 sm:mt-0 sm:pr-9">
                                                <label for="quantity-0" class="sr-only">{{ $item['name'] }}</label>

                                                <input type="number" step="1" min="1"
                                                    wire:model="cartQtys.{{ $item['id'] }}"
                                                    class="max-w-full rounded-md border border-gray-300 py-1.5 text-left text-base font-medium leading-5 text-gray-700 shadow-sm focus:border-[#4F4537] focus:outline-none focus:ring-1 focus:ring-[#4F4537] sm:text-sm"
                                                    name="" id="" placeholder="0">

                                                <div class="absolute right-0 top-0">
                                                    <button type="button"
                                                        wire:click="removeFromCart('{{ $id }}')"
                                                        class="-m-2 inline-flex p-2 text-gray-400 hover:text-gray-500">
                                                        <span class="sr-only">Remove</span>
                                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                                            aria-hidden="true">
                                                            <path
                                                                d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <p class="mt-4 flex space-x-2 text-sm text-gray-700">
                                        <svg class="h-5 w-5 flex-shrink-0 text-green-500" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span>In stock</span>
                                    </p> --}}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="flex flex-col items-center">
                            <lottie-player src="https://assets1.lottiefiles.com/private_files/lf30_e3pteeho.json"
                                background="transparent" speed="1" style="width: 200px; height: 200px;" loop
                                autoplay>
                            </lottie-player>
                            <span class="text-xl font-semibold"></span>
                        </div>
                    @endif
                </div>

                {{-- password --}}
                <div class="col-span-full">
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">
                        Password <span class="text-rose-500">*</span>
                    </label>
                    <sub>For security, please confirm your password to continue.</sub>
                    <div class="relative mt-2 rounded-md shadow-sm">
                        <input type="password" wire:model.debounce.300ms="password" name="password" id="password"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#4F4537] sm:text-sm sm:leading-6"
                            placeholder="&#8226; &#8226; &#8226; &#8226; &#8226; &#8226; &#8226;">
                    </div>

                    @error('password')
                        <span class="text-sm text-[#C1554D]">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mt-8 flex">
                <button type="submit" wire:loading.attr="disabled"
                    class="disabled:cursor-not-allowed flex w-full justify-center rounded-md bg-[#1B3B31] px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-[#EABD5E] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#1B3B31]">
                    {{ $action == 'edit' ? 'Save' : 'Create' }}
                </button>
            </div>
        </form>
    </div>
</div>
