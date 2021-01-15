
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

    let categories = document.querySelectorAll("div[class='categoryDiv']");

    for (let i = 0; i < categories.length ; i++){

        let name = categories[i].getElementsByClassName("categoryName")[0].innerHTML.toLowerCase();

        if(name == find_value){
            continue;
        }

        let item_count = 0;
        let items = categories[i].getElementsByClassName('itemDiv');

        for (let j = 0; j < items.length ; j++){

            let item_name = items[j].getElementsByClassName("itemName").length != 0 ? items[j].getElementsByClassName("itemName")[0].innerHTML.toLowerCase(): "";
            let note = items[j].getElementsByClassName("itemNote").length != 0 ? items[j].getElementsByClassName("itemNote")[0].innerHTML.toLowerCase(): "" ;
            let place = items[j].getElementsByClassName("itemPlace").length != 0 ? items[j].getElementsByClassName("itemPlace")[0].innerHTML.toLowerCase(): "";
            let inventory_number = items[j].getElementsByClassName("itemInventory_number").length != 0 ? items[j].getElementsByClassName("itemInventory_number")[0].innerHTML.toLowerCase(): "";

            if(item_name == find_value || note == find_value || place == find_value || inventory_number == find_value ){
                item_count++;
                continue;
            }

            let loans_count = 0;
            let loans = items[j].getElementsByClassName('loanRecordBox');

            for (let k = 0; k < loans.length ; k++){

                let user_name = loans[k].getElementsByClassName("userName")[0].innerHTML.toLowerCase();
                let user_surname = loans[k].getElementsByClassName("userSurname")[0].innerHTML.toLowerCase();

                if(user_name == find_value || user_surname == find_value || (user_name + " " + user_surname) == find_value ){
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
