

function hoverChange(ele, atributeBool, textTrue, textFalse, classBefore, classAfter) {


    ele.addEventListener("mouseleave", hoverChangeEnd.bind(null, ele, atributeBool, textTrue, textFalse, classBefore, classAfter))

    if (ele.getAttribute(atributeBool) == 1) {
        ele.innerHTML = textTrue;
        ele.classList.remove(classBefore);
        ele.classList.add(classAfter);
    }
    else {
        ele.innerHTML = textFalse;
        ele.classList.remove(classBefore);
        ele.classList.add(classAfter);
    }
}


function hoverChangeEnd(ele, atributeBool, textTrue, textFalse, classBefore, classAfter) {


    if (ele.getAttribute(atributeBool) != 1) {
        ele.innerHTML = textTrue;
        ele.classList.remove(classAfter);
        ele.classList.add(classBefore);
    }
    else {
        ele.innerHTML = textFalse;
        ele.classList.remove(classBefore);
        ele.classList.add(classAfter);
    }
}

setTimeout(function () {
    $('#autoHide').fadeOut('fast');
}, 5000); // <-- čas v millisekundách


function showButton(ele) {
    ele.parentElement.getElementsByClassName("btn")[0].removeAttribute("hidden");
}

$(function(){
    $('span[onload]').trigger('onload');
});

function setPasivRefresh(){

let messageRefresh = 0;



}

