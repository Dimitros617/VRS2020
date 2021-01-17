

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

function buttonLink(ele,text,url){

    ele.querySelectorAll("div[id='buttonText']")[0].setAttribute("hidden","");
    ele.querySelectorAll("div[id='buttonLoading']")[0].removeAttribute("hidden");

    $.ajax({
        method: "GET",
        url: url,
        success: function (response){

            ele.querySelectorAll("div[id='buttonText']")[0].removeAttribute("hidden");
            ele.querySelectorAll("div[id='buttonLoading']")[0].setAttribute("hidden", "");

            if(response == "1"){
                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#10003;</b>';
            }else{
                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#x2715;</b>';
            }

            setTimeout(function (ele){
                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = text;
            },1000,ele);
        },
    });
}

function showButtonLoading(ele){
    ele.querySelectorAll("div[id='buttonText']")[0].setAttribute("hidden","");
    ele.querySelectorAll("div[id='buttonLoading']")[0].removeAttribute("hidden");
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

var confirmation = null;

function modalNotification(text) {

    let notificationModal = document.getElementById('notificationModal');
    notificationModal.removeAttribute('hidden');
    let informationArea = document.createElement('div');
    informationArea.setAttribute('id','informationArea');

    let content = document.createTextNode(text);
    informationArea.appendChild(content);

    let foot = document.createElement('div');
    foot.setAttribute('id','foot');
    let buttonArea = document.createElement('div');
    buttonArea.setAttribute('id','buttonArea');

    let yesOption = document.createElement('button');
    yesOption.setAttribute('id','yesOption');
    yesOption.innerHTML = "ANO";
    yesOption.onclick = function () {
        confirmation = true;
        notificationModal.removeChild(foot);
        notificationModal.removeChild(informationArea);
        notificationModal.setAttribute('hidden','true');
        return confirmation;
    }

    let noOption = document.createElement('button');
    noOption.setAttribute('id','noOption');
    noOption.innerHTML = "NE";
    noOption.onclick = function () {
        confirmation = false;
        notificationModal.removeChild(foot);
        notificationModal.removeChild(informationArea);
        notificationModal.setAttribute('hidden','true');
        return confirmation;
    }

    buttonArea.appendChild(yesOption);
    buttonArea.appendChild(noOption);
    foot.appendChild(buttonArea);
    notificationModal.appendChild(informationArea);
    notificationModal.appendChild(foot);

    while(confirmation === null)
    {

    }
}
