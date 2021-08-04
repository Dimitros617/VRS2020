@section('title',"$item->name")
@section('css', URL::asset('css/category.css'))
@section('css2', URL::asset('css/loans-button-name.css'))

<x-app-layout>
    <x-slot name="header"></x-slot>

    <script src="/js/main.js"></script>
    <script src="/js/datePicker.js"></script>
    <script src="/js/item-search.js"></script>
    <script src="/js/categorySaves.js"></script>
    <script src="/js/remove.js"></script>
<div class="data" id="data">

<div class="bg-white overflow-hidden shadow-xl p-3 sm:rounded-lg max-w-7xl mx-auto sm:px-8 lg:px-8">

<div class="container p-6">
{{-- Pokud má item nastaveno availability na 1 zoobrazí se, pokud ne znemožní se sním práce pro uživatel --}}

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

            @if( $permition[0]->edit_item == 1)
            <div class="itemDataDivRow">
            {{-- Atribut for ponechan, nema vetsi smysl to prepisovat na price a sahat do css, kdyz zde nejsou inputy, ktere by se po kliku na label automaticky focusovaly. S divem to bohuzel nefunguje. --}}
            <label class="title font-weight-bold" for="note">Cena [Kč]:</label>
            <div contenteditable class="note" value="{{$item->price}}" name="price"
                   oninput="showButton(this)" required>{{ number_format($item->price, 2, ".", " ") }}
            </div>
            </div>

            <div class="itemDataDivRow">
            <label class="title font-weight-bold" for="note">Zavedeno dne:</label>
            <div contenteditable class="note" value="{{ strtotime($item->created_at) }}" name="created_at"
                   oninput="showButton(this)" required>{{ \Carbon\Carbon::parse($item->created_at)->format('j. n. Y') }}
            </div></div>
            @endif

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
                    {{--onload="initDate(this)"--}}
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
</div>
</div>
</x-app-layout>