@section('title',"Katedry")
@section('css', URL::asset('css/categories.css'))
<x-app-layout>

    <x-slot name="header"></x-slot>
    <!--script src="/js/category-search.js"></script-->    
    <script src="/js/categorySaves.js"></script>
    <script src="/js/remove.js"></script>

    <div class="p-3 p-sm-5 bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8 ">

        <div class="container">

            @if(old('saveCheck'))
                @if(old('saveCheck') == 1)
                    <div id="autoHide" class="alert-success">
                        Změna proběhla úspěšně.
                        @else
                            <div id="autoHide" class="alert-danger">
                                Ups... Došlo k chybě při ukládání
                                @endif
                                @endif
                            </div>

                        <div class="hlavicka">
                            <div class="pageTitleSearch mb-4">Seznam kateder</div>
                            <!--div class="search">
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
                            </div -->
                        </div>

            @if( $permition[0]->edit_item == 1)
                <div class="item">
                    <form action="{{'/departments/addNewDepartment'}}" method="POST" class="addNewDepartment">
                        @csrf
                        <button type="submit" class="btn btn-light w-100 text-center align-middle mb-2 mt-4 pt-4 fw-bolder text-vrs-clight " onclick="document.getElementById('addNewCategorySpinner').removeAttribute('hidden');document.getElementById('addNewCategoryText').setAttribute('hidden','');">
                            <span class="d-block w-100 text-sm">Přidat novou katedru</span>
                            <h1 id="addNewDepartmentText" >&#43;</h1>
                            <div class="spinner-grow text-vrs-cyan mb-4 mt-4" id="addNewDepartmentSpinner" hidden></div>
                        </button>

                    </form>
                </div>
            @endif


            @if(sizeof($departments) != 0)
                <div class="list-group pb-4  " id="categoryList">
                    @for ($i = 0; $i < count($departments); $i++)


                        <a href="{{url()->current().'/'.$departments[$i]->short}}"
                           class=" text-decor-none items-blocky list-group-item-action toast-body categoryElement"
                           categoryID="{{$departments[$i]->id}}">

                            <div class="dataContainer text-center text-sm-start float-sm-start ">
                                <div class="vrs-h2 text-vrs-cyan">
                                {{$departments[$i]->name}}
                                </div>
                                <div class="text-sm text-vrs-yellow txx-area ">
                                    {{$departments[$i]->short}}
                                </div>
                            </div>

                            {{-- tohle tu nebude treba
                            <div class="d-table me-auto ms-auto float-sm-end ms-sm-0 me-sm-0 ">

                            @if($departments[$i]->availability == 1 || is_null($departments[$i]->availability) )
                                <div class="badge badge-success badge-pill m-1 ">
                                    {{$departments[$i]->count}}
                                </div>
                                @if(Auth::permition()->edit_item == 1)
                                    <div class="badge badge-danger badge-pill ">
                                        0
                                    </div>
                                @endif
                            @else
                                @if($i+1 < count($departments) && $departments[$i]->name == $departments[$i+1]->name)
                                        <div class="badge badge-success badge-pill m-1">
                                            {{$departments[$i+=1]->count}}
                                        </div>

                                        @if(Auth::permition()->edit_item == 1)
                                            <div class="badge badge-danger badge-pill ">
                                                {{$departments[$i-1]->count}}
                                            </div>
                                        @endif
                                @else
                                        @if(Auth::permition()->edit_item == 1)

                                            <div class="badge badge-success badge-pill m-1">
                                                0
                                            </div>
                                            <div class="badge badge-danger badge-pill ">
                                                {{$departments[$i]->count}}
                                            </div>
                                        @else
                                            <div class="badge badge-success badge-pill m-1">
                                                0
                                            </div>
                                        @endif
                                @endif
                            @endif
                            </div>
                            --}}

                           <div class="d-flex justify-content-center justify-content-sm-end my-2 buttonsDiv">
                               @if(Auth::permition()->edit_item == 1)
                                <div class="buttonsDivItem">
                                    <button type="submit button" class="btn btn-danger w-200p buttonsDivItem" onclick="vrsNotify('Opravdu chcete katedru smazat?',removeDepartment, this,'{{$departments[$i]->id}}' ); return false">
                                        <div id="removeText">Smazat</div>
                                        <div id="removeLoading" class="spinner-grow text-light" role="status" hidden></div>
                                    </button>
                                </div>
                               @endif
                           </div>
                        </a>
                        {{--                    (str_replace(' ','_',$kategory['nazev']))  pokud chceme nahradit mezery podrtrřítkem --}}

                    @endfor
                </div>
            @else
                <div class="emptyElementLoans">Nebyly nalezeny žádné katedry.</div>
            @endif

        </div>
    </div>
    </div>
    </div>

</x-app-layout>


