
function saveItemData(ele, id, catId, availability){

    let dataElements = ele.parentNode;
    let token = dataElements.querySelectorAll("input[name='_token']")[0].value;
    let name = dataElements.querySelectorAll("div[name='name']")[0].innerHTML;
    let note = dataElements.querySelectorAll("div[name='note']")[0].innerHTML;
    let place = dataElements.querySelectorAll("div[name='place']")[0].innerHTML;
    let inventory_number = dataElements.querySelectorAll("div[name='inventory_number']")[0].innerHTML;

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


function saveItemLoansData(ele){

    let dataElements = ele.parentNode.parentNode.parentNode.querySelectorAll("form[id='form']")[0];
    let token = dataElements.querySelectorAll("input[name='_token']")[0].value;
    let itemId = dataElements.querySelectorAll("input[name='itemId']")[0].value;
    let rent_from = dataElements.querySelectorAll("input[name='rent_from']")[0].value.trim().replaceAll(". ","-");
    let rent_to = dataElements.querySelectorAll("input[name='rent_to']")[0].value.trim().replaceAll(". ","-");

    if(rent_from == "" || rent_to == ""){
        dataElements.querySelectorAll("input[id='newLoanFormSubmit']")[0].click();
        return;
    }

    ele.querySelectorAll("div[id='buttonText']")[0].setAttribute("hidden","");
    ele.querySelectorAll("div[id='buttonLoading']")[0].removeAttribute("hidden");

    $.ajax({
        method: "POST",
        url: '/item/' + itemId + '/saveItemLoansData',
        data: { _token: token, itemId: itemId, rent_from: rent_from, rent_to: rent_to},
        success: function (response){

            let from = new Date(rent_from.replace( /(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3"));
            let to = new Date(rent_to.replace( /(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3"));


            let addon = String(from.getDate()).padStart(2, '0') + "-" + String(from.getMonth() + 1).padStart(2, '0') + "-" + from.getFullYear() + "/";

            while(from < to){
                from.setDate(from.getDate()+1);
                addon += String(from.getDate()).padStart(2, '0') + "-" + String(from.getMonth() + 1).padStart(2, '0') + "-" + from.getFullYear() + "/";
            }


            let dataElement = dataElements.querySelectorAll("input[name='rent_from']")[0].parentNode.parentNode;
            dataElement.setAttribute("data",dataElement.getAttribute("data") + addon);
            dataElements.querySelectorAll("input[name='rent_from']")[0].value = "";
            dataElements.querySelectorAll("input[name='rent_to']")[0].value = "";


            ele.querySelectorAll("div[id='buttonText']")[0].removeAttribute("hidden");
            ele.querySelectorAll("div[id='buttonLoading']")[0].setAttribute("hidden", "");

            if(response == "1"){
                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = 'Vypůjčeno  <b>&#10003;</b> ';
            }else{
                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#x2715;</b>';
            }

            setTimeout(function (ele){
                ele.querySelectorAll("div[id='buttonLoading']")[0].setAttribute("hidden", "");
                ele.querySelectorAll("div[id='buttonText']")[0].removeAttribute("hidden");
                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = "Vypůjčit";
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
