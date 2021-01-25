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
                <!--<x-jet-label for="name" value="{{ __('Jméno') }}" />-->
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" placeholder="Jméno" :value="old('name')" required autofocus autocomplete="given-name" />
                </div>

                <div class="mt-4">
                <!--<x-jet-label for="surname" value="{{ __('Příjmení') }}" /> -->
                    <x-jet-input id="surname" class="block mt-1 w-full" type="text" name="surname" placeholder="Příjmení " :value="old('surname')" required autofocus autocomplete="family-name" />
                </div>

                <div class="mt-4">
                <!--<x-jet-label for="surname" value="{{ __('Přezdívka') }}" /> -->
                    <x-jet-input id="nick" class="block mt-1 w-full" type="text" name="nick" placeholder="Přezdívka " :value="old('nick')" required autofocus autocomplete="nickname" />
                </div>

                <div class="mt-4">
                <!--<x-jet-label for="phone" value="{{ __('Telefon') }}" />-->
                    <x-jet-input id="phone" class="block mt-1 w-full" type="tel" name="phone" placeholder="Telefon ve formátu +420 111 222 333"  :value="old('phone')" required autofocus autocomplete="phone" />
                </div>

                <div class="mt-4">
                <!--<x-jet-label for="email" value="{{ __('E-mail') }}" />-->
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="E-mail" :value="old('email')" required />
                </div>

                <div class="mt-4">
                <!--<x-jet-label for="password" value="{{ __('Heslo') }}" />-->
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" placeholder="Heslo" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                <!--<x-jet-label for="password_confirmation" value="{{ __('Potvrdit heslo') }}" />-->
                    <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" placeholder="Potvrdit heslo" required autocomplete="new-password" />
                </div>

                <div class="flex items-center justify-end mt-4">


                    <x-jet-button class="ml-4 h6">
                        {{ __('Registrovat') }}
                    </x-jet-button>
                </div>
                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Máte již účet?') }}
                    </a>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
