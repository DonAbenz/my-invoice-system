<div>

    {{-- Select option, manage highlight styles based on mouseenter/mouseleave and keyboard navigation.
    Highlighted: "", Not Highlighted: "text-gray-900" --}}

    <li @click="open = false" wire:click="addToCart"
        class="group cursor-pointer text-gray-900 hover:bg-[#4F4537] hover:text-white relative cursor-default select-none py-2 pl-3 pr-9"
        id="listbox-option-0" role="option">
        <div class="flex items-center">
            {{-- <img src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                alt="" class="h-5 w-5 flex-shrink-0 rounded-full"> --}}
            {{-- Selected: "font-semibold", Not Selected: "font-normal" --}}
            <span class="font-normal ml-3 block truncate">{{ $product->name }}</span>
        </div>

        {{-- Checkmark, only display for selected option.
        Highlighted: "text-white", Not Highlighted: "text-indigo-600" --}}

        <span class="text-gray-900 group-hover:text-white absolute inset-y-0 right-0 flex items-center pr-4">
            {{-- <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                    d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                    clip-rule="evenodd" />
            </svg> --}}
            {{ (new NumberFormatter('en_US', NumberFormatter::CURRENCY))->formatCurrency($product->price, 'USD') }}
        </span>
    </li>
</div>
