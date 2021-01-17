

function categorySort(ele) {
    let sort_value = ele.getAttribute("sort");

    if(sort_value == "asc"){
        ele.setAttribute("sort","desc");
        ele.innerHTML = "&#8681";
    }else{
        ele.setAttribute("sort","asc");
        ele.innerHTML = "&#8679;";
    }
    document.getElementById("spinner").removeAttribute("hidden");

        $.ajax({
            url: '/categories/categoriesSort/' + sort_value,
            method: "GET",
            success: function (response) {

                let liveCategories = document.getElementsByClassName("categoryElement");
                let categories = new Array();
                for (let i = 0; i< liveCategories.length; i++){
                    categories[i] = liveCategories[i].cloneNode(true);
                }

                document.getElementById("categoryList").innerHTML = "";


                for (let i = 0; i< response.length; i++){
                    for (let j = 0; j< categories.length; j++){
                        if(response[i]["id"] == categories[j].getAttribute("categoryID")){
                            document.getElementById("categoryList").appendChild(categories[j]);
                            break;
                        }
                    }
                }

                document.getElementById("spinner").setAttribute("hidden","");
            }
        });

}



function categoryFind(ele) {
    let find_value = document.getElementById("search").value.trim();

    if(find_value==""){
        let categories = document.getElementsByClassName("categoryElement");
        for (let i = 0; i< categories.length; i++){
            categories[i].removeAttribute("hidden");
        }
        return;
    }

    document.getElementById("spinner").removeAttribute("hidden");

    $.ajax({
        url: '/categories/categoriesFind/' + find_value,
        method: "GET",
        success: function (response) {

            let categories = document.getElementsByClassName("categoryElement");
            for (let i = 0; i< categories.length; i++){
                categories[i].setAttribute("hidden","");
            }

            for (let i = 0; i< response.length; i++){
                for (let j = 0; j< categories.length; j++){
                    if(response[i]["id"] == categories[j].getAttribute("categoryID")){
                        categories[j].removeAttribute("hidden");
                        break;
                    }
                }
            }

            document.getElementById("spinner").setAttribute("hidden","");
        }
    });

}
