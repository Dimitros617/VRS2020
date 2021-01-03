@section('title',"Kategorie")
@section('css', URL::asset('css/categories.css'))
<x-app-layout>

    <x-slot name="header"></x-slot>
    <script src="/js/categoryGets.js"></script>
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

                        <div class="hlavicka">
            <div class="display-4 p-4 text-vrs-cyan"> Seznam kategorií:</div>
                            <div class="search">
                                <div class="card card-sm">
                                    <div class="card-body row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <i class="fas fa-search h4 text-body"></i>
                                        </div>

                                        <div class="col">
                                            <input class="form-control-borderless" id="search" type="search" placeholder="Zadejte hledaný výraz">
                                        </div>

                                        <div class="col-auto">
                                            <div class="spinner-border text-dark" id="spinner" role="status" hidden></div>
                                            <button class="btn btn-lg btn-success" type="submit" onclick="categoryFind(this)">Najít</button>
                                            <button class="btn btn-lg btn-primary " data-sort="none" sort="desc" onclick="categorySort(this)">&#8681;</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

            @if(sizeof($categories) != 0)
                <div class="list-group pb-4  " id="categoryList">
                    @for ($i = 0; $i < count($categories); $i++)


                        <a href="{{url()->current().'/'.$categories[$i]->name}}"
                           class="items-blocky list-group-item-action toast-body categoryElement"
                           categoryID="{{$categories[$i]->id}}">

                            <div class="dataContainer text-center text-sm-start float-sm-start ">
                                <div class="h1 ">
                                {{$categories[$i]->name}}
                                </div>

                            <div class="description txx-area ">
                                {{$categories[$i]->description}}
                            </div>
                            </div>
<div class="d-table me-auto ms-auto float-sm-end ms-sm-0 me-sm-0 ">
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
                           <div class="d-flex justify-content-center justify-content-sm-end w-100 my-2">
                               @if(Auth::permition()->edit_item == 1)
                                <form action="{{'/categories/' . $categories[$i]->id .'/removeCategory'}}" method="POST"
                                      class="removeCategory m-1">
                                    @csrf
                                    <input type="text" class="d-none" name="categoryId" value="{{$categories[$i]->id}}">

                                    <button type="submit button" class="btn btn-danger w-200p"
                                            onclick=" return confirm('Opravdu to chcete smazat?');">Smazat
                                    </button>
                                </form>

                                <form action="{{'/categories/' . $categories[$i]->id .'/activeLoans'}}"
                                      class="removeCategory m-1">


                                    <button type="submit button" class="btn btn-warning w-200p ">Aktuální závazky</button>
                                </form>

                            @endif
                           </div>
                        </a>
                        {{--                    (str_replace(' ','_',$kategory['nazev']))  pokud chceme nahradit mezery podrtrřítkem --}}

                    @endfor
                </div>
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

            @else
                <div class="display-4 pt-4 pb-4">Nebyly nalezeny žádné kategorie</div>
            @endif

        </div>
    </div>
    </div>
    </div>

</x-app-layout>


