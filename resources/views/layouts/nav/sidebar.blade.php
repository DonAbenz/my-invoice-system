<div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6 pb-4">
    <div class="flex h-16 shrink-0 items-center">
        {{-- <img class="h-50 w-auto" src="{{ asset('images/logos/PRIME WORLDWIDE v1FE-03.png') }}" alt="Your Company"> --}}
        <span class="text-2xl">Invoice System</span>
    </div>
    <nav class="flex flex-1 flex-col">
        <ul role="list" class="flex flex-1 flex-col gap-y-7">
            <li>
                <ul role="list" class="-mx-2 space-y-1">

                    <li>
                        <a href="{{ route('invoices') }}"
                            :class="{
                                'bg-[#DFE0DF] text-[#231f20]': routeName == 'invoices',
                                'text-gray-700 hover:text-[#231f20] hover:bg-[#DFE0DF]': routeName !=
                                    'invoices',
                            }"
                            class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold"
                            x-state-description="undefined: &quot;bg-[#DFE0DF] text-[#231f20]&quot;, undefined: &quot;text-gray-700 hover:text-[#231f20] hover:bg-[#DFE0DF]&quot;">
                            <svg :class="{
                                'text-[#231f20]': routeName == 'invoices',
                                'text-gray-400 group-hover:text-[#231f20]': routeName != 'invoices',
                            }"
                                class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>

                            Invoices
                        </a>
                    </li>
                </ul>
            </li>
            {{-- <li>
                <div class="text-xs font-semibold leading-6 text-gray-400">Your teams</div>
                <ul role="list" class="-mx-2 mt-2 space-y-1">

                    <li>
                        <a href="#"
                            class="text-gray-700 hover:text-indigo-600 hover:bg-[#DFE0DF] group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold"
                            x-state:on="Current" x-state:off="Default"
                            x-state-description="Current: &quot;bg-[#DFE0DF] text-indigo-600&quot;, Default: &quot;text-gray-700 hover:text-indigo-600 hover:bg-[#DFE0DF]&quot;">
                            <span
                                class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border text-[0.625rem] font-medium bg-white text-gray-400 border-gray-200 group-hover:border-indigo-600 group-hover:text-indigo-600">H</span>
                            <span class="truncate">Heroicons</span>
                        </a>
                    </li>

                    <li>
                        <a href="#"
                            class="text-gray-700 hover:text-indigo-600 hover:bg-[#DFE0DF] group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold"
                            x-state-description="undefined: &quot;bg-[#DFE0DF] text-indigo-600&quot;, undefined: &quot;text-gray-700 hover:text-indigo-600 hover:bg-[#DFE0DF]&quot;">
                            <span
                                class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border text-[0.625rem] font-medium bg-white text-gray-400 border-gray-200 group-hover:border-indigo-600 group-hover:text-indigo-600">T</span>
                            <span class="truncate">Tailwind Labs</span>
                        </a>
                    </li>

                    <li>
                        <a href="#"
                            class="text-gray-700 hover:text-indigo-600 hover:bg-[#DFE0DF] group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold"
                            x-state-description="undefined: &quot;bg-[#DFE0DF] text-indigo-600&quot;, undefined: &quot;text-gray-700 hover:text-indigo-600 hover:bg-[#DFE0DF]&quot;">
                            <span
                                class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border text-[0.625rem] font-medium bg-white text-gray-400 border-gray-200 group-hover:border-indigo-600 group-hover:text-indigo-600">W</span>
                            <span class="truncate">Workcation</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="mt-auto">
                <a href="#"
                    class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-[#DFE0DF] hover:text-indigo-600">
                    <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                        </path>
                    </svg>
                    Settings
                </a>
            </li> --}}
        </ul>
    </nav>
</div>
