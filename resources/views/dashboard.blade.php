@section('title','Výpůjční a rezervační systém')
@section('css', URL::asset('css/dashboard.css'))

<x-app-layout>
    <x-slot name="header">
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('Hlavní strana') }}--}}
{{--        </h2>--}}
    </x-slot>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{--  Sekce pro Admin, verifiedUser  --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if (Auth::permition()->possibility_renting == 1)
                <a href="/loans"><div>Mé aktivní výpůjčky a rezervace: <div>{{ $vypujcky_pocet }}</div></div></a>
                    @if(Auth::permition()->new_user == 1)
                        <a href="/all-loans"><div class="">Čeká na schválení: <div>{{ $schvaleni_pocet }}</div></div></a>
                    @else
                        <a href="/loans"><div>Čeká na schválení vrácení: <div>{{ $vraceni_pocet }}</div></div></a>
                    @endif
                @endif
            </div>

            <br>
            {{--  Sekce pro VŠECHNY  --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h2 class="">O systému</h2>
                <div class="">
                    Výpůjční a rezervační systém bla bla bla
                </div>
            </div>
            <br>


            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h2 class="">Jak to funguje?</h2>

                <div class="">
                    @if (Auth::permition()->possibility_renting != 1)
                    Nyní nemáte právo zapůjčovat položky. Můžete pouze:
                    <ul style="list-style-type:circle">
                        <li>Změnit své osobní údaje v záložce "Nastavení".</li>
                        <li>Pokud jste si již dříve něco půjčil a výpůjčku jste stále nevrátil, jejich seznam najdete v záložce "Moje výpůjčky".</li>
                        <li>Posílat zprávy SÁM SOBĚ! či jinému uživateli, jehož přezdívku znáte.</li>
                        <li>Odhlásit se.</li>
                    </ul>

                    @elseif(Auth::permition()->new_user == 0){{-- verified --}}
                        Sekce pro verified user. Bla bla věci JAK si vypůjčit v sekci Nová výpůjčka, JAK vrátit výpůjčku a PROČ je tam čekání na schválení, ikonky upozornění...
                    @elseif(Auth::permition()->new_user == 1)
                        Sekce pro Admin. Stručný manuál, možná by stálo za to udělat další blade, na kterém bude podrobnější návod pro Admina, na něj odtud odkaz.
                    @endif
                </div>
            </div>

            <br>
            {{--  Sekce pro unverifiedUser  --}}
            @if (Auth::permition()->possibility_renting != 1)
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h2 class="">Proč si nemohu nic půjčit?</h2>
                <div class="">
                    <ul style="list-style-type:circle">
                        <li>S největší pravděpodobností jste nový uživatel Výpůjčního a rezervačního systému. Musíte počkat, než vás schválí a ověří administrátor.</li>
                        <li>Pokud jste již jednou schváleni byli a nyní se vám neobjevuje záložka "Nová výpůjčka", bylo vám právo půjčovat si věci odebráno - ať již z důvodu nevrácení výpůjčky včas či jiných problémů. Pro více informací se zeptejte správce systému, administrátora.</li>
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
