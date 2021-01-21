
function clearSearch(){
    let hidden = document.getElementsByClassName("vrs-d-none");

    while (hidden.length != 0){
        hidden[0].classList.remove("vrs-d-none");
    }
}

function loanFind(){
    let find_value = document.getElementById("search").value.trim().toLowerCase();

    clearSearch();

    if(find_value == ""){
        return;
    }

    let categories = document.getElementsByClassName('categoryDiv');

    for (let i = 0; i < categories.length ; i++){

        let name = categories[i].getElementsByClassName("categoryName").length != 0 ? categories[i].getElementsByClassName("categoryName")[0].innerHTML.toLowerCase(): "";

        if(name.includes(find_value)){
            continue;
        }

        let item_count = 0;
        let items =  categories[i].getElementsByClassName('itemDiv');

        for (let j = 0; j < items.length ; j++){

            let item_name = items[j].getElementsByClassName("itemName").length != 0 ? items[j].getElementsByClassName("itemName")[0].innerHTML.toLowerCase(): "";
            let note = items[j].getElementsByClassName("itemNote").length != 0 ? items[j].getElementsByClassName("itemNote")[0].innerHTML.toLowerCase(): "" ;
            let place = items[j].getElementsByClassName("itemPlace").length != 0 ? items[j].getElementsByClassName("itemPlace")[0].innerHTML.toLowerCase(): "";
            let inventory_number = items[j].getElementsByClassName("itemInventory_number").length != 0 ? items[j].getElementsByClassName("itemInventory_number")[0].innerHTML.toLowerCase(): "";

            if(item_name.includes(find_value) || note.includes(find_value) || place.includes(find_value) || inventory_number.includes(find_value) ){
                item_count++;
                continue;
            }

            let loans_count = 0;
            let loans = items[j].getElementsByClassName('loanRecordBox');

            for (let k = 0; k < loans.length ; k++){


                let user_name =  loans[k].getElementsByClassName("userNameLabel").length != 0 ? loans[k].getElementsByClassName("userNameLabel")[0].innerHTML.toLowerCase(): "";

                let from = loans[k].getElementsByClassName("rent_from")[0].innerHTML.toLowerCase().split(". ");
                let to = loans[k].getElementsByClassName("rent_to")[0].innerHTML.toLowerCase().split(". ");

                from = new Date(from[2] + "-" + from[1] + "-" + from[0]);
                to = new Date(to[2] + "-" + to[1] + "-" + to[0]);


                if(user_name.includes(find_value) || checkDateCommand(from, to, find_value) ){
                    loans_count++;
                }else{
                    loans[k].classList.add("vrs-d-none");
                }

            }

            if(loans_count == 0){
                items[j].classList.add("vrs-d-none");
            }else{
                item_count++;
            }

        }

        if(item_count == 0){
            categories[i].classList.add("vrs-d-none");
        }

    }

}


function checkDateCommand(from, to, find_value){

    let find = find_value.split(" ");

    if (find.length < 2){
        return false;
    }

    let variables = null;
    let date = new Date();

    let ret = false;

    if(find[0] == "od"){
        variables = from;
    }else if(find[0] == "do"){
        variables = to;
    }else {
        return false;
    }

    let newDate = null;
    try {
        newDate = new Date(find[2].split("/")[2] + "-" + find[2].split("/")[1] + "-" + find[2].split("/")[0]);
    }
    catch(err) {
    }



    if(newDate != null){
        date = newDate;
    }

    if(find[1] == "<"){
        ret = variables < date;
    }else if(find[1] == "="){
        ret = variables == date;
    }else if(find[1] == ">"){
        ret = variables > date;
    }else if(find[1] == ">="){
        ret = variables >= date;
    }else if(find[1] == "<="){
        ret = variables <= date;
    }else{
        return false;
    }

    return ret;

}

function loansSort(ele) {

    let sort_value = ele.getAttribute("sort");

    var sortClasesDiv = arguments;

    if(sort_value == "asc"){
        ele.setAttribute("sort","desc");
        ele.innerHTML = "&#8681";
    }else{
        ele.setAttribute("sort","asc");
        ele.innerHTML = "&#8679;";
    }
    document.getElementById("search-spinner").removeAttribute("hidden");

    $.ajax({
        url: '/categories/categoriesSort/' + sort_value,
        method: "GET",
        success: function (response) {

            for (let o = 1 ; o < sortClasesDiv.length ; o++ ) {

                let liveCategories = document.getElementsByClassName("categoryDiv");
                let categories = new Array();
                for (let i = 0; i < liveCategories.length; i++) {
                    categories[i] = liveCategories[i].cloneNode(true);
                }

                let a = sortClasesDiv[o];
                document.getElementById(sortClasesDiv[o]).innerHTML = "";


                for (let i = 0; i < response.length; i++) {
                    for (let j = 0; j < categories.length; j++) {
                        if (response[i]["id"] == categories[j].getAttribute("categoryID")) {
                            document.getElementById(sortClasesDiv[o]).appendChild(categories[j]);
                            break;
                        }
                    }
                }
            }
            document.getElementById("search-spinner").setAttribute("hidden","");

        }
    });

}
