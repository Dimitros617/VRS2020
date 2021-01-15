@section('title',$category->name)
@section('css', URL::asset('css/category.css'))

<x-app-layout>
    <x-slot name="header"></x-slot>

    <script src="/js/main.js"></script>
    <script src="/js/datePicker.js"></script>
    <script src="/js/categoryGets.js"></script>
    <script src="/js/categorySaves.js"></script>
    <script src="/js/remove.js"></script>
    <script>
        window.categoryName = "{{$category['name']}}";
    </script>


    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">

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
                                    <br>                                    <textarea class="vrs-h3 text-vrs-yellow w-100 text-center p-3" name="categoryDescription" method="POST"
                                              oninput="showButton(this)">{{$category['description']}}</textarea>
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




                            @if(sizeof($items) != 0)
                                <div class="data">
                                @foreach($items as $item)

                                    {{--                Pokud má item nastaveno availability na 1 zoobrazí se, pokud ne z nemožní se sním práce pro uživatel--}}

                                    @if($item->availability  == 1 )
                                            <div class="item" >
                                    @else
                                        @if($permition[0]->edit_item == 1)
                                                        <div class="item hiddenItem ">
                                                @else
                                                        <div class="item" hidden>
                                            @endif
                                    @endif
                                            <form  class="itemDataDiv">
                                                @csrf

                                                <div class="itemDataDivRow">
                                                <label class="title font-weight-bold" for="name">Název: </label>
                                                <input class="name" value="{{$item->name}}" name="name"
                                                       @if( $permition[0]->edit_item != 1) disabled @endif
                                                       oninput="showButton(this)" required>
                                                </div>

                                                <div class="itemDataDivRow">
                                                <label class="title font-weight-bold" for="note">Poznámka: </label>
                                                <input class="note" value="{{$item->note}}" name="note"
                                                       @if( $permition[0]->edit_item != 1) disabled @endif
                                                       oninput="showButton(this)">
                                                </div>
                                                    <div class="itemDataDivRow">
                                                <label class="title font-weight-bold" for="place">Místo: </label>
                                                <input class="place" value="{{$item->place}}" name="place"
                                                       @if( $permition[0]->edit_item != 1) disabled @endif
                                                       oninput="showButton(this)">
                                                    </div>
                                                        <div class="itemDataDivRow">
                                                <label class="title font-weight-bold" for="inventory_number">Inventární číslo: </label>
                                                <input class="inventory_number" name="inventory_number"
                                                       value="{{$item->inventory_number}}"
                                                       @if( $permition[0]->edit_item != 1) disabled @endif
                                                       oninput="showButton(this)">
                                                        </div>



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

                                                            <div class="buttonsDiv">
                                                                <div class="buttonsDivItem">
                                                                    <button type="submit button" class="btn btn-primary w-200p buttonsDivItem" onclick="saveItemLoansData(this); return false;">
                                                                        <div id="buttonText">Vypůjčit</div>
                                                                        <div id="buttonLoading" class="spinner-grow text-light" role="status" hidden></div>
                                                                    </button>
                                                                </div>

                                                @if( $permition[0]->edit_item == 1)

                                                    <div class="buttonsDivItem">
                                                        <button type="submit button" class="btn btn-danger w-200p buttonsDivItem" onclick="removeItem(this, '{{$item->id}}'); return false;">
                                                            <div id="removeText">Smazat</div>
                                                            <div id="removeLoading" class="spinner-grow text-light" role="status" hidden></div>
                                                        </button>
                                                    </div>
                                                @endif

                                                @if( $permition[0]->possibility_renting == 1)
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
                                          +              >
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


</x-app-layout>


