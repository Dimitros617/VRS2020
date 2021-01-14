@section('title',$item->name)
@section('css', URL::asset('css/item-status.css'))

<x-app-layout>
    <x-slot name="header"></x-slot>

    <script src="/js/main.js"></script>
    <script src="/js/datePicker.js"></script>
    <script src="/js/returnLoan.js"></script>

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

            <div class="allLoans">


                <div class="pageTitle"> Položka {{$item->name}} je v závazku s těmito uživateli:</div>

                <div class="list-group">

                    @if(count($users) == 0)
                        <div class="emptyElementLoans"> Tato položka není vypůjčená ani rezervovaná</div>
                    @endif

                    @foreach($users as $user)
                        <div class="user">
{{--                            action="{{'/loans/' . $user->loanId .'/return'}}" method="POST"--}}
                            <form  class="loanRecordBox">
                                @csrf
                                <input type="text" class="d-none" name="loanId"
                                       value="{{$user->loanId}}">


                                <div class="icon"
                            @php
                                $start = strtotime($user->rent_from);
                                $end = strtotime($user->rent_to);
                                $now = strtotime("now");

                                if($now < $start){
                                    echo 'title="Výpůjčka zatím není aktivní"';
                                }elseif ($now >= $start && $now <= $end){
                                    echo 'title="Výpůjčka je právě aktivní"';
                                }else{
                                    echo 'title="Již je po termínu, měli by jste položku vrátit"';
                                }

                            echo ">";

                                if($now < $start){
                                    echo '
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi- iconSvg" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
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


                        <a href="/users/{{$user->id}}" class="userNameLink">

                            <label class="cursor-pointer">{{$user->name}} {{$user->surname}}</label>
                        </a>
                            <div class="rentFromDiv">
                                <label for="rent_from" class="font-weight-bold">OD: </label>
                                <label class="rent_from">{{$user->rent_from}}</label>
                            </div>
                            <div class="rentToDiv">
                                <label for="rent_to" class="font-weight-bold">DO: </label>
                                <label class="rent_to">{{$user->rent_to}}</label>
                            </div>


                                <div class="submitButtonDiv">
                                <button type="button"  class="btn submitButton
                                @if($user->status == 1)
                                    btn-success
                                @else
                                    btn-warning
                                @endif

                                @if($user->id == Auth::user()->id)
                                    buttonOwner
                                @endif
                                "

                                   @if($user->id == Auth::user()->id || Auth::permition()->return_verification == 1)
                                        @if($user->status == 1)
                                            onmouseover="hoverChange(this,'status','Probíhá','Zrušit rezervaci','btn-success','btn-danger')"
                                        @else
                                            @if(Auth::permition()->return_verification == 1)
                                                onmouseover="hoverChange(this,'status','Čekání na schválení','Potvrdit odevzdání','btn-warning','btn-success')"
                                            @else
                                                onmouseover="hoverChange(this,'status','Čekání na schválení','Zrušit odevzdání','btn-warning','btn-danger')"
                                            @endif
                                        @endif

                                        onclick=" returnLoan(this, '{{$user->loanId}}')"

                                    @endif>

                                    <div id="buttonText">
                                    @if($user->status == 1)
                                        Probíhá
                                    @else
                                        Čekání na schválení
                                    @endif
                                    </div>

                                    <div id="buttonLoading" class="spinner-grow text-light" role="status" hidden></div>

                                </button>
                                </div>

                            </form>
                        </div>


                    @endforeach
                </div>

            </div>

        </div>
    </div>


</x-app-layout>


