@section('title',"Všechny výpůjčky")
@section('css', URL::asset('css/loans-default.css'))
@section('css2', URL::asset('css/loans-button-name.css'))

<x-app-layout>

    <x-slot name="header"></x-slot>
    <script src="/js/main.js"></script>
    <script src="/js/returnLoan.js"></script>
    <script src="/js/loans-search.js"></script>
    <script src="/js/cleare-loans-history.js"></script>

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
                        </div>
                    @endif


                                <div class="hlavicka pt-4">
                                    <div class="pageTitleSearch mb-4">Všechny výpůjčky</div>
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

                                                    <button class="btn btn-lg btn-success searchButton" type="submit" onclick="loanFind(this)">Najít</button>
                                                    <button class="btn btn-lg btn-primary searchButton" data-sort="none" sort="desc" onclick="loansSort(this, 'waitingLoans', 'activeLoans', 'historyLoans')">&#8681;</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            <div class="align-content-center d-sm-flex rounded-4 overflow-hidden flex-flow-column flex-sm-flow-row mb-4">

                                <button class="btn btn-warning align-content- text-center flex-fill rounded-0" type="button" onclick="showCard('waitingLoans','show')">

                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="iconSvg bi bi-clock"
                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm8-7A8 8 0 1 1 0 8a8 8 0 0 1 16 0z"/>
                                        <path fill-rule="evenodd"
                                              d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                    Čekající na schválení: {{count($waitingLoans)}}
                                </button>

                                <button class="btn btn-success flex-fill rounded-0 text-white" type="button" onclick="showCard('activeLoans','show')">

                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class=" iconSvg bi bi-check-circle text-white"
                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path fill-rule="evenodd"
                                              d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
                                    </svg>

                                    Všechny aktivní: {{count($activeLoans)}}
                                </button>

                                <button class="btn btn-danger flex-fill rounded-0" type="button" onclick="showCard('historyLoans','show')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-hourglass-bottom iconSvg" viewBox="0 0 16 16">
                                        <path
                                            d="M2 1.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1-.5-.5zm2.5.5v1a3.5 3.5 0 0 0 1.989 3.158c.533.256 1.011.791 1.011 1.491v.702s.18.149.5.149.5-.15.5-.15v-.7c0-.701.478-1.236 1.011-1.492A3.5 3.5 0 0 0 11.5 3V2h-7z"/>
                                    </svg>

                                    Historie výpůjček: {{count($historyLoans)}}
                                </button>

                            </div>



                            <div class="collapse waitingLoans" id="waitingLoans">


                                    @php
                                        $lastCategory = -1;
                                        $lastItem = -1;
                                    @endphp

                                    @if(count($waitingLoans)==0)
                                        <div class="emptyElementLoans">Aktuálně tu nemáme žádné záznamy</div>
                                    @endif

                        @foreach($waitingLoans as $loan)

