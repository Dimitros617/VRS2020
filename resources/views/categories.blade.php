@section('title',"Kategorie")

<x-app-layout>

    <x-slot name="header"></x-slot>


    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="container">

            @if(old('saveCheck'))
                @if(old('saveCheck') == 1)
                    <div id="autoHide" class="alert-success">
                        Změna proběhla úspěšně
                        @else
                            <div id="autoHide" class="alert-danger">
                                Ups... Došlo k chybě při ukládání
                                @endif
                                @endif
                            </div>

            <div class="h1"> Kategorie itemů :</div>

            @if(sizeof($categories) != 0)
                <div class="list-group pt-4 pb-4">
                    @for ($i = 0; $i < count($categories); $i++)


                        <a href="{{url()->current().'/'.$categories[$i]->name}}"
                           class="list-group-item list-group-item-action">

                            <div class="display-4">
                                {{$categories[$i]->name}}
                            </div>

                            <div class="">
                                {{$categories[$i]->description}}
                            </div>

                            @if($categories[$i]->availability == 1 || is_null($categories[$i]->availability) )
                                <div class="badge badge-success badge-pill">
                                    {{$categories[$i]->count}}
                                </div>
                            @endif

                            @if($categories[$i]->availability == 0 && !is_null($categories[$i]->availability))
                                @if($i+1 < count($categories) && $categories[$i]->name == $categories[$i+1]->name)


                                    <div class="badge badge-success badge-pill">
                                        {{$categories[$i+=1]->count}}
                                    </div>
                                    @if(Auth::permition()->edit_item == 1)
                                        <div class="badge badge-danger badge-pill">

                                            {{$categories[$i-1]->count}}
                                        </div>
                                    @else
                                        <div class="hidden">{{$i++}}</div>
                                    @endif
                                @else
                                    @if(Auth::permition()->edit_item == 1)

                                        <div class="badge badge-success badge-pill">

                                            0
                                        </div>
                                        <div class="badge badge-danger badge-pill">

                                            {{$categories[$i]->count}}
                                        </div>
                                    @else
                                        <div class="badge badge-success badge-pill">

                                            0
                                        </div>
                                    @endif
                                @endif
                            @endif

                            @if(Auth::permition()->edit_item == 1)
                                <form action="{{'/categories/' . $categories[$i]->id .'/removeCategory'}}" method="POST"
                                      class="removeCategory">
                                    @csrf
                                    <input type="text" class="d-none" name="categoryId" value="{{$categories[$i]->id}}">
                                    <button type="submit button" class="btn btn-danger "
                                            onclick=" return confirm('Opravdu to chcete?');">Smazat
                                    </button>
                                </form>

                                <form action="{{'/categories/' . $categories[$i]->id .'/activeLoans'}}" method="POST"
                                      class="removeCategory">
                                    @csrf
                                    <input type="text" class="d-none" name="categoryId" value="{{$categories[$i]->id}}">
                                    <button type="submit button" class="btn btn-warning ">Aktuální závazky</button>
                                </form>
                            @endif

                        </a>
                        {{--                    (str_replace(' ','_',$kategory['nazev']))  pokud chceme nahradit mezery podrtrřítkem --}}

                    @endfor
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


