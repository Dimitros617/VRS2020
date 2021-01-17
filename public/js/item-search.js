
function categoryNameChange(ele) {
    let input_value = ele.value;
    if (input_value != window.categoryName) {
        $.ajax({
            url: '/categories/checkCategoryNameExist/' + input_value,
            method: "GET",
            success: function (response) {

                if (response == "true") {
                    vrsAlert("Bohužel kategorie s tímto názvem již existuje, zvolte jiný!");
                    document.getElementsByClassName("categoryName")[0].value = window.categoryName;
                }
            }
        });
    }
}

function clearSearch(){
    let hidden = document.getElementsByClassName("vrs-d-none");

    while (hidden.length != 0){
        hidden[0].classList.remove("vrs-d-none");
    }
}

function itemFind(){
    let find_value = document.getElementById("search").value.trim().toLowerCase();

    clearSearch();

    if(find_value == ""){
        return;
    }


        let items =  document.getElementsByClassName('item');

        for (let j = 0; j < items.length ; j++){

            let item_name = items[j].getElementsByClassName("name").length != 0 ? items[j].getElementsByClassName("name")[0].value.toLowerCase(): "";
            let note = items[j].getElementsByClassName("note").length != 0 ? items[j].getElementsByClassName("note")[0].value.toLowerCase(): "" ;
            let place = items[j].getElementsByClassName("place").length != 0 ? items[j].getElementsByClassName("place")[0].value.toLowerCase(): "";
            let inventory_number = items[j].getElementsByClassName("inventory_number").length != 0 ? items[j].getElementsByClassName("inventory_number")[0].value.toLowerCase(): "";

            if(item_name.includes(find_value) || note.includes(find_value) || place.includes(find_value) || inventory_number.includes(find_value) ){
            }else{
                items[j].classList.add("vrs-d-none");
            }
        }
}

function itemsSort(ele) {
    let sort_value = ele.getAttribute("sort");

    if(sort_value == "asc"){
        ele.setAttribute("sort","desc");
        ele.innerHTML = "&#8681";
    }else{
        ele.setAttribute("sort","asc");
        ele.innerHTML = "&#8679;";
    }
    document.getElementById("search-spinner").removeAttribute("hidden");

    $.ajax({
        url: '/categories/itemsSort/' + sort_value,
        method: "GET",
        success: function (response) {

            let liveItems = document.getElementsByClassName("item");
            let items = new Array();
            for (let i = 0; i< liveItems.length; i++){
                items[i] = liveItems[i].cloneNode(true);
            }

            document.getElementById("data").innerHTML = "";


            for (let i = 0; i< response.length; i++){
                for (let j = 0; j< items.length; j++){
                    if(response[i]["id"] == items[j].getAttribute("itemID")){
                        document.getElementById("data").appendChild(items[j]);
                        break;
                    }
                }
            }

            document.getElementById("search-spinner").setAttribute("hidden","");
        }
    });

}
