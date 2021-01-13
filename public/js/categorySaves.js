
function saveItemData(ele, id, catId, availability){

    let dataElements = ele.parentNode;
    let token = dataElements.querySelectorAll("input[name='_token']")[0].value;
    let name = dataElements.querySelectorAll("input[name='name']")[0].value;
    let note = dataElements.querySelectorAll("input[name='note']")[0].value;
    let place = dataElements.querySelectorAll("input[name='place']")[0].value;
    let inventory_number = dataElements.querySelectorAll("input[name='inventory_number']")[0].value;

    ele.querySelectorAll("div[id='buttonText']")[0].setAttribute("hidden","");
    ele.querySelectorAll("div[id='buttonLoading']")[0].removeAttribute("hidden");

    $.ajax({
        method: "POST",
        url: '/item/' + id + '/saveItemData',
        data: { _token: token, name: name, note: note, place: place, inventory_number: inventory_number, itemId: id, categoriesId: catId, availability: availability },
        success: function (response){

            ele.querySelectorAll("div[id='buttonText']")[0].removeAttribute("hidden");
            ele.querySelectorAll("div[id='buttonLoading']")[0].setAttribute("hidden", "");

            if(response == "1"){
                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#10003;</b>';
            }else{
                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#x2715;</b>';
            }

            setTimeout(function (ele){
                ele.setAttribute("hidden","");
                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = "Uložit změny";
            },1000,ele);

        },

    });

}

function changeItemAvailability(ele, id){


    ele.querySelectorAll("div[id='buttonText']")[0].setAttribute("hidden","");
    let availability = ele.getAttribute("bool");
    ele.querySelectorAll("div[id='buttonLoading']")[0].removeAttribute("hidden");


    $.ajax({
        url: '/item/' + id + '/changeItemAvailability',
        method: "GET",
        data: { availability: availability },
        success: function (response) {

                let lastClass = 0;
                let actualClass = 0;
                let actualText = "";
                if(response["availability"] == "1"){

                    lastClass = "btn-danger";
                    actualClass = "btn-success";
                    actualText = "Viditelné: ANO";

                }else{

                    lastClass = "btn-success";
                    actualClass = "btn-danger";
                    actualText = "Viditelné: NE";

                }


                if(response["return"] == "1"){
                    ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#10003;</b>';
                    ele.querySelectorAll("div[id='buttonText']")[0].removeAttribute("hidden");
                    ele.querySelectorAll("div[id='buttonLoading']")[0].setAttribute("hidden", "");
                    ele.setAttribute("bool",response["availability"] );

                    setTimeout(function (ele){
                        ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = actualText;
                        ele.classList.remove(lastClass);
                        ele.classList.add(actualClass);
                    },1000,ele);

                }else{
                    ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#x2715;</b>';
                    ele.querySelectorAll("div[id='buttonText']")[0].removeAttribute("hidden");
                    ele.querySelectorAll("div[id='buttonLoading']")[0].setAttribute("hidden", "");

                    setTimeout(function (ele, actualText){
                        ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = actualText;

                    },1000,ele, actualText);
                }


        }
    });
}
