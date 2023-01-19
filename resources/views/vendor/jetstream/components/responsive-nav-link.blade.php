@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block pl-3 pr-4 py-2 border-l-4 border-[#D3A748] text-base font-medium text-white bg-f-black1 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition'
            : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-white hover:text-[#D3A748] hover:bg-f-black2 hover:border-[#D3A748] focus:outline-none focus:text-[#D3A748] focus:bg-f-balck1 focus:border-[#D3A748] transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
