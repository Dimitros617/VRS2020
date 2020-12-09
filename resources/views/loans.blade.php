@section('title',"Moje výpůjčky")

<x-app-layout>

    <x-slot name="header"></x-slot>
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

            <div class="h1"> Moje aktuální výpůjčky :</div>

            @php
                $lastCategory = -1;
                $lastItem = -1;
            @endphp
            @foreach($loans as $loan)

                @if($loan->categoryId != $lastCategory) {{-- Začátek Divu kategorie--}}
                    @if($lastCategory != -1)
                        </div></div>
                    @endif
                    <div class="categoryDiv bg-light mb-4 ">
                    <div class="h4">{{$loan->categoryName}}</div>

                @endif


                @if($loan->itemId != $lastItem) {{-- Začátek Divu Itemu--}}
                    @if($lastItem != -1 && $loan->categoryId == $lastCategory)
                        </div>
                    @endif
                    <div class="itemDiv">
                    <div class="itemName">{{$loan->itemName}}</div>
                @endif

                        <form action="{{'/loans/' . $loan->id .'/return'}}" method="POST" class="addNewCategory">
                            @csrf
                            <label for="rent_from" class="font-weight-bold">OD: </label>
                                <label class="rent_from">{{$loan->rent_from}}</label>
                            <label for="rent_to" class="font-weight-bold">  -  DO: </label>
                                <label class="rent_to">{{$loan->rent_to}}</label>
                            <br>
                            <input type="text" class="d-none" name="loanId"
                                   value="{{$loan->id}}">

                            @if($loan->status == 1)
                                <button type="submit button" class="btn btn-success " @if(Auth::permition()->return_verification == 1)
                                    onclick=" return confirm('Opravdu to chcete?');"
                                    @endif>Vrátit</button>
                            @else
                                <button type="submit button" class="btn btn-warning " onmouseover="hoverChange(this,'status','Čekání na schválení','Zrušit odevzdání','btn-warning','btn-danger')">Čekání na schválení</button>
                            @endif
                        </form>
                @php
                    $lastCategory = $loan->categoryId;
                    $lastItem = $loan->itemId;
                @endphp



            @endforeach


                </div>
        </div>


</x-app-layout>


