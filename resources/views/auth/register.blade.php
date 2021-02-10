<x-guest-layout>
    <x-jet-authentication-card>

        <div class="" style="margin: auto;">
            <div class="mt-4 mb-5" style="">
                {{--            <x-jet-authentication-card-logo />--}}
                <a href="/"><x-jet-application-logo class="block h-9 w-auto " /></a>
            </div>

            <x-jet-validation-errors class="mb-4" />


            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                <!--<x-jet-label for="name" value="{{ __('Name') }}" />-->
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" placeholder="{{ __('Name') }}" :value="old('name')" required autofocus autocomplete="given-name" />
                </div>

                <div class="mt-4">
                <!--<x-jet-label for="surname" value="{{ __('Surname') }}" /> -->
                    <x-jet-input id="surname" class="block mt-1 w-full" type="text" name="surname" placeholder="{{ __('Surname') }}" :value="old('surname')" required autofocus autocomplete="family-name" />
                </div>

                <div class="mt-4">
                <!--<x-jet-label for="nick" value="{{ __('Nick') }}" /> -->
                    <x-jet-input id="nick" class="block mt-1 w-full" type="text" name="nick" placeholder="{{ __('Nick') }}" :value="old('nick')" required autofocus autocomplete="nickname" />
                </div>

                <div class="mt-4">
                <!--<x-jet-label for="phone" value="{{ __('Phone') }}" />-->
                    <x-jet-input id="phone" class="block mt-1 w-full" type="tel" name="phone" placeholder="{{ __('Phone in the format +420 111 222 333') }}"  :value="old('phone')" required autofocus autocomplete="phone" />
                </div>

                <div class="mt-4">
                <!--<x-jet-label for="email" value="{{ __('Email') }}" />-->
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="{{ __('Email') }}" :value="old('email')" required />
                </div>

                <div class="mt-4">
                <!--<x-jet-label for="password" value="{{ __('Password') }}" />-->
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" placeholder="{{ __('Password') }}" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                <!--<x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />-->
                    <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password" />
                </div>

                <div class="flex items-center justify-end mt-4">


                    <x-jet-button class="ml-4 h6">
                        {{ __('Register') }}
                    </x-jet-button>
                </div>
                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Do you already have an account?') }}
                    </a>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
