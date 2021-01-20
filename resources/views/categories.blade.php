@section('title',"Kategorie")
@section('css', URL::asset('css/categories.css'))
<x-app-layout>

    <x-slot name="header"></x-slot>
    <script src="/js/category-search.js"></script>
    <script src="/js/remove.js"></script>
{{--    <link rel="stylesheet" href="{{ URL::asset('css/categories.css') }}">--}}

    <div class="p-3 p-sm-5 bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8 ">

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
            <div class="pageTitleSearch mb-4">Seznam kategorií</div>
                            <div class="search">
                                <div class="bg-gray-100 rounded-3 modal-open">
                                    <div class="card-body row no-gutters align-items-center h-4rem">

                                        <div class="col">
                                            <input class="form-control-borderless mt--1" id="search" type="search" placeholder="Zadejte hledaný výraz">

                                        </div>

                                        <div class="col-auto">
                                            <div class="spinner-border text-vrs-yellow searchSpinner mt--1" id="spinner" role="status" hidden></div>
                                        </div>


                                        <div class="col-auto searchButtonDiv">

                                            <button class="btn btn-lg btn-success searchButton" type="submit" onclick="categoryFind(this)">Najít</button>
                                            <button class="btn btn-lg btn-primary searchButton" data-sort="none" sort="desc" onclick="categorySort(this)">&#8681;</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

            @if(sizeof($categories) != 0)
                <div class="list-group pb-4  " id="categoryList">
                    @for ($i = 0; $i < count($categories); $i++)


                        <a href="{{url()->current().'/'.$categories[$i]->name}}"
                           class=" text-decor-none items-blocky list-group-item-action toast-body categoryElement"
                           categoryID="{{$categories[$i]->id}}">

                            <div class="dataContainer text-center text-sm-start float-sm-start ">
                                <div class="vrs-h2 text-vrs-cyan">
                                {{$categories[$i]->name}}
                                </div>

                            <div class="vrs-h3 text-vrs-yellow txx-area ">
                                {{$categories[$i]->description}}
                            </div>
                            </div>
                     <div class="d-table me-auto ms-auto float-sm-end ms-sm-0 me-sm-0 ">

                            @if($categories[$i]->availability == 1 || is_null($categories[$i]->availability) )
                                <div class="badge badge-success badge-pill m-1 ">
                                    {{$categories[$i]->count}}
                                </div>

                             @if(Auth::permition()->edit_item == 1)
                                 <div class="badge badge-danger badge-pill ">

                                     0
                                 </div>
                             @endif

                            @else
                                @if($i+1 < count($categories) && $categories[$i]->name == $categories[$i+1]->name)


                                        <div class="badge badge-success badge-pill m-1">
                                            {{$categories[$i+=1]->count}}
                                        </div>

                                        @if(Auth::permition()->edit_item == 1)
                                            <div class="badge badge-danger badge-pill ">

                                                {{$categories[$i-1]->count}}
                                            </div>
                                        @endif
{{--                                            @php $i++; @endphp--}}

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
                           <div class="d-flex justify-content-center justify-content-sm-end my-2 buttonsDiv">
                               @if(Auth::permition()->edit_item == 1)
                                <div class="buttonsDivItem">
{{--                                    removeCategory(this, '{{$categories[$i]->id}}'--}}
                                    <button type="submit button" class="btn btn-danger w-200p buttonsDivItem" onclick="vrsNotify('Opravdu chcete kategorii smazat?',removeCategory, this,'{{$categories[$i]->id}}' ); return false">
                                        <div id="removeText">Smazat</div>
                                        <div id="removeLoading" class="spinner-grow text-light" role="status" hidden></div>
                                    </button>
                                </div>
                               @endif
                               @if(Auth::permition()->return_verification == 1 || Auth::permition()->possibility_renting == 1 || Auth::permition()->edit_item == 1)
                                {{--   Form protože nemuže být a v a--}}
                                <form action="{{'/categories/' . $categories[$i]->id .'/activeLoans'}}"
                                      class=" p-0 buttonsDivItem">


                                    <button type="submit button" class="btn btn-warning w-200p buttonsDivItem">Aktuální závazky</button>
                                </form>

                                @endif
                           </div>
                        </a>
                        {{--                    (str_replace(' ','_',$kategory['nazev']))  pokud chceme nahradit mezery podrtrřítkem --}}

                    @endfor
                </div>
            @else
                <div class="emptyElementLoans">Nebyly nalezeny žádné kategorie</div>
            @endif
            @if( $permition[0]->edit_item == 1)
                <div class="item">
                    <form action="{{'/categories/addNewCategory'}}" method="POST" class="addNewCategory">
                        @csrf
                        <button type="submit" class="btn btn-light w-100 text-center align-middle mb-2 mt-4 pt-4 fw-bolder text-vrs-clight " onclick="document.getElementById('addNewCategorySpinner').removeAttribute('hidden');document.getElementById('addNewCategoryText').setAttribute('hidden','');">
                            <span class="d-block w-100 ">Přidat novou kategorii</span>
                            <h1 id="addNewCategoryText" >&#43;</h1>
                            <div class="spinner-grow text-vrs-cyan mb-4 mt-4" id="addNewCategorySpinner" hidden></div>
                        </button>

                    </form>
                </div>
            @endif

        </div>
    </div>
    </div>
    </div>

</x-app-layout>


