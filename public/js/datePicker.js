var disableddates = [];
var lastElement = null;

function hoverChange2(ele) {


    if (ele.getAttribute('bool') == 1)
        ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = "Změnit na NE";
    else
        ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = "Změnit na ANO";
}

function hoverChangeEnd2(ele) {

    if (ele.getAttribute('bool') == 1)
        ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = "Viditelné: ANO";
    else
        ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = "Viditelné: NE";

}


function changeFrom(input) {


    let currentValue = input.value;
    //let elemnts = document.getElementsByClassName("reserveToInput");
    let elementTo = input.parentNode.parentNode.getElementsByClassName("reserveToInput")[0];

    elementTo.setAttribute("min", input.value);
    $("elementTo").datepicker({
        minDate: "currentValue"
    });
    elementTo.value = input.value;

}


function changeTo(input) {


    let currentValue = input.value;
    //let elemnts = document.getElementsByClassName("reserveFromInput");
    let elementFrom = input.parentNode.parentNode.getElementsByClassName("reserveFromInput")[0];

    let newValue = elementFrom.value
    let newValuestring = newValue;

    currentValue = currentValue.split('-');
    newValue = newValue.split('-');

    var new_start_date = new Date(newValue[2], newValue[1], newValue[0]);
    var new_end_date = new Date(currentValue[2], currentValue[1], currentValue[0]);


    if (new_end_date < new_start_date) {
        vrsAlert("Termín ukončení nemůže být před termínem začátku!");

        input.value = newValuestring;
    }

    var data = input.parentNode.parentNode.getAttribute("data").split("/");

    for (let i = 0; i< data.length; i++){
        let now = new Date(data[i].split("-")[2], data[i].split("-")[1], data[i].split("-")[0]);
        if(now >= new_start_date && now <= new_end_date){
            vrsAlert("V tomto intervalu se již nachází jiná výpůjčka!");
            input.value = newValuestring;
        }
    }

}

function initDate(input) {
    var min = input.getAttribute("min");
    if (min == null) {
        min = "today";
    }

    disableddates = input.parentElement.parentElement.getAttribute("data").split("/");

    let clss = ".rent" + input.getAttribute("itemId");

    $(clss).datepicker({
        beforeShowDay: DisableSpecificDates,
        dateFormat: "dd-mm-yy",
        minDate: "min"
    });
}

function DisableSpecificDates(date) {
    if(event.target.tagName == "INPUT"){
        disableddates = event.target.parentElement.parentElement.getAttribute("data").split("/");
        lastElement = event.target.parentElement.parentElement;
    }else{
        disableddates = lastElement.getAttribute("data").split("/");
    }

    var string = jQuery.datepicker.formatDate('dd-mm-yy', date);
    return [disableddates.indexOf(string) == -1];
}

$(function(){
    $('.date[onload]').trigger('onload');
});

