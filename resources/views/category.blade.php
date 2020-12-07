@section('title',$category->name)

<x-app-layout>
    <x-slot name="header"></x-slot>

    <script src="/js/datePicker.js"></script>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="container">


            @if(old('saveCheck'))
                @if(old('saveCheck') == 1)
                    <div id="autoHide" class="alert-success">
                        Uloženo
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
                                    <div class="item">
                                    @if($item->availability  == 1)
                                            <div class="item" >
                                    @else
                                            <div class="item" hidden>
                                            @endif
                                            <form action="{{'/saveItemData'}}" method="POST" class="item">
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
                                            <form action="{{'/saveItemLoansData'}}" method="POST" class="item">
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
                                            <hr>
                                        </div>
                                        @endforeach

                            </div>
                    </div>


</x-app-layout>


