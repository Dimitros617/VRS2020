@section('title',"Kategorie")

<x-app-layout>

    <x-slot name="header"></x-slot>


    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="container">

            @if(sizeof($categories) != 0)
                <div class="list-group pt-4 pb-4">
                    @foreach($categories as $category)


                        <a href="{{url()->current().'/'.$category['name']}}"
                           class="list-group-item list-group-item-action">

                            <div class="display-4">
                                {{$category['name']}}
                            </div>

                            <div class="">
                                {{$category['description']}}
                            </div>

                            <div class="badge badge-primary badge-pill">
                                99
                            </div>


                        </a>
                        {{--                    (str_replace(' ','_',$kategory['nazev']))  pokud chceme nahradit mezery podrtrřítkem --}}

                    @endforeach
                </div>
            @else
                <div class="display-4 pt-4 pb-4">Nebyly nalezeny žádné kategorie</div>
            @endif

        </div>
    </div>


</x-app-layout>


