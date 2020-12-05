@section('title',$category->name)

<x-app-layout>
    <x-slot name="header"></x-slot>

    <script src="/js/datePicker.js"></script>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="container">

            <h1>{{$category['name']}}</h1>
            <br>
            <p>{{$category['description']}}</p>
            <br>


            <div class="data">
                @foreach($items as $item)

                    {{--                Pokud má item nastaveno availability na 1 zoobrazí se, pokud ne z nemožní se sním práce pro uživatel--}}

                    @if($item->availability  == 1)
                        <form action="{{'/saveCategoryData'}}" method="POST" class="item">
                            @else
                                <form action="{{url()->current().'/'. 'saveCategoryData'}}" method="POST" class="item">
                                    @endif
                                    @csrf
                                    <div class="name">
                                        {{$item->name}}
                                    </div>

                                    <div class="note">
                                        {{$item->note}}
                                    </div>

                                    <div class="place">
                                        {{$item->place}}
                                    </div>

                                    <div class="inventory_number">
                                        {{$item->inventory_number}}
                                    </div>

                                    <input type="text" class="d-none" name="itemId" value="{{$item->id}}">

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

                                    <div class="dateReservation" data="{{$text}}">
                                        <div class="reserveFromDiv">
                                            <label>Od:</label>
                                            <input class="date reserveFrom border" type="text" class="reserveFrom"
                                                   name="rent_from" nameDB="{{$item->name}}"
                                                   onchange="changeFrom(this)"
                                                   onclick="showDate(this)">
                                        </div>

                                        <div class="reserveToDiv">
                                            <label>Do:</label>
                                            <input class="date reserveTo border" type="text" class="reserveTo"
                                                   name="rent_to" nameDB="{{$item->name}}"
                                                   onchange="changeTo(this)"
                                                   onclick="showDate(this)">
                                        </div>
                                    </div>

                                    <br>
                                    <input class="btn btn-primary" type="submit" value="Uložit">
                                </form>
                                <hr>
                        @endforeach

            </div>
        </div>


</x-app-layout>


