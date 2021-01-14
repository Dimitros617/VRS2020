

function hoverChange(ele, atributeBool, textTrue, textFalse, classBefore, classAfter) {


    ele.addEventListener("mouseleave", hoverChangeEnd.bind(null, ele, atributeBool, textTrue, textFalse, classBefore, classAfter))
    ele.removeEventListener("mouseleave", hoverChangeEnd, false);

    ele.classList.remove("btn-success");
    ele.classList.remove("btn-danger");
    ele.classList.remove("btn-warning");

    if (ele.getAttribute(atributeBool) == 1) {
        ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = textTrue;
        ele.classList.add(classAfter);
    }
    else {
        ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = textFalse;
        ele.classList.remove(classBefore);
        ele.classList.add(classAfter);
    }
}


function hoverChangeEnd(ele, atributeBool, textTrue, textFalse, classBefore, classAfter) {

    ele.classList.remove("btn-success");
    ele.classList.remove("btn-danger");
    ele.classList.remove("btn-warning");

    if (ele.getAttribute(atributeBool) != 1) {
        ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = textTrue;
        ele.classList.remove(classAfter);
        ele.classList.add(classBefore);
    }
    else {
        ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = textFalse;
        ele.classList.remove(classBefore);
        ele.classList.add(classAfter);
    }



}

setTimeout(function () {
    $('#autoHide').fadeOut('fast');
}, 5000); // <-- čas v millisekundách


function showButton(ele) {
    ele.parentElement.parentElement.getElementsByClassName("btn")[0].removeAttribute("hidden");
}

$(function(){
    $('span[onload]').trigger('onload');
});

function setPasivRefresh(){

let messageRefresh = 0;

}



