<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <div style="transform: scale(2); margin-bottom: 25px">
                {{--            <x-jet-authentication-card-logo />--}}
                <x-jet-application-logo class="block h-9 w-auto " />
            </div>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your passwordíček? No kurde. Just do it, emailík address and we will smith ti pošle na reset passwordíčku ty kreténíčku. Ale stejně jsi dylina, tak si zvol nový passwordíček 12345678') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Resetovat heslo') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
