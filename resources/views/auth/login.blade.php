<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-input id="email" class="block mt-6 w-full" placeholder="Email" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-input id="password" class="block mt-6 w-full" placeholder="Password" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="mt-4 ">
                <x-jet-button class="block mt-2 h-12 w-full" >
                    {{ __('Log in') }}
                </x-jet-button>
            </div>

            <div class="flex items-center justify-center mt-4">
                <a class="underline text-sm text-white hover:text-[#D3A748]" href="{{ route('register') }}">
                    {{ __("Don't have an account?") }}
                </a>
            </div>

        </form>
    </x-jet-authentication-card>
</x-guest-layout>
