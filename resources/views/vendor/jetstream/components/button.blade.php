<button {{ $attributes->merge(['type' => 'submit', 'class' => ' items-center  px-4 py-2 bg-[#D3A748]/20  rounded-md font-semibold text-xs text-white text-center uppercase tracking-widest hover:border-2 hover:border-[#D3A748]  active:bg-[#D3A748] focus:outline-none focus:border-[#D3A748] focus:ring-0 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
