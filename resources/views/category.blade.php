@section('title',$category->name)
@section('css', URL::asset('css/category.css'))

<x-app-layout>
    <x-slot name="header"></x-slot>

    <script src="/js/main.js"></script>
    <script src="/js/datePicker.js"></script>
    <script src="/js/item-search.js"></script>
    <script src="/js/categorySaves.js"></script>
    <script src="/js/remove.js"></script>
    <script>
        window.categoryName = "{{$category['name']}}";
    </script>


    <div class="bg-white overflow-hidden shadow-xl p-3 sm:rounded-lg max-w-7xl mx-auto sm:px-8 lg:px-8">

        <div class="container p-6">


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
                            {{--  Pokud má uživatel oprávnění upravovat itemy--}}


                            @if( $permition[0]->edit_item == 1)
                                <form action="{{'/saveCategoryData'}}" method="POST" class="categoryData d-flow-root">
                                    @csrf
                                    <input type="number" value="{{$category['id']}}" name="categoryId" hidden>
                                    <input type="text" class="pageTitle" value="{{$category['name']}}" name="categoryNameOld"  hidden>

                                    <input type="text" class="pageTitle" value="{{$category['name']}}"
                                           name="categoryName" onchange="categoryNameChange(this)" oninput="showButton(this)" required>
                                    <br>
                                    <input type="text" name="categoryDescription" method="POST" id="hiddenTextArea" hidden>
                                    <div contenteditable class="vrs-h3 text-vrs-yellow w-100 text-center p-3" name="categoryDescription" method="POST"
                                              oninput="showButton(this); document.getElementById('hiddenTextArea').value = this.innerHTML">{{$category['description']}}</div>
                                    <br>
                                    <input class="btn btn-primary float-end p-2 me-4-5 w-10rem" type="submit"  value="Uložit změny"  hidden>

                                </form>
                                {{--                            Pouze je navíc atribut disabled u prvků aby do nic uživatel nemohl psát    --}}
                            @else
                                <input type="text" class="pageTitle bg-white" value="{{$category['name']}}" disabled>
                                <br>
                                <textarea class="vrs-h3 text-vrs-yellow w-100 text-center p-3 bg-white" disabled>{{$category['description']}}</textarea>
                                <br>
                            @endif

                            <div class="hlavicka border-0 mb-0 mt-4">
                                <div class="search">
                                    <div class="bg-gray-100 rounded-3 modal-open">
                                        <div class="card-body row no-gutters align-items-center h-4rem">

                                            <div class="col">
                                                <input class="form-control-borderless mt--1" id="search" type="search" placeholder="Zadejte hledaný výraz">

                                            </div>

                                            <div class="col-auto">
                                                <div class="spinner-border text-vrs-yellow searchSpinner mt--1" id="search-spinner" role="status" hidden></div>
                                            </div>


                                            <div class="col-auto searchButtonDiv">

                                                <button class="btn btn-lg btn-success searchButton" type="submit" onclick="itemFind(this)">Najít</button>
                                                <button class="btn btn-lg btn-primary searchButton" data-sort="none" sort="desc" onclick="itemsSort(this, 'waitingLoans', 'activeLoans', 'historyLoans')">&#8681;</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>




                            @if(sizeof($items) != 0)
                                <div class="data" id="data">
                                @foreach($items as $item)

                                    {{--                Pokud má item nastaveno availability na 1 zoobrazí se, pokud ne z nemožní se sním práce pro uživatel--}}

                                    @if($item->availability  == 1 )
                                            <div class="item" itemId="{{$item->id}}" id="{{$item->id}}">
                                    @else
                                        @if($permition[0]->edit_item == 1)
                                                        <div class="item hiddenItem">
                                                @else
                                                        <div class="item" hidden>
                                            @endif
                                    @endif
                                            <form  class="itemDataDiv">
                                                @csrf

                                                <div class="itemDataDivRow">
                                                <label class="title font-weight-bold" for="name">Název:</label>
                                                <div contenteditable class="name" value="{{$item->name}}" name="name"
                                                       @if( $permition[0]->edit_item != 1) disabled @endif
                                                       oninput="showButton(this)" required>{{$item->name}}
                                                </div></div>

                                                <div class="itemDataDivRow">
                                                <label class="title font-weight-bold" for="note">Poznámka:</label>
                                                <div contenteditable class="note" value="{{$item->note}}" name="note"
                                                       @if( $permition[0]->edit_item != 1) disabled @endif
                                                       oninput="showButton(this)">{{$item->note}}
                                                </div></div>
                                                    <div class="itemDataDivRow">
                                                <label class="title font-weight-bold" for="place">Místo:</label>
                                                <div contenteditable class="place" value="{{$item->place}}" name="place"
                                                       @if( $permition[0]->edit_item != 1) disabled @endif
                                                       oninput="showButton(this)">{{$item->place}}
                                                    </div></div>
                                                        <div class="itemDataDivRow">
                                                <label class="title font-weight-bold" for="inventory_number">Inventární číslo:</label>
                                                <div contenteditable class="inventory_number" name="inventory_number"
                                                       value="{{$item->inventory_number}}"
                                                       @if( $permition[0]->edit_item != 1) disabled @endif
                                                       oninput="showButton(this)">{{$item->inventory_number}}
                                                        </div></div>



                                                <button type="submit button" class="btn btn-primary w-200p float-end p-2 me-4-5 w-10rem text-white" onclick="saveItemData(this,'{{$item->id}}', '{{$item->categories}}', '{{$item->availability}}'); return false" hidden>
                                                    <div id="buttonText">Uložit změny</div>
                                                    <div id="buttonLoading" class="spinner-grow text-light" role="status" hidden></div>
                                                </button>


                                            </form>
                                            @php
                                                $text = "";
                                            @endphp
                                            @foreach($loans as $loan)

                                                @if($loan->item == $item->id)
                                                    @php

                                                        $current = strtotime($loan->rent_from);
                                                        $date2 = strtotime($loan->rent_to);
                                                        $stepVal = '+1 day';
                                                        while( $current <= $date2 ) {
                                                           $text .= date('d-m-Y', $current) . "/";
                                                           $current = strtotime($stepVal, $current);
                                                        }

                                                    @endphp
                                                @else
                                                @endif
                                            @endforeach

                                        @if( $permition[0]->possibility_renting == 1)
                                            <form  id="form" >
                                                @csrf
                                                <input type="text" class="d-none" name="itemId"
                                                       value="{{$item->id}}">

                                                <div class="dateReservation" data="{{$text}}">
                                                    <div class="reserveFromDiv">
                                                        <label>Od:</label>
                                                        <input class="date reserveFromInput rent{{$item->id}}"
                                                               type="text"
                                                               name="rent_from" nameDB="{{$item->name}}"
                                                               autocomplete="off"
                                                               itemId="{{$item->id}}"
                                                               onchange="changeFrom(this)"
                                                               onload="initDate(this)"
                                                        required>
                                                    </div>

                                                    <div class="reserveToDiv">
                                                        <label>Do:</label>
                                                        <input class="date reserveToInput rent{{$item->id}}"
                                                               type="text"
                                                               name="rent_to" nameDB="{{$item->name}}"
                                                               autocomplete="off"
                                                               itemId="{{$item->id}}"
                                                               onchange="changeTo(this)"
{{--                                                               onload="initDate(this)"--}}
                                                        required>
                                                    </div>
                                                </div>

                                                <br>


                                                <input id="newLoanFormSubmit" type="submit" hidden >


                                            </form>
                                        @endif
                                                <div class="buttonsDiv">
                                                @if( $permition[0]->possibility_renting == 1)

                                                                <div class="buttonsDivItem">
                                                                    <button type="submit button" class="btn btn-primary w-200p buttonsDivItem" onclick="saveItemLoansData(this); return false;">
                                                                        <div id="buttonText">Vypůjčit</div>
                                                                        <div id="buttonLoading" class="spinner-grow text-light" role="status" hidden></div>
                                                                    </button>
                                                                </div>
                                                @endif

                                                @if( $permition[0]->edit_item == 1)

                                                    <div class="buttonsDivItem">
                                                        <button type="submit button" class="btn btn-danger w-200p buttonsDivItem" onclick="vrsNotify('Opravdu chcete položku smazat?',removeItem, this,'{{$item->id}}' ); return false">
                                                            <div id="removeText">Smazat</div>
                                                            <div id="removeLoading" class="spinner-grow text-light" role="status" hidden></div>
                                                        </button>
                                                    </div>
                                                @endif

                                                @if(Auth::permition()->return_verification == 1 || Auth::permition()->possibility_renting == 1 || Auth::permition()->edit_item == 1)
                                                    <form action="{{'/item/' . $item->id . '/activeLoans'}}"  class="buttonsDivItem">
                                                        <button type="submit button" class="btn btn-warning w-200p buttonsDivItem" onclick="showButtonLoading(this)">
                                                            <div id="buttonText">Aktuální závazky</div>
                                                            <div id="buttonLoading" class="spinner-grow text-light" role="status" hidden></div>
                                                        </button>
{{--                                                         <input class="btn btn-warning buttonsDivItem" type="submit" value="Aktuální závazky">--}}
                                                    </form>
                                                @endif

                                                @if( $permition[0]->edit_item == 1)

                                                    <div class="buttonsDivItem">
                                                        <button type="submit button" class="btn

                                                         @if($item->availability  == 1 )
                                                            btn-success
                                                        @else
                                                            btn-danger
                                                        @endif

                                                         w-200p buttonsDivItem" onmouseover="hoverChange2(this)"; onmouseleave="hoverChangeEnd2(this)"; onclick="changeItemAvailability(this, '{{$item->id}}'); return false;"
                                                                @if($item->availability  == 1 )
                                                                bool="1"
                                                                @else
                                                                bool="0"
                                                                @endif
                                                        >
                                                            <div id="buttonText">
                                                                @if($item->availability  == 1 )
                                                                Viditelné: ANO
                                                                @else
                                                                Viditelné: NE
                                                                @endif
                                                            </div>

                                                            <div id="buttonLoading" class="spinner-grow text-light" role="status" hidden></div>
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>


                                                            <div id="alert{{$item->id}}"></div>
                                        </div>
                                        @endforeach
                                            @else
                                                <div class="emptyElementLoans">Nebylo zde nic nalezeno</div>
                                            @endif

                                                                @if( $permition[0]->edit_item == 1)
                                                                    <div class="">
                                                                    <form action="{{'/item/addNewItem'}}" method="POST" class="addNewItem">
                                                                        @csrf
                                                                        <input type="text" class="d-none" name="category" value="{{$category->id}}">

                                                                        <button type="submit" class="btn btn-light w-100 text-center align-middle mb-5 mt-4 pt-4 fw-bolder text-vrs-clight " onclick="document.getElementById('addNewItemSpinner').removeAttribute('hidden');document.getElementById('addNewItemText').setAttribute('hidden','');">
                                                                            <span class="d-block w-100 ">Přidat novou položku</span>
                                                                            <h1 id="addNewItemText" >&#43;</h1>
                                                                            <div class="spinner-grow text-vrs-cyan mb-4 mt-4" id="addNewItemSpinner" hidden></div>
                                                                        </button>

                                                                    </form>
                                                                    </div>
                                                                @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>


