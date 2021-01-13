@section('title',"Moje výpůjčky")
@section('css', URL::asset('css/all-loans.css'))

<x-app-layout>

    <x-slot name="header"></x-slot>
    <script src="/js/main.js"></script>

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


                            <div class="pageTitle"> Aktuální výpůjčky :</div>


                            <div class="align-content-center d-sm-flex rounded-4 overflow-hidden flex-flow-column flex-sm-flow-row mb-4">

                                <button class="btn btn-warning align-content- text-center flex-fill rounded-0" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#waitingLoans" aria-expanded="false"
                                        aria-controls="waitingLoans">

                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="iconSvg bi bi-clock"
                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm8-7A8 8 0 1 1 0 8a8 8 0 0 1 16 0z"/>
                                        <path fill-rule="evenodd"
                                              d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                    Čekající na schválení
                                </button>

                                <button class="btn btn-success flex-fill rounded-0" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#activeLoans" aria-expanded="false" aria-controls="activeLoans">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class=" iconSvg bi bi-check-circle"
                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path fill-rule="evenodd"
                                              d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
                                    </svg>

                                    Všechny aktivní
                                </button>

                                <button class="btn btn-danger flex-fill rounded-0" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#historyLoans" aria-expanded="false"
                                        aria-controls="historyLoans">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-hourglass-bottom iconSvg" viewBox="0 0 16 16">
                                        <path
                                            d="M2 1.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1-.5-.5zm2.5.5v1a3.5 3.5 0 0 0 1.989 3.158c.533.256 1.011.791 1.011 1.491v.702s.18.149.5.149.5-.15.5-.15v-.7c0-.701.478-1.236 1.011-1.492A3.5 3.5 0 0 0 11.5 3V2h-7z"/>
                                    </svg>

                                    Historie Výpůjček
                                </button>

                            </div>



                            <div class="collapse" id="waitingLoans">
                                <div class="mb-2">

                                    @php
                                        $lastCategory = -1;
                                        $lastItem = -1;
                                    @endphp

                                    @if(count($waitingLoans)==0)
                                        <div class="emptyElementLoans">Aktuálně tu nemáme žádné záznamy</div>
                                    @endif

                        @foreach($waitingLoans as $loan)

                            @if($loan->categoryId != $lastCategory) {{-- Začátek Divu kategorie--}}
                                @if($lastCategory != -1)
                                    </div></div>
                                @endif
                                <div class="categoryDiv">
                                <div class="h4">{{$loan->categoryName}}</div>

                            @endif


                            @if($loan->itemId != $lastItem) {{-- Začátek Divu Itemu--}}
                            @if($lastItem != -1 && $loan->categoryId == $lastCategory)
                        </div>
                        @endif
                        <div class="itemDiv">
                            <label class="title font-weight-bold" for="itemName"> Název :</label>
                            <div class="itemName">{{$loan->itemName}}</div>

                            @if($loan->note != "")
                                <label class="title font-weight-bold" for="itemNote"> Poznámka :</label>
                                <div class="itemNote">{{$loan->note}}</div>
                            @endif

                            @if($loan->place != "")
                                <label class="title font-weight-bold" for="itemPlace"> Místo :</label>
                                <div class="itemPlace">{{$loan->place}}</div>
                            @endif

                            @if($loan->inventory_number != "")
                                <label class="title font-weight-bold" for="itemInventory_number"> Inventární číslo
                                    :</label>
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
                                    echo 'title="Již je po termínu, měly by jste položku vrátit"';
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

                        <div class="userData">
                        <a href="/users/{{$loan->userId}}" class="userNameLink">
                            <label class="font-weight-bold userName cursor-pointer">{{$loan->userName}}</label>

                            <label class="font-weight-bold userSurname cursor-pointer">{{$loan->userSurname}} </label>

                        </a>

                            <div class="rentFromDiv">
                        <label for="rent_from" class="font-weight-bold">OD: </label>
                        <label class="rent_from">{{$loan->rent_from}}</label>
                            </div>
                            <div class="rentToDiv">
                        <label for="rent_to" class="font-weight-bold">DO: </label>
                        <label class="rent_to">{{$loan->rent_to}}</label>
                            </div>
                        <br>
                        <input type="text" class="d-none" name="loanId"
                               value="{{$loan->id}}">
                        </div>

                                <div class="submitButtonDiv">
                        <button type="submit button" class="btn btn-warning submitButton"
                                onmouseover="hoverChange(this,'status','Čekání na schválení','Potvrdit odevzdání','btn-warning','btn-success')"
                                @if(Auth::permition()->return_verification == 1)
                                onclick=" return confirm('Opravdu to chcete?');"
                            @endif>
                            Čekání na schválení
                        </button>
                                </div>

                        </form>
                        @php
                            $lastCategory = $loan->categoryId;
                            $lastItem = $loan->itemId;
                        @endphp



                        @endforeach

                    </div>
        </div>


        {{--    Copie codu jako předtím, poze se změní v foreachy pole ze kterého se načítají data--}}
        <div class="collapse" id="activeLoans">
            <div class="mb-2">

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
        <div class="categoryDiv">

            <div class="h4">{{$loan->categoryName}}</div>

            @endif


            @if($loan->itemId != $lastItem) {{-- Začátek Divu Itemu--}}
            @if($lastItem != -1 && $loan->categoryId == $lastCategory)
        </div>
        @endif
        <div class="itemDiv ">
            <label class="title font-weight-bold" for="itemName"> Název :</label>
            <div class="itemName">{{$loan->itemName}}</div>

            @if($loan->note != "")
                <label class="title font-weight-bold" for="itemNote"> Poznámka :</label>
                <div class="itemNote">{{$loan->note}}</div>
            @endif

            @if($loan->place != "")
                <label class="title font-weight-bold" for="itemPlace"> Místo :</label>
                <div class="itemPlace">{{$loan->place}}</div>
            @endif

            @if($loan->inventory_number != "")
                <label class="title font-weight-bold" for="itemInventory_number"> Inventární číslo
                    :</label>
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
                    echo 'title="Již je po termínu, měly by jste položku vrátit"';
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

        <div class="userData">
            <a href="/users/{{$loan->userId}}" class="userNameLink">
                <label class="font-weight-bold userName">{{$loan->userName}}</label>

                <label class="font-weight-bold userSurname">{{$loan->userSurname}} </label>

            </a>

            <div class="rentFromDiv">
                <label for="rent_from" class="font-weight-bold">OD: </label>
                <label class="rent_from">{{$loan->rent_from}}</label>
            </div>
            <div class="rentToDiv">
                <label for="rent_to" class="font-weight-bold">DO: </label>
                <label class="rent_to">{{$loan->rent_to}}</label>
            </div>
            <br>
            <input type="text" class="d-none" name="loanId"
                   value="{{$loan->id}}">
        </div>

        <div class="submitButtonDiv">
        <button type="submit button" class="btn btn-success submitButton "
                onmouseover="hoverChange(this,'status','Probíhá','Zrušit rezervaci','btn-success','btn-danger')"
                @if(Auth::permition()->return_verification == 1)
                onclick=" return confirm('Opravdu to chcete?');"
            @endif>
            Probíhá
        </button>
        </div>
        </form>
        @php
            $lastCategory = $loan->categoryId;
            $lastItem = $loan->itemId
        @endphp



        @endforeach

    </div>
    </div> </div> </div>

    {{--  Historie výpůjček  --}}
    <div class="collapse" id="historyLoans">
        <div class="mb-2">

            <div class="emptyElementLoans">Aktuálně tu nemáme žádné záznamy</div>
        </div>
    </div>

    </div>
    </div>


</x-app-layout>


