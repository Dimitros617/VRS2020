@section('title',$item->name)

<x-app-layout>
    <x-slot name="header"></x-slot>

    <script src="/js/main.js"></script>
    <script src="/js/datePicker.js"></script>
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

            <div class="allLoans">


                <div class="h1"> Položka {{$item->name}} je v závazku s těmito uživately:</div>

                <div class="list-group">

                    @if(count($users) == 0)
                        <div class="nothing"> Tatuto položka není vypůjčená ani rezervovaná</div>
                    @endif

                    @foreach($users as $user)
                        <div class="user">
                            <form action="{{'/loans/' . $user->loanId .'/return'}}" method="POST" class="loan">
                                @csrf
                                <input type="text" class="d-none" name="loanId"
                                       value="{{$user->loanId}}">
                        <a href="/users/{{$user->id}}" class="">

                            <div
                                class="userName text-uppercase font-weight-bold ">{{$user->name}} {{$user->surname}}</div>
                        </a>
                            <div class="loanFrom"><label>OD: </label>{{$user->rent_from}}</div>
                            <div class="loanTo"><label>DO: </label>{{$user->rent_to}}</div>

                            @if($user->id == 1)
                                <button type="submit button" class="btn btn-success "
                                        onmouseover="hoverChange(this,'status','Probíhá','Zrušit rezervaci','btn-success','btn-danger')"
                                        @if(Auth::permition()->return_verification == 1)
                                        onclick=" return confirm('Opravdu to chcete?');"
                                    @endif>
                                    Probíhá
                                </button>
                            @else
                                <button type="submit button" class="btn btn-warning "
                                        onmouseover="hoverChange(this,'status','Čekání na schválení','Potvrdit odevzdání','btn-warning','btn-success')"
                                        @if(Auth::permition()->return_verification == 1)
                                        onclick=" return confirm('Opravdu to chcete?');"
                                    @endif>
                                    Čekání na schválení
                                </button>
                            @endif
                            </form>
                        </div>


                    @endforeach
                </div>

            </div>

        </div>
    </div>


</x-app-layout>