{{--                            aktuální kategorie není stejná jako poslední--}}
                            @if($loan->categoryId != $lastCategory) {{-- Začátek Divu kategorie--}}
                                @if($lastCategory != -1)  {{-- Poslední kategorie není -1 pro první záznam--}}
                                    </div></div>
                                @endif
                                <div class="categoryDiv" categoryID="{{$loan->categoryId}}">
                                <div class="h4 categoryName" >{{$loan->categoryName}}</div>

                            @endif


                        @if($loan->itemId != $lastItem) {{-- Začátek Divu Itemu--}}

                                @if($lastItem != -1 && $lastCategory != -1 && $loan->categoryId != $lastCategory)
                                    </div>
                                @endif

                                <div class="itemDiv">
                                <label class="title font-weight-bold" for="itemName">Název: </label>
                                <div class="itemName">{{$loan->itemName}}</div>

                                @if($loan->note != "")
                                    <label class="title font-weight-bold" for="itemNote">Poznámka: </label>
                                    <div class="itemNote">{{$loan->note}}</div>
                                @endif

                                @if($loan->place != "")
                                    <label class="title font-weight-bold" for="itemPlace">Místo: </label>
                                    <div class="itemPlace">{{$loan->place}}</div>
                                @endif

                                @if($loan->inventory_number != "")
                                    <label class="title font-weight-bold" for="itemInventory_number">Inventární číslo: </label>
                                    <div class="itemInventory_number">{{$loan->inventory_number}}</div>
                                @endif
                        @endif

                    <form action="{{'/loans/' . $loan->id .'/return'}}" method="POST"
                                  class="loanRecordBox loan">
                                @csrf

                        <div class="icon"
                            @php
                                $start = strtotime($loan->rent_from);
                                $end = strtotime($loan->rent_to);
                                $now = strtotime("now");

                                if($now < $start){
                                    echo 'title="Výpůjčka zatím není aktivní"';
                                }elseif ($now >= $start && $now <= $end){
                                    echo 'title="Výpůjčka je právě aktivní"';
                                }else{
                                    echo 'title="Již je po termínu!"';
                                }

                            echo ">";

                                if($now < $start){
                                    echo '
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check iconSvg" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
                                </svg>';
                                }elseif ($now >= $start && $now <= $end){
                                    echo '
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clock iconSvg" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                      <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm8-7A8 8 0 1 1 0 8a8 8 0 0 1 16 0z"/>
                                      <path fill-rule="evenodd" d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                    ';
                                }else{
                                    echo '
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-exclamation-diamond-fill iconSvg" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                      <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                    </svg>
                                    ';
                                }

                            @endphp
                        </div>


                        @if(Auth::permition()->new_user == 1)
                            <a href="/users/{{$loan->userId}}" class="userNameLink">
                                <label class="font-weight-bold userNameLabel cursor-pointer ">{{$loan->userName}} {{$loan->userSurname}}</label>
                            </a>
                        @else
                            <label class="font-weight-bold userNameLabel userName ">{{$loan->userName}} {{$loan->userSurname}}</label>
                        @endif

                        <div class="userData">
                        <div class="rentFromDiv">
                            <label for="rent_from" class="font-weight-bold">OD: </label>
                            <label class="rent_from">{{date("d. m. Y", strtotime($loan->rent_from))}}</label>
                        </div>
                        <div class="rentToDiv">
                            <label for="rent_to" class="font-weight-bold">DO: </label>
                            <label class="rent_to">{{date("d. m. Y", strtotime($loan->rent_to))}}</label>
                        </div>
                        <br>
                        <input type="text" class="d-none" name="loanId"
                               value="{{$loan->id}}">
                        </div>

                        <div class="submitButtonDiv">
                                    <button type="button"  class="btn submitButton
                                @if($loan->status == 1)
                                        btn-success
                                @else
                                        btn-warning
                                @endif

                                        "

                                            @if($loan->userId == Auth::user()->id || Auth::permition()->return_verification == 1)
                                                @if($loan->status == 1)
                                                onmouseover="hoverChange(this,'status','Probíhá','Zrušit rezervaci','btn-success','btn-danger')"
                                                    @if(Auth::permition()->return_verification == 1)
                                                    onclick="vrsNotify('Opravdu chcete zrušit rezervaci?',returnLoan, this,'{{$loan->id}}' ); return false"
                                                    @else
                                                    onclick="returnLoan(this, '{{$loan->id}}')"
                                                    @endif
                                                @else

                                                        @if(Auth::permition()->return_verification == 1)
                                                        onclick="vrsNotify('Opravdu chcete potvrdit odevzdání?',returnLoan, this,'{{$loan->id}}' ); return false"
                                                        @else
                                                        onclick="returnLoan(this, '{{$loan->id}}')"
                                                        @endif
                                                    onmouseover="hoverChange(this,'status','Čekání na schválení','Potvrdit odevzdání','btn-warning','btn-success')"

                                            @endif


                                        @endif>

                                        <div id="buttonText">
                                            @if($loan->status == 1)
                                                Probíhá
                                            @else
                                                Čekání na schválení
                                            @endif
                                        </div>
                                        <div id="buttonHoverText">
                                            @if($loan->status == 1)
                                                kliknutím zrušíte rezervaci
                                            @else
                                                @if(Auth::permition()->return_verification == 1)
                                                    kliknutím potvrdíte odevzdání
                                                @else
                                                    kliknutím zrušíte odevzdání
                                                @endif

                                            @endif
                                        </div>

                                        <div id="buttonLoading" class="spinner-grow text-light" role="status" hidden></div>

                                    </button>
                                </div>

                    </form>
                        @php
                            $lastCategory = $loan->categoryId;
                            $lastItem = $loan->itemId;
                        @endphp



                        @endforeach

                        @if(count($waitingLoans)!=0)
        </div></div>
                        @endif


        </div>


        {{--    Copie codu jako předtím, poze se změní v foreachy pole ze kterého se načítají data--}}
        <div class="collapse activeLoans" id="activeLoans">

                @php
                    $lastCategory = -1;
                    $lastItem = -1;
                @endphp
                @if(count($activeLoans)==0)
                    <div class="emptyElementLoans">Aktuálně tu nemáme žádné záznamy</div>
                @endif
                @foreach($activeLoans as $loan)

                    @if($loan->categoryId != $lastCategory) {{-- Začátek Divu kategorie--}}
                    @if($lastCategory != -1)
            </div>
        </div>
        @endif
        <div class="categoryDiv" categoryID="{{$loan->categoryId}}">

            <div class="h4 categoryName" >{{$loan->categoryName}}</div>

            @endif


            @if($loan->itemId != $lastItem) {{-- Začátek Divu Itemu--}}
            @if($lastItem != -1 && $loan->categoryId == $lastCategory)
        </div>
        @endif
        <div class="itemDiv ">
            <label class="title font-weight-bold" for="itemName">Název: </label>
            <div class="itemName">{{$loan->itemName}}</div>

            @if($loan->note != "")
                <label class="title font-weight-bold" for="itemNote">Poznámka: </label>
                <div class="itemNote">{{$loan->note}}</div>
            @endif

            @if($loan->place != "")
                <label class="title font-weight-bold" for="itemPlace">Místo: </label>
                <div class="itemPlace">{{$loan->place}}</div>
            @endif

            @if($loan->inventory_number != "")
                <label class="title font-weight-bold" for="itemInventory_number">Inventární číslo: </label>
                <div class="itemInventory_number">{{$loan->inventory_number}}</div>
            @endif
            @endif

            <form action="{{'/loans/' . $loan->id .'/return'}}" method="POST" class="loanRecordBox">
                @csrf

                <div class="icon"
            @php
                $start = strtotime($loan->rent_from);
                $end = strtotime($loan->rent_to);
                $now = strtotime("now");

                if($now < $start){
                    echo 'title="Výpůjčka zatím není aktivní"';
                }elseif ($now >= $start && $now <= $end){
                    echo 'title="Výpůjčka je právě aktivní"';
                }else{
                    echo 'title="Již je po termínu!"';
                }

            echo ">";

                if($now < $start){
                    echo '
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check iconSvg" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
                </svg>';
                }elseif ($now >= $start && $now <= $end){
                    echo '
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clock iconSvg" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm8-7A8 8 0 1 1 0 8a8 8 0 0 1 16 0z"/>
                      <path fill-rule="evenodd" d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                    </svg>
                    ';
                }else{
                    echo '
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-exclamation-diamond-fill iconSvg" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                    </svg>
                    ';
                }

            @endphp


        </div>


        @if(Auth::permition()->new_user == 1)
            <a href="/users/{{$loan->userId}}" class="userNameLink">
                <label class="font-weight-bold userNameLabel cursor-pointer ">{{$loan->userName}} {{$loan->userSurname}}</label>
            </a>
        @else
            <label class="font-weight-bold userNameLabel userName ">{{$loan->userName}} {{$loan->userSurname}}</label>
        @endif

    <div class="userData">
            <div class="rentFromDiv">
                <label for="rent_from" class="font-weight-bold">OD: </label>
                <label class="rent_from">{{date("d. m. Y", strtotime($loan->rent_from))}}</label>
            </div>
            <div class="rentToDiv">
                <label for="rent_to" class="font-weight-bold">DO: </label>
                <label class="rent_to">{{date("d. m. Y", strtotime($loan->rent_to))}}</label>
            </div>
            <br>
            <input type="text" class="d-none" name="loanId"
                   value="{{$loan->id}}">
        </div>

        <div class="submitButtonDiv">
            <button type="button"  class="btn submitButton
                                @if($loan->status == 1)
                btn-success
