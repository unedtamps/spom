@props(['active' => false])

@php
    $class = $active ? 'text-gray-900' : 'text-gray-500';
@endphp

<li class='list-none bg-slate-100'>
    <a wire:navigate {{ $attributes->merge(['class' => $class]) }}>{{ $slot }}</a>
</li>
