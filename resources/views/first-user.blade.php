@section('title','Výpůjční a rezervační systém - Vítej první uživateli!')
@section('css', URL::asset('css/dashboard.css'))

<x-app-layout>
    <x-slot name="header">
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('Hlavní strana') }}--}}
{{--        </h2>--}}
    </x-slot>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8" onload="checkUserAlone()">
    <div class="container p-6 text-center text-vrs-cyan">

        <h1 class="display-1 mb-4">Vítejte!</h1>
        <div class="h6"> Provedli jsme pár věcí, vše nastavili a vypadá to, že jste aktuálně jediný uživatel v systému. Proto jsme na Vás převedli veškerá práva a stanovili Vás novým vládcem systému. Kliknutím na tlačítko „POKRAČOVAT“ můžete začít se správou celého systému a přizpůsobit si jej.
            <br><br><b>Hodně štěstí.</b>
        </div>
        <a href="/dashboard"> <button type="button" class="btn btn-warning bg-vrs-yellow w-100 mt-4 h-4rem text-white fs-7"><b>POKRAČOVAT</b></button></a>
        </div>
    </div>
</x-app-layout>
