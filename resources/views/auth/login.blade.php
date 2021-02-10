<x-guest-layout>
    <x-jet-authentication-card>

        <div class="" style="margin: auto;">
            <div class="mt-4 mb-5" style="">
                {{--            <x-jet-authentication-card-logo />--}}
                <a href="/"><x-jet-application-logo class="block h-9 w-auto" /></a>
            </div>

            <x-jet-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 ">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                <!-- <x-jet-label for="email" value="{{ __('Email') }}" /> -->
                    <x-jet-input id="email" class="block mt-3 w-full"  name="nick" placeholder="{{ __('Email or nick') }}" :value="old('email')" required  autofocus />
                </div>

                <div class="mt-4 mb-4">
                <!-- <x-jet-label for="password" value="{{ __('Password') }}" /> -->
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" placeholder="{{ __('Password') }}" required autocomplete="current-password" />
                </div>

{{--                <div class="mb-55px block mt-4">--}}
{{--                    <label for="remember_me" class="flex items-center">--}}
{{--                        <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">--}}
{{--                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>--}}
{{--                    </label>--}}
{{--                </div>--}}

                <div class="flex items-center justify-end ">
                    <x-jet-button class="h6">
                        {{ __('Login') }}
                    </x-jet-button>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}"">
                    {{ __("Don't have an account? Sign up!") }}
                    </a>
                </div>

                <div class="flex items-center justify-end mt-1">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
