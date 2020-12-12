@section('title',"Moje výpůjčky")
@section('css', URL::asset('css/category-remove-verify.css'))

<x-app-layout>

    <x-slot name="header"></x-slot>
    <script src="/js/main.js"></script>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="container">

            <form action="{{'/categories/' . $categories[0]->categoryId . '/removeCategoryHard'}}" method="POST" class="removeVerify text-center">
                @csrf
                <div class="h1"> Opravdu ?</div>
                <div class=""> V dané kategorii se nachází položky, které mohou být v závazku vůči uživatelům, přejete si spolu s kategorií odstranit všechny položky a jejich závazky?</div>
                <input type="text" class="d-none" name="categoryId" value="{{$categories[0]->categoryId}}">
                <br>
                <input class="btn btn-danger" type="submit" value="Smazat kategorii {{$categories[0]->categoryName}} a všechny položky">
            </form>

            <hr>

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
                    <div class="itemName h5 mt-4">
                        @if($category->itemName == "")
                            Nepojmenovaná položka č. {{$category->itemId}}
                        @else
                            {{$category->itemName}}
                        @endif
                    </div>
                @endif

                        @if(!is_null($category->rent_from))

                        <a href="/user/. {{$category->userId}}">
                        <label class="name">{{$category->name}} {{$category->surname}} : </label>
                        </a>

                        <label for="rent_from" class="font-weight-bold">OD: </label>
                        <label class="rent_from">{{$category->rent_from}}</label>
                        <label for="rent_to" class="font-weight-bold">  -  DO: </label>
                        <label class="rent_to">{{$category->rent_to}}</label>
                        <br>
                        @else
                            Pro tuto položku nejsou zaznamenány zádné závazky
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


