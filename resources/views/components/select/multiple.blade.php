@php
    $computed = $attributes->whereStartsWith('wire:model')->first();
    $error    = $errors->has($computed);
@endphp

<div x-data="tasteui_selectMultiple(@entangle($computed), @js($searchable), @js($selectable !== []), @js($selectable), @js($options), @js($placeholder))">
    @if ($label)
        <x-label :$label :$error />
    @endif
    <div class="relative mt-2" x-on:click.outside="show = false">
        <div @class([
                'flex w-full cursor-pointer items-center gap-x-2 rounded-md border-0 bg-white py-1.5 text-gray-900',
                'shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6',
                'text-red-600 ring-1 ring-inset ring-red-300 focus:ring-2 focus:ring-inset focus:ring-red-500' => $error,
            ])
             role="combobox"
             aria-controls="options"
             aria-expanded="false">
            <div x-on:click="show = true" class="relative inset-y-0 left-0 flex w-full items-center overflow-hidden rounded-lg pl-2 transition space-x-2">
                <div class="flex gap-2">
                    <template x-if="quantity === 0">
                        <span @class(['truncate font-medium', 'text-red-500' => $error]) x-bind:class="{ 'text-gray-400': empty }" x-text="placeholder"></span>
                    </template>
                    <template x-if="quantity > 0">
                        <span x-text="quantity"></span>
                    </template>
                    <template x-for="(selected, index) in selecteds" :key="selected[selectable.label] ?? selected">
                        <a href="#" class="cursor-pointer" x-on:click="clear(selected);">
                            <div class="inline-flex items-center rounded-lg bg-gray-100 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10 space-x-1">
                                <span x-text="selected[selectable.label] ?? selected"></span>
                                <x-icon icon="x-mark" class="h-4 w-4 transition text-gray-700 hover:text-red-500" />
                            </div>
                        </a>
                    </template>
                </div>
            </div>
            <div class="mr-1 flex items-center">
                <template x-if="!empty">
                    <button type="button" x-on:click="clear()">
                        <x-icon icon="x-mark" class="h-5 w-5 transition hover:text-red-500" />
                    </button>
                </template>
            </div>
        </div>
        <div class="relative">
            <ul wire:ignore x-show="show" class="absolute z-50 mt-1 max-h-60 w-full overflow-auto rounded-lg bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 soft-scrollbar focus:outline-none sm:text-sm" id="options" role="listbox">
                <template x-if="searchable">
                    <li class="m-2">
                        <x-input placeholder="{{ __('taste-ui::messages.select.input') }}"
                                 x-model.debounce.500ms="search"
                        />
                    </li>
                </template>
                <template x-for="option in options" :key="option[selectable.label] ?? option">
                    <li x-on:click="select(option)"
                        class="relative cursor-pointer select-none py-2 pr-2 pl-3 text-gray-700 transition hover:bg-gray-100"
                        id="option-0"
                        role="option"
                        tabindex="-1"
                        x-bind:class="{ 'font-semibold hover:text-white hover:bg-red-500': selected(option) }"
                    >
                        <div wire:ignore class="flex items-center justify-between">
                            <span class="ml-2 truncate" x-text="option[selectable.label] ?? option"></span>
                            <svg x-show="selected(option)" class="h-5 w-5 font-bold text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                        </div>
                    </li>
                </template>
                <template x-if="options.length === 0">
                    <li class="m-2">
                        <span class="block w-full pr-2 text-gray-700">
                            {{ __('taste-ui::messages.select.empty') }}
                        </span>
                    </li>
                </template>
            </ul>
        </div>
    </div>
    @if ($hint && !$error)
        <span class="mt-2 text-sm text-secondary-500">
        {{ $hint }}
    </span>
    @endif
    @error ($computed)
    <span class="mt-2 text-sm text-red-500">
        {{ $message }}
    </span>
    @enderror
</div>