@section('title',"Všechny výpůjčky")
@section('css', URL::asset('css/permition.css'))


<x-app-layout>

    <x-slot name="header"></x-slot>
    <script src="/js/main.js"></script>
    <script src="/js/permition.js"></script>
    <script src="/js/permition-save.js"></script>

    <div class="bg-white overflow-hidden shadow-xl pb-5 sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">

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

            <div class="pageTitle"> Uživatelská oprávnění</div>

            <div class="list-group my-list-group" id="myList permitionList" role="tablist">

                @foreach($permitions as $permition)

                <a class="list-group-item list-group-item-action list-name my-list-group-item" permitionId="{{$permition->id}}" data-toggle="list" role="tab" onclick="showPanel({{$permition->id}})">{{$permition->name}}</a>

                @endforeach
                    <form action="/addPermition" method="POST" id="addPermitionForm">
                        @csrf
                <a type="submit" metod="POST" class="list-group-item list-group-item-action list-name my-list-group-item my-list-group-item-add" data-toggle="list" role="tab" onclick="document.getElementById('addPermitionForm').submit()">Přidat nové oprávnění +</a>
                    </form>

            </div>

            <div class="tab-content">

                @foreach($permitions as $permition)

                <div class="tab-pane" id="panel-{{$permition->id}}" role="tabpanel">

                    <form action="/savePermitionData" method="POST" id="savePermitionData">
                        @csrf
                    <div  class="vrs-h2 text-vrs-cyan" contenteditable>
                        {{$permition->name}}
                        <input type="text" name="permition_name" value="{{$permition->name}}" hidden>
                    </div>


                    <div class="my_row">
                        <input type="text" id="possibility_renting{{$permition->id}}" name="possibility_renting" value="{{$permition->possibility_renting}}" hidden>
                        <input name="possibility_renting" type="checkbox" data-width="150"  data-toggle="toggle" data-onstyle="danger" data-on=" ANO " data-off=" NE " @if($permition->possibility_renting == 1) checked @endif onchange="changeSwitch(this, 'possibility_renting{{$permition->id}}')">
                        <label for="possibility_renting">Možnost vypůjčky</label>
                    </div>

                    <div class="my_row">
                        <input type="text" id="new_user{{$permition->id}}" name="new_user" value="{{$permition->new_user}}" hidden>
                        <input name="new_user" type="checkbox" data-width="150"  data-toggle="toggle" data-onstyle="danger" data-on=" ANO " data-off=" NE " @if($permition->new_user == 1) checked @endif >
                        <label for="new_user">Schvalování nových uživatelů</label>
                    </div>

                    <div class="my_row">
                        <input type="text" id="return_verification{{$permition->id}}" name="return_verification" value="{{$permition->return_verification}}" hidden>
                        <input name="return_verification" type="checkbox" data-width="150"  data-toggle="toggle" data-onstyle="danger" data-on=" ANO " data-off=" NE " @if($permition->return_verification == 1) checked @endif >
                        <label for="return_verification">Schvalování výpůjček</label>
                    </div>

                    <div class="my_row">
                        <input type="text" id="edit_item{{$permition->id}}" name="edit_item" value="{{$permition->edit_item}}" hidden>
                        <input name="edit_item" type="checkbox" data-width="150"  data-toggle="toggle" data-onstyle="danger" data-on=" ANO " data-off=" NE " @if($permition->edit_item == 1) checked @endif >
                        <label for="edit_item">Správa položek a kategorií</label>
                    </div>

                    <div class="my_row">
                        <input type="text" id="edit_permitions{{$permition->id}}" name="edit_permitions" value="{{$permition->edit_permitions}}" hidden>
                        <input name="edit_permitions" type="checkbox" data-width="150"  data-toggle="toggle" data-onstyle="danger" data-on=" ANO " data-off=" NE " @if($permition->edit_permitions == 1) checked @endif >
                        <label for="edit_permitions">Správa ověření</label>
                    </div>

                    </form>

                    <div class="button-row">
                        <div class="buttonsDiv">
                            <div class="buttonsDivItem">
                                <button type="submit button" class="buttonsDivItem submit btn btn-danger w-200p float-end p-2  w-10rem text-white" >
                                    <div id="buttonText">Smazat oprávnění</div>
                                    <div id="buttonLoading" class="spinner-grow text-light" role="status" hidden></div>
                                </button>
                            </div>

                            <div class="buttonsDivItem">
                                <button type="submit button" class="buttonsDivItem submit btn btn-primary w-200p float-end p-2 w-10rem text-white" onclick="savePermitionData(this)">
                                    <div id="buttonText">Uložit změny</div>
                                    <div id="buttonLoading" class="spinner-grow text-light" role="status" hidden></div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach

            </div>



        </div>
    </div>


</x-app-layout>


