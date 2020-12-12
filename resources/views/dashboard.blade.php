@section('title','Výpůjční a rezervační systém')
@section('css', URL::asset('css/dashboard.css'))

<x-app-layout>
    <x-slot name="header">
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('Hlavní strana') }}--}}
{{--        </h2>--}}
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div>Výpůjček: {{ $vypujcky_pocet }}</div>
                <div>Čeká na schválení: {{ $schvaleni_pocet }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
