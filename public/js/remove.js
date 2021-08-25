
function removeCategory(ele, id){

    ele.children[0].setAttribute("hidden","");
    ele.children[1].removeAttribute("hidden");


    $.ajax({
        url: '/categories/' + id +'/removeCategory',
        method: "GET",
        success: function (response) {

            if(response != "1"){
                window.location.href = '/categories/' + id +'/removeCategory';

            }else{
                ele.children[0].innerHTML = '<b>&#10003</b>';
                setTimeout(function (ele){
                    ele.parentNode.parentNode.parentNode.setAttribute("hidden","");
                },1000,ele);

                ele.children[0].removeAttribute("hidden");
                ele.children[1].setAttribute("hidden","");
                ele.children[0].innerHTML = '<b>&#10003</b>';
            }

        }
    });
}
function removeDepartment(ele, id){

    ele.children[0].setAttribute("hidden","");
    ele.children[1].removeAttribute("hidden");

    $.ajax({
        url: '/removeDepartment/' + id,
        method: "GET",
        success: function (response) {

            if(response != "1"){
                window.location.href = '/removeDepartment/' + id;
            }else{
                ele.children[0].innerHTML = '<b>&#10003</b>';
                setTimeout(function (ele){
                    ele.parentNode.parentNode.parentNode.setAttribute("hidden","");
                },1000,ele);

                ele.children[0].removeAttribute("hidden");
                ele.children[1].setAttribute("hidden","");
                ele.children[0].innerHTML = '<b>&#10003</b>';
            }

        },
        error: function (response){
            alert(response);
        }
    });
}

function removeItem(ele, id){

    ele.children[0].setAttribute("hidden","");
    ele.children[1].removeAttribute("hidden");


    $.ajax({
        url: '/item/' + id + '/removeItem',
        method: "GET",
        success: function (response) {

            if(response != "1"){
                window.location.href = '/item/' + id + '/removeItem';

            }else{
                ele.children[0].innerHTML = '<b>&#10003</b>';
                setTimeout(function (ele){
                    ele.parentNode.parentNode.parentNode.setAttribute("hidden","");
                },1000,ele);

                ele.children[0].removeAttribute("hidden");
                ele.children[1].setAttribute("hidden","");
                ele.children[0].innerHTML = '<b>&#10003</b>';
            }





        }
    });
}
