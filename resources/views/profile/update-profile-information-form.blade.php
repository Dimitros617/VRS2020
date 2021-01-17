
<x-jet-form-section submit="updateProfileInformation">

    <x-slot name="title">
        {{ __('Informace o uživateli') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Upravte své jméno, e-mailovou adresu či telefon.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                       wire:model="photo"
                       x-ref="photo"
                       x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Vybrat novou fotografii') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Odstranit fotografii') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
    @endif

    <!-- Name -->

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Jméno') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <!-- Příjmení -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="surname" value="{{ __('Příjmení') }}" />
            <x-jet-input id="surname" type="text" class="mt-1 block w-full" wire:model.defer="state.surname" autocomplete="surname" />
            <x-jet-input-error for="surname" class="mt-2" />
        </div>

        <!-- Přezdívka -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="nick" value="{{ __('Přezdívka') }}" />
            <x-jet-input id="nick" type="text" class="mt-1 block w-full" wire:model.defer="state.nick" autocomplete="nickname" />
            <x-jet-input-error for="nick" class="mt-2" />
        </div>

        <!-- Telefon -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="phone" value="{{ __('Telefon') }}" />
            <x-jet-input id="phone" type="text" class="mt-1 block w-full" wire:model.defer="state.phone" autocomplete="phone" />
            <x-jet-input-error for="phone" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('E-mail') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
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
