<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>
        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">

            @csrf

            <div>
                <x-jet-input id="name" class="block mt-6 w-full" type="text" placeholder="{{ __('Name') }}" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-input id="email" class="block mt-6 w-full" type="email" placeholder="{{ __('Email') }}" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-input id="password" class="block mt-6 w-full" type="password" name="password" placeholder="{{ __('Password') }}" required autocomplete="new-password" />
            </div>


            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="mt-4 ">
                <x-jet-button class="block mt-2 h-12 w-full" >
                    {{ __('Register') }}
                </x-jet-button>
            </div>

            <div class="flex items-center justify-center mt-4">
                <a class="underline text-sm text-white hover:text-[#D3A748]" href="{{ route('login') }}">
                    {{ __('Already have an account?') }}
                </a>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
