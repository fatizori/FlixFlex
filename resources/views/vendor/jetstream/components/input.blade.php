@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-transparent h-12 text-white text-base  focus:border focus:ring-0 focus:border-solid focus:border-[#D3A748]  rounded-md shadow-sm bg-f-black1']) !!}>
