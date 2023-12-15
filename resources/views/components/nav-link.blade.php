@props(['active' => false])

@php
    $class = $active ? 'active' : '';
@endphp

<li>
    <a wire:navigate {{ $attributes->merge(['class' => $class]) }}>{{ $slot }}</a>
</li>
