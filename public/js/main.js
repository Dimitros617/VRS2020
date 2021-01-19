
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

function showCard(clss, setclss){

    let elements = document.getElementsByClassName(setclss);
    for (let i = 0; i < elements.length; i++){
        elements[i].classList.remove(setclss);
    }

    elements = document.getElementsByClassName(clss);
    for (let i = 0; i < elements.length; i++){
        elements[i].classList.add(setclss);
    }

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

function setPasiveRefresh(){

let messageRefresh = 0;

}


function vrsNotify(text, fce) {

    let notificationModal = document.getElementById('notificationModal');

    let notify = document.createElement('div');
    notify.setAttribute('id','notify');
    notify.setAttribute('class','hide');

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
    yesOption.setAttribute('class','btn');
    yesOption.classList.add('btn-danger');
    yesOption.innerHTML = "ANO";

    let arr = new Array();
    for (let i = 2; i < arguments.length ; i++){
        arr.push(arguments[i]);
    }
    yesOption.addEventListener('click', yes.bind(null,fce,arr),false);

    let noOption = document.createElement('button');
    noOption.setAttribute('id','noOption');
    noOption.setAttribute('class','btn');
    noOption.classList.add('btn-success');
    noOption.innerHTML = "NE";
    noOption.onclick = function () {
        document.getElementById('notify').classList.add('hide');
        setTimeout(() => {
            let notificationModal = document.getElementById('notificationModal');
            notificationModal.innerHTML = "";
            notificationModal.setAttribute('hidden','true');
        }, 100);
    }

    buttonArea.appendChild(yesOption);
    buttonArea.appendChild(noOption);
    foot.appendChild(buttonArea);
    notify.appendChild(informationArea);
    notify.appendChild(foot);
    notificationModal.appendChild(notify);
    notificationModal.removeAttribute('hidden');
    setTimeout(() => {
        document.getElementById("notify").classList.remove("hide");
    }, 100);

}

function yes(call_fce,call_arg){
    document.getElementById('notify').classList.add('hide');
    setTimeout(() => {
        let notificationModal = document.getElementById('notificationModal');
        notificationModal.innerHTML = "";
        notificationModal.setAttribute('hidden','true');
        call_fce.apply(null, call_arg);
    }, 100);
}

function vrsAlert(text) {

    let notificationModal = document.getElementById('notificationModal');

    let notify = document.createElement('div');
    notify.setAttribute('id','notify');
    notify.setAttribute('class','hide');

    let informationArea = document.createElement('div');
    informationArea.setAttribute('id','informationArea');

    let content = document.createTextNode(text);
    informationArea.appendChild(content);

    let foot = document.createElement('div');
    foot.setAttribute('id','foot');
    let buttonArea = document.createElement('div');
    buttonArea.setAttribute('id','buttonArea');

    let okOption = document.createElement('button');
    okOption.setAttribute('id','yesOption');
    okOption.setAttribute('class','btn');
    okOption.classList.add('btn-danger');
    okOption.innerHTML = "OK";

    okOption.onclick = function () {
        document.getElementById('notify').classList.add('hide');
        setTimeout(() => {
            let notificationModal = document.getElementById('notificationModal');
            notificationModal.innerHTML = "";
            notificationModal.setAttribute('hidden','true');
        }, 100);

    }

    buttonArea.appendChild(okOption);
    foot.appendChild(buttonArea);
    notify.appendChild(informationArea);
    notify.appendChild(foot);
    notificationModal.appendChild(notify);
    notificationModal.removeAttribute('hidden');
    setTimeout(() => {
        document.getElementById("notify").classList.remove("hide");
    }, 100);

}
