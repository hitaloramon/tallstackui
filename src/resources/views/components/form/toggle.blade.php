@php
    $computed = $attributes->whereStartsWith('wire:model')->first();
    $error = $errors->has($computed);
    $personalize = tallstackui_personalization('form.toggle', $personalization());
    $slot = $label instanceof \Illuminate\View\ComponentSlot;
    $position = $slot && $label->attributes->has('left') ? 'left' : $position;
    $label = $slot ? $label->toHtml() : $label;

    // We remove any bg color classes from the wrapper if there
    // is an error to apply the red bg color to the input instead
    $personalize['wrapper.class'] = $computed && $error ? preg_replace('/\bbg-[a-zA-Z0-9-]+/', '', $personalize['background.class']) : $personalize['background.class'];
@endphp

<x-wrapper.radio :$id :$computed :$error :$label :$position>
    <div @class($personalize['wrapper'])>
        <input @if ($id) id="{{ $id }}" @endif type="checkbox" {{ $attributes->class([
            $personalize['input.class'],
            $personalize['input.sizes.' . $size],
        ]) }} @checked($checked)>
        <div @class([
            $personalize['background.class'],
            $personalize['background.sizes.' . $size],
            $colors['background'],
            $personalize['error'] => $computed && $error
        ])></div>
    </div>
</x-wrapper.radio>
