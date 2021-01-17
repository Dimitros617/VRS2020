@section('title',$categories[0]->categoryName)
@section('css', URL::asset('css/category-remove-verify.css'))

<x-app-layout>

    <x-slot name="header"></x-slot>
    <script src="/js/main.js"></script>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="container p-6">

            <form action="{{'/categories/' . $categories[0]->categoryId . '/removeCategoryHard'}}" method="POST" class="removeVerify text-center">
                @csrf
                <div class="vrs-h2 text-vrs-cyan d-content"> Jste si jistý?</div>
                <div class=""> V dané kategorii se nachází položky, které mohou být v závazku vůči uživatelům, přejete si spolu s kategorií odstranit všechny položky a jejich závazky?</div>
                <input type="text" class="d-none text-vrs-cyan mb-2" name="categoryId" value="{{$categories[0]->categoryId}}">
                <br>
                <input class="btn btn-danger" type="submit" value="Smazat kategorii {{$categories[0]->categoryName}} a všechny položky">
            </form>



            @php
                $lastCategory = -1;
                $lastItem = -1;
            @endphp
            @foreach($categories as $category)
                @if($category->categoryId != $lastCategory) {{-- Začátek Divu kategorie--}}
                    @if($lastCategory != -1)
                        </div></div>
                    @endif
                    <div class="categoryDiv bg-light mb-4 ">
                    <div class="h4">{{$category->categoryName}}</div>

                @endif


                @if($category->itemId != $lastItem) {{-- Začátek Divu Itemu--}}
                    @if($lastItem != -1 && $category->categoryId == $lastCategory)
                        </div>
                    @endif
                    <div class="itemDiv">
                    <div class="itemName mt-4 mb-4">
                        @if($category->itemName == "")
                            Nepojmenovaná položka č. {{$category->itemId}}
                        @else
                            {{$category->itemName}}
                        @endif
                    </div>
                @endif

                        @if(!is_null($category->rent_from))
                            <div class="loanRecordBox">
                                <div class="icon"
                            @php
                                $start = strtotime($category->rent_from);
                                $end = strtotime($category->rent_to);
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


                        <a href="/user/. {{$category->userId}}" class="userNameLink">
                        <label class="">{{$category->name}} {{$category->surname}} : </label>
                        </a>

                            <div class="rentFromDiv">
                                <label for="rent_from" class="font-weight-bold">OD: </label>
                                <label class="rent_from">{{date("d. m. Y", strtotime($category->rent_from))}}</label>
                            </div>
                            <div class="rentToDiv">
                                <label for="rent_to" class="font-weight-bold">DO: </label>
                                <label class="rent_to">{{date("d. m. Y", strtotime($category->rent_to))}}</label>
                            </div>
                        </div>
                        @else
                            <div class="emptyElementLoans">Pro tuto položku nejsou zaznamenány žádné závazky</div>
                        @endif
                @php
                    $lastCategory = $category->categoryId;
                    $lastItem = $category->itemId;
                @endphp



            @endforeach


                </div>
        </div>
    </div>

</x-app-layout>


