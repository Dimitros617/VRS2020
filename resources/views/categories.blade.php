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
                        @if( $permition[0]->edit_item == 1)
                            <div class="item">
                                <form action="{{'/categories/addNewCategory'}}" method="POST" class="addNewCategory">
                                    @csrf
                                    <button type="submit" class="btn btn-light w-100 text-center align-middle mb-2">
                                        Přidat novou kategorii
                                        <h1>&#43;</h1>
                                    </button>

                                </form>
                            </div>
                        @endif
                </div>
            @else
                <div class="display-4 pt-4 pb-4">Nebyly nalezeny žádné kategorie</div>
            @endif

        </div>
    </div>


</x-app-layout>


