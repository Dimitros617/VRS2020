@section('title',"Kategorie")
@section('css', URL::asset('css/categories.css'))
<x-app-layout>

    <x-slot name="header"></x-slot>
{{--    <link rel="stylesheet" href="{{ URL::asset('css/categories.css') }}">--}}

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

                            <div class="dataContainer text-center text-sm-start float-sm-start">
                                <div class="display-4 ">
                                {{$categories[$i]->name}}
                                </div>

                            <div class="description txx-area">
                                {{$categories[$i]->description}}
                            </div>
                            </div>
<div class="d-table me-auto ms-auto float-sm-end ms-sm-0 me-sm-0">
                            @if($categories[$i]->availability == 1 || is_null($categories[$i]->availability) )
                                <div class="badge badge-success badge-pill m-1 ">
                                    {{$categories[$i]->count}}
                                </div>
                            @endif

                            @if($categories[$i]->availability == 0 && !is_null($categories[$i]->availability))
                                @if($i+1 < count($categories) && $categories[$i]->name == $categories[$i+1]->name)


                                <div class="badge badge-success badge-pill m-1">
                                        {{$categories[$i+=1]->count}}
                                    </div>
                                    @if(Auth::permition()->edit_item == 1)
                                        <div class="badge badge-danger badge-pill ">

                                            {{$categories[$i-1]->count}}
                                        </div>
                                    @else
                                        <div class="hidden">{{$i++}}</div>
                                    @endif
                                @else
                                    @if(Auth::permition()->edit_item == 1)

                                        <div class="badge badge-success badge-pill m-1">

                                            0
                                        </div>
                                        <div class="badge badge-danger badge-pill ">

                                            {{$categories[$i]->count}}
                                        </div>
                                    @else
                                        <div class="badge badge-success badge-pill m-1">

                                            0
                                        </div>
                                    @endif
                                @endif
                            @endif
</div>
                           <div class="d-flex justify-content-center w-100 ">
                               @if(Auth::permition()->edit_item == 1)
                                <form action="{{'/categories/' . $categories[$i]->id .'/removeCategory'}}" method="POST"
                                      class="removeCategory ">
                                    @csrf
                                    <input type="text" class="d-none" name="categoryId" value="{{$categories[$i]->id}}">

                                    <button type="submit button" class="btn btn-danger m-1 w-75"
                                            onclick=" return confirm('Opravdu to chcete?');">Smazat
                                    </button>
                                </form>

                                <form action="{{'/categories/' . $categories[$i]->id .'/activeLoans'}}" class="removeCategory ">


                                    <button type="submit button" class="btn btn-warning m-1 w-75">Aktuální závazky</button>
                                </form>

                            @endif
                           </div>
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
    </div>
    </div>

</x-app-layout>


