<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nová vypůjčka') }}
        </h2>
    </x-slot>


    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="container">
            <div class="list-group">
            @foreach($categories as $category)


{{--                    <div class="col-sm-6">{{$kategory['nazev']}}</div>--}}
                    <a href="{{url()->current().'/'.$category['nazev']}}" class="list-group-item list-group-item-action">{{$category['nazev']}}</a>
{{--                    (str_replace(' ','_',$kategory['nazev']))  pokud chceme nahradit mezery podrtrřítkem --}}
                    <br>
                    @php(url()->current())
            @endforeach
            </div>
        </div>
    </div>


</x-app-layout>