@else
                btn-warning
@endif

                "

                @if($loan->userId == Auth::user()->id || Auth::permition()->return_verification == 1)
                    @if($loan->status == 1)
                    onmouseover="hoverChange(this,'status','Probíhá','Zrušit rezervaci','btn-success','btn-danger')"
                        @if(Auth::permition()->return_verification == 1)
                        onclick="vrsNotify('Opravdu chcete zrušit rezervaci?',returnLoan, this,'{{$loan->id}}' ); return false"
                        @else
                        onclick="returnLoan(this, '{{$loan->id}}')"
                        @endif
                    @else
                        @if(Auth::permition()->return_verification == 1)
                            @if(Auth::permition()->return_verification == 1)
                            onclick="vrsNotify('Opravdu chcete potvrdit odevzdání?',returnLoan, this,'{{$loan->id}}' ); return false"
                            @else
                            onclick="returnLoan(this, '{{$loan->id}}')"
                            @endif
                            onmouseover="hoverChange(this,'status','Čekání na schválení','Potvrdit odevzdání','btn-warning','btn-success')"
                        @else
                        onmouseover="hoverChange(this,'status','Čekání na schválení','Zrušit odevzdání','btn-warning','btn-danger')"
                    @endif
                @endif


                @endif>

                <div id="buttonText">
                    @if($loan->status == 1)
                        Probíhá
                    @else
                        Čekání na schválení
                    @endif
                </div>
                <div id="buttonHoverText">
                    @if($loan->status == 1)
                        kliknutím zrušíte rezervaci
                    @else
                        @if(Auth::permition()->return_verification == 1)
                            kliknutím potvrdíte odevzdání
                        @else
                            kliknutím zrušíte odevzdání
                        @endif

                    @endif
                </div>
                <div id="buttonLoading" class="spinner-grow text-light" role="status" hidden></div>

            </button>
        </div>


        </form>
        @php
            $lastCategory = $loan->categoryId;
            $lastItem = $loan->itemId
        @endphp



        @endforeach


    @if(count($activeLoans)!=0)
        </div></div>
        @endif
        </div>

    {{--  Historie výpůjček  --}}
    <div class="collapse historyLoans" id="historyLoans">


            @php
                $lastCategory = -1;
                $lastItem = -1;
            @endphp
            @if(count($historyLoans)==0)
                <div class="emptyElementLoans">Aktuálně tu nemáme žádné záznamy</div>
            @endif
            @foreach($historyLoans as $loan)

                @if($loan->categoryId != $lastCategory) {{-- Začátek Divu kategorie--}}
                @if($lastCategory != -1)
        </div>
    </div>
    @endif
    <div class="categoryDiv" categoryID="{{$loan->categoryId}}">

        <div class="h4 categoryName" >{{$loan->categoryName}}</div>

        @endif


        @if($loan->itemId != $lastItem) {{-- Začátek Divu Itemu--}}
        @if($lastItem != -1 && $loan->categoryId == $lastCategory)
    </div>
    @endif
    <div class="itemDiv ">
        <label class="title font-weight-bold" for="itemName">Název: </label>
        <div class="itemName">{{$loan->itemName}}</div>

        @if($loan->note != "")
            <label class="title font-weight-bold" for="itemNote">Poznámka: </label>
            <div class="itemNote">{{$loan->note}}</div>
        @endif

        @if($loan->place != "")
            <label class="title font-weight-bold" for="itemPlace">Místo: </label>
            <div class="itemPlace">{{$loan->place}}</div>
        @endif

        @if($loan->inventory_number != "")
            <label class="title font-weight-bold" for="itemInventory_number">Inventární číslo: </label>
            <div class="itemInventory_number">{{$loan->inventory_number}}</div>
        @endif
        @endif

        <form  class="loanRecordBox">




        @if(Auth::permition()->new_user == 1)
            <a href="/users/{{$loan->userId}}" class="userNameLink">
                <label class="font-weight-bold userNameLabel cursor-pointer ">{{$loan->userName}} {{$loan->userSurname}}</label>
            </a>
        @else
            <label class="font-weight-bold userNameLabel userName ">{{$loan->userName}} {{$loan->userSurname}}</label>
        @endif

            <div class="userData">
        <div class="rentFromDiv">
            <label for="rent_from" class="font-weight-bold">OD: </label>
            <label class="rent_from">{{date("d. m. Y", strtotime($loan->rent_from))}}</label>
        </div>
        <div class="rentToDiv">
            <label for="rent_to" class="font-weight-bold">DO: </label>
            <label class="rent_to">{{date("d. m. Y", strtotime($loan->rent_to))}}</label>
        </div>
        <br>

    </div>
    <div class="created text-vrs-cyan" date="{{$loan->created}}">
        <b>Archivováno: </b> {{date("d. m. Y", strtotime($loan->created))}}
    </div>


    </form>
    @php
        $lastCategory = $loan->categoryId;
        $lastItem = $loan->itemId;
    @endphp



    @endforeach



        @if(count($historyLoans)!=0)
            </div></div>
        @endif


    @if(count($historyLoans)!=0)
        <button type="submit" class="btn btn-light w-100 text-center align-middle mb-5 mt-1 pt-4 pb-4 fw-bolder text-vrs-clight " onclick="clearLoansHistory(this,'&#8722;','/clearLoansHistory')">
            <span class="d-block w-100 ">Smazat záznamy starší 30 dní</span>
            <div id="buttonText" >&#8722;</div>
            <div class="spinner-grow text-vrs-cyan mb-4 mt-4" id="buttonLoading" hidden></div>
        </button>
    @endif

    </div>




</x-app-layout>


