<x-guest-layout>
    <x-jet-authentication-card>

        <div class="" style="margin: auto;">
            <div class="mt-4 mb-5" style="">
                {{--            <x-jet-authentication-card-logo />--}}
                <a href="/"><x-jet-application-logo class="block h-9 w-auto " /></a>
            </div>

            <div class="mb-4 text-sm text-gray-600">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
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
                <!-- <x-jet-label for="email" value="{{ __('Email') }}" /> -->
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="{{ __('Email') }}" :value="old('email')" required autofocus />
                </div>

                <div class=" flex items-center justify-end mt-4 ">
                    <x-jet-button class="h6 mt-4">
                        {{ __('Email Password Reset Link') }}
                    </x-jet-button>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
