@section('title',"Uživatelská oprávnění")
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
                        Role byla úspěšně vytvořena
                        @else
                            <div id="autoHide" class="alert-danger">
                                Ups... Došlo k chybě při ukládání
                                @endif
                                @endif
                            </div>

            <div class="pageTitle">Uživatelská oprávnění</div>

            <div class="list-group my-list-group" id="myList permitionList" role="tablist">

                @foreach($permitions as $permition)

                <a class="list-group-item list-group-item-action list-name my-list-group-item" id="list-{{$permition->id}}" permitionId="{{$permition->id}}" data-toggle="list" role="tab" onclick="showPanel({{$permition->id}})">{{$permition->name}} <div class="float-end roleCount" >{{$permition->count}}</div></a>

                @endforeach
                    <form action="/addPermition" method="POST" id="addPermitionForm">
                        @csrf
                        <a type="submit" metod="POST" class="list-group-item list-group-item-action list-name my-list-group-item my-list-group-item-add" data-toggle="list" role="tab" onclick="this.getElementsByClassName('plus')[0].setAttribute('hidden','');this.getElementsByClassName('buttonLoading')[0].removeAttribute('hidden');  document.getElementById('addPermitionForm').submit()">Přidat novou roli <span class="plus">+</span> <div id="buttonLoading" class="spinner-grow buttonLoading spinner-grow-sm text-vrs-cyan" role="status" hidden></div></a>
                    </form>

            </div>

            <div class="tab-content">

                @foreach($permitions as $permition)

                <div class="tab-pane" id="panel-{{$permition->id}}" role="tabpanel">

                    <form action="/savePermitionData" method="POST" id="savePermitionData-{{$permition->id}}">
                        @csrf

                        <input type="text" class="vrs-h2 text-vrs-cyan w-100 bg-transparent permition-name" name="name" value="{{$permition->name}}">
                        <input type="text" name="id" value="{{$permition->id}}" hidden>


                    <div class="my_row">
                        <input type="text" id="possibility_renting{{$permition->id}}" name="renting" value="{{$permition->possibility_renting}}" hidden>
                        <input name="possibility_renting" type="checkbox" data-width="150"  data-toggle="toggle" data-onstyle="danger" data-on=" ANO " data-off=" NE " @if($permition->possibility_renting == 1) checked @endif onchange="changeSwitch(this, 'possibility_renting{{$permition->id}}')">
                        <label for="possibility_renting">Možnost výpůjčky</label>
                    </div>

                    <div class="my_row">
                        <input type="text" id="new_user{{$permition->id}}" name="user" value="{{$permition->new_user}}" hidden>
                        <input name="new_user" type="checkbox" data-width="150"  data-toggle="toggle" data-onstyle="danger" data-on=" ANO " data-off=" NE " @if($permition->new_user == 1) checked @endif onchange="changeSwitch(this, 'new_user{{$permition->id}}')">
                        <label for="new_user">Správa uživatelů</label>
                    </div>

                    <div class="my_row">
                        <input type="text" id="return_verification{{$permition->id}}" name="return" value="{{$permition->return_verification}}" hidden>
                        <input name="return_verification" type="checkbox" data-width="150"  data-toggle="toggle" data-onstyle="danger" data-on=" ANO " data-off=" NE " @if($permition->return_verification == 1) checked @endif onchange="changeSwitch(this, 'return_verification{{$permition->id}}')">
                        <label for="return_verification">Schvalování výpůjček</label>
                    </div>

                    <div class="my_row">
                        <input type="text" id="edit_item{{$permition->id}}" name="edit" value="{{$permition->edit_item}}" hidden>
                        <input name="edit_item" type="checkbox" data-width="150"  data-toggle="toggle" data-onstyle="danger" data-on=" ANO " data-off=" NE " @if($permition->edit_item == 1) checked @endif onchange="changeSwitch(this, 'edit_item{{$permition->id}}')">
                        <label for="edit_item">Správa položek a kategorií</label>
                    </div>

                    <div class="my_row">
                        <input type="text" id="edit_permitions{{$permition->id}}" name="permition" value="{{$permition->edit_permitions}}" hidden>
                        <input name="edit_permitions" type="checkbox" data-width="150"  data-toggle="toggle" data-onstyle="danger" data-on=" ANO " data-off=" NE " @if($permition->edit_permitions == 1) checked @endif onchange="changeSwitch(this, 'edit_permitions{{$permition->id}}')">
                        <label for="edit_permitions">Správa oprávnění</label>
                    </div>

                    </form>

                    <div class="button-row">
                        <div class="buttonsDiv">
                            <div class="buttonsDivItem">
                                <button type="submit button" class="buttonsDivItem submit btn btn-primary w-200p float-end p-2 w-10rem text-white" onclick="savePermitionData(this, '{{$permition->id}}' )">
                                    <div id="buttonText">Uložit změny</div>
                                    <div id="buttonLoading" class="spinner-grow text-light" role="status" hidden></div>
                                </button>
                            </div>

                            <div class="buttonsDivItem">
                                <button type="submit button" class="buttonsDivItem submit btn btn-danger w-200p float-end p-2  w-10rem text-white" onclick="vrsNotify('Opravdu chcete roli smazat?',removePermition, this,'{{$permition->id}}' ); return false">
                                    <div id="buttonText">Smazat roli</div>
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


