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
                <!-- <x-jet-label for="email" value="{{ __('E-mail nebo přezdívka') }}" /> -->
                    <x-jet-input id="email" class="block mt-3 w-full"  name="nick" placeholder="E-mail nebo přezdívka" :value="old('email')" required  autofocus />
                </div>

                <div class="mt-4 mb-4">
                <!-- <x-jet-label for="password" value="{{ __('Heslo') }}" /> -->
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" placeholder="Heslo" required autocomplete="current-password" />
                </div>

{{--                <div class="mb-55px block mt-4">--}}
{{--                    <label for="remember_me" class="flex items-center">--}}
{{--                        <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">--}}
{{--                        <span class="ml-2 text-sm text-gray-600">{{ __('Zapamatovat si mě?') }}</span>--}}
{{--                    </label>--}}
{{--                </div>--}}

                <div class="flex items-center justify-end ">
                    <x-jet-button class="h6">
                        {{ __('Přihlásit') }}
                    </x-jet-button>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}"">
                    {{ __('Nemáte účet? Zaregistrujte se!') }}
                    </a>
                </div>

                <div class="flex items-center justify-end mt-1">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Zapomenuté heslo') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
