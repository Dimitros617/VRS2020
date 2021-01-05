function userSort(ele) {
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
        url: '/users/usersSort/' + sort_value,
        method: "GET",
        success: function (response) {

            let liveUsers = document.getElementsByClassName("userElement");
            let users = new Array();
            for (let i = 0; i< liveUsers.length; i++){
                users[i] = liveUsers[i].cloneNode(true);
            }

            document.getElementById("userList").innerHTML = "";


            for (let i = 0; i< response.length; i++){
                for (let j = 0; j< users.length; j++){
                    if(response[i]["id"] == users[j].getAttribute("userID")){
                        document.getElementById("userList").appendChild(users[j]);
                        break;
                    }
                }
            }

            document.getElementById("spinner").setAttribute("hidden","");
        }
    });

}



function userFind(ele) {
    let find_value = document.getElementById("search").value.trim();

    if(find_value==""){
        let users = document.getElementsByClassName("userElement");
        for (let i = 0; i< users.length; i++){
            users[i].removeAttribute("hidden");
        }
        return;
    }

    document.getElementById("spinner").removeAttribute("hidden");

    $.ajax({
        url: '/users/usersFind/' + find_value,
        method: "GET",
        success: function (response) {

            let users = document.getElementsByClassName("userElement");
            for (let i = 0; i< users.length; i++){
                users[i].setAttribute("hidden","");
            }

            for (let i = 0; i< response.length; i++){
                for (let j = 0; j< users.length; j++){
                    if(response[i]["id"] == users[j].getAttribute("userID")){
                        users[j].removeAttribute("hidden");
                        break;
                    }
                }
            }

            document.getElementById("spinner").setAttribute("hidden","");
        }
    });

}
