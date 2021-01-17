<x-jet-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Upravit heslo') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ujistěte se v rámci bezpečnosti, že Vaše heslo je dostatečně dlouhé a náhodné.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="current_password" value="{{ __('Aktuální heslo') }}" />
            <x-jet-input id="current_password" type="password" class="mt-1 block w-full" wire:model.defer="state.current_password" autocomplete="current-password" />
            <x-jet-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="password" value="{{ __('Nové heslo') }}" />
            <x-jet-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password" autocomplete="new-password" />
            <x-jet-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="password_confirmation" value="{{ __('Potvrďte nové heslo') }}" />
            <x-jet-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
            <x-jet-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <button type="submit button" class="btn btn-danger w-200p float-end p-2 w-10rem text-white px-4 py-2" >
            <div id="buttonText">Uložit změny</div>
            <x-jet-action-message class="mr-3" on="saved">
                <b>&#10003;</b>
            </x-jet-action-message>
            <div id="buttonLoading" class="spinner-grow text-light" role="status" hidden></div>
        </button>

    </x-slot>
</x-jet-form-section>
