<x-jet-action-section>
    <x-slot name="title">
        {{ __('Odstranění účtu') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Trvalé smazání Vašeho účtu') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('Poté, co smažete svůj účet, všechna Vaše data budou nenávratně smazána. Předtím, než toto uděláte, uschovejte si informace, které byste chtěli zachovat pro pozdější použití.') }}
        </div>

        @php
            try {
                    $data = Illuminate\Support\Facades\DB::table('loans')->where('user',Auth::user()->id)->get();
                    $dataC = count($data);

                } catch (\Throwable $e) {
                                            $dataC = 0;
                                        }
        @endphp

        @if($dataC != 0)
            <div class="mt-4 vrs-h3 text-vrs-yellow" onclick="vrsAlert('Počet aktuálních nevyřízených závazků (výpůjček, rezervací): {{$dataC}}')" style="cursor: pointer">
                Nemůžete smazat svůj účet, dokud máte nějaké nevyřízené závazky!
            </div>
        @else
            <div class="mt-5">
                <x-jet-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                    {{ __('Smazat účet') }}
                </x-jet-danger-button>
            </div>
        @endif


        <!-- Delete User Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmingUserDeletion">

            <x-slot name="title">
                {{ __('Smazat účet') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Jste si jistý, že chcete odstranit Váš účet? Poté, co smažete svůj účet, všechna Vaše data (kromě historie výpůjček) budou nenávratně smazána. Prosím, zadejte své heslo jako potvrzení, že chcete trvale a nenávratně odstranit Váš účet.') }}

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-jet-input type="password" class="mt-1 block w-3/4" placeholder="{{ __('Heslo') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="deleteUser" />

                    <x-jet-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Nyní ne') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Smazat účet') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>


    </x-slot>
</x-jet-action-section>
