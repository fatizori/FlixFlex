@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-[#D3A748] text-sm font-medium leading-5 text-white focus:outline-none focus:border-[#D3A748] transition'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-white hover:text-[#D3A748] hover:border-[#D3A748] focus:outline-none focus:text-[#D3A748] focus:border-[#D3A748] transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
