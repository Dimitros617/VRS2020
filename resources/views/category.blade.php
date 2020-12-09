@section('title',$category->name)

<x-app-layout>
    <x-slot name="header"></x-slot>

    <script src="/js/datePicker.js"></script>
    <script src="/js/main.js"></script>
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
                            {{--                        Pokud má uživatel oprávnění upravovat itemy--}}

                            @if( $permition[0]->edit_item == 1)
                                <form action="{{'/saveCategoryData'}}" method="POST" class="item">
                                    @csrf
                                    <input type="number" value="{{$category['id']}}" name="categoryId" hidden>
                                    <input type="text" class="nadpis h1" value="{{$category['name']}}"
                                           name="categoryName" oninput="showButton(this)">
                                    <br>
                                    <textarea class="popisek " name="categoryDescription" method="POST"
                                              oninput="showButton(this)">{{$category['description']}}</textarea>
                                    <br>
                                    <input class="btn btn-primary" type="submit" value="Uložit změny" hidden>
                                </form>
                                {{--                            Pouze je navíc atribut disabled u prvků aby do nic uživatel nemohl psát    --}}
                            @else
                                <input type="text" class="nadpis h1" value="{{$category['name']}}" disabled>
                                <br>
                                <textarea class="popisek " disabled>{{$category['description']}}</textarea>
                                <br>
                            @endif




                            <div class="data">
                                @foreach($items as $item)

                                    {{--                Pokud má item nastaveno availability na 1 zoobrazí se, pokud ne z nemožní se sním práce pro uživatel--}}

                                    @if($item->availability  == 1 )
                                            <div class="item" >
                                    @else
                                        @if($permition[0]->edit_item == 1)
                                                        <div class="item bg-light ">
                                                @else
                                                        <div class="item" hidden>
                                            @endif
                                    @endif
                                            <form action="{{'/item/' . $item->id . '/saveItemData'}}" method="POST" class="item">
                                                @csrf
                                                <input class="name" value="{{$item->name}}" name="name"
                                                       @if( $permition[0]->edit_item != 1) disabled @endif
                                                       oninput="showButton(this)">


                                                <input class="note" value="{{$item->note}}" name="note"
                                                       @if( $permition[0]->edit_item != 1) disabled @endif
                                                       oninput="showButton(this)">


                                                <input class="place" value="{{$item->place}}" name="place"
                                                       @if( $permition[0]->edit_item != 1) disabled @endif
                                                       oninput="showButton(this)">


                                                <input class="inventory_number" name="inventory_number"
                                                       value="{{$item->inventory_number}}"
                                                       @if( $permition[0]->edit_item != 1) disabled @endif
                                                       oninput="showButton(this)">

                                                <input type="text" class="d-none" name="itemId"
                                                       value="{{$item->id}}">

                                                <input type="text" class="d-none" name="categoriesId"
                                                       value="{{$item->categories}}">

                                                <input type="text" class="d-none" name="availability"
                                                       value="{{$item->availability}}">


                                                <input class="btn btn-primary" type="submit" value="Uložit změny" hidden>
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
                                            <form action="{{'/item/' . $item->id . '/saveItemLoansData'}}" method="POST" class="item">
                                                @csrf
                                                <input type="text" class="d-none" name="itemId"
                                                       value="{{$item->id}}">

                                                <div class="dateReservation" data="{{$text}}">
                                                    <div class="reserveFromDiv">
                                                        <label>Od:</label>
                                                        <input class="date reserveFrom border" type="text"
                                                               class="reserveFrom"
                                                               name="rent_from" nameDB="{{$item->name}}"
                                                               autocomplete="off"
                                                               onchange="changeFrom(this)"
                                                               onclick="showDate(this)">
                                                    </div>

                                                    <div class="reserveToDiv">
                                                        <label>Do:</label>
                                                        <input class="date reserveTo border" type="text"
                                                               class="reserveTo"
                                                               name="rent_to" nameDB="{{$item->name}}"
                                                               autocomplete="off"
                                                               onchange="changeTo(this)"
                                                               onclick="showDate(this)">
                                                    </div>
                                                </div>

                                                <br>
                                                <input class="btn btn-primary" type="submit" value="Vypůjčit">



                                            </form>

                                                @if( $permition[0]->edit_item == 1)
                                                    <form action="{{'/item/' . $item->id . '/removeItem'}}" method="POST" class="itemRemove">
                                                        @csrf
                                                        <input type="text" class="d-none" name="itemId" value="{{$item->id}}">
                                                        <input class="btn btn-danger" type="submit" value="Smazat">
                                                    </form>
                                                @endif

                                                @if( $permition[0]->edit_item == 1)
                                                    <form action="{{'/item/' . $item->id . '/activeLoans'}}" method="POST" class="activeLoans">
                                                         @csrf
                                                         <input type="text" class="d-none" name="itemId" value="{{$item->id}}">
                                                         <input class="btn btn-warning" type="submit" value="Aktuální závazky">
                                                    </form>
                                                @endif

                                                @if( $permition[0]->edit_item == 1)
                                                    <form action="{{'/item/' . $item->id . '/changeItemAvailability'}}" method="POST" class="changeItemAvailability">
                                                         @csrf
                                                        <input type="text" class="d-none" name="itemId" value="{{$item->id}}">
                                                        <input type="text" class="d-none" name="availability" value="{{$item->availability}}">
                                                        @if($item->availability  == 1 )
                                                            <input class="btn btn-success" type="submit" bool="1" value="Viditelné: ANO" onmouseover="hoverChange(this)" onmouseleave="hoverChangeEnd(this)">
                                                        @else
                                                            <input class="btn btn-danger" type="submit" bool="0" value="Viditelné: NE" onmouseover="hoverChange(this)" onmouseleave="hoverChangeEnd(this)">
                                                        @endif
                                                    </form>
                                                @endif

                                            <hr>
                                        </div>
                                        @endforeach


                                                                @if( $permition[0]->edit_item == 1)
                                                                    <div class="item">
                                                                    <form action="{{'/item/addNewItem'}}" method="POST" class="addNewItem">
                                                                        @csrf
                                                                        <input type="text" class="d-none" name="category" value="{{$category->id}}">

                                                                        <button type="submit" class="btn btn-light w-100 text-center align-middle mb-2">
                                                                            Přidat novou položku
                                                                            <h1>&#43;</h1>
                                                                        </button>

                                                                    </form>
                                                                    </div>
                                                                @endif


                    </div>


</x-app-layout>


