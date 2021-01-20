
var showMessagesRequest = null;
var sendMessageTimeout = null;



function newMessage(){

    document.getElementById("allMessages").setAttribute("hidden","");
    document.getElementById("newMessages").removeAttribute("hidden");

    $.ajax({
        url: '/getUserNames',
        method: "GET",
        success: function (response) {

            let names = new Array();

            for (let i = 0 ; i<response.length; i++){
                names.push(response[i]["nick"])
            }

            autocomplete(document.getElementById("userNameTo"), names);autocomplete(document.getElementById("userNameTo"), names);
        }
    });
}

function prefixNewMessage(nick){
    showMessages();
    newMessage();
    document.getElementById("userNameTo").value = nick;

}

function allMessage(){

    document.getElementById("newMessages").setAttribute("hidden","");
    document.getElementById("allMessages").removeAttribute("hidden");

    document.getElementById("messageModal").click();
    showMessages();
}

function countNewMessages(ele)
{
    document.getElementById("newMessageCountLoading").removeAttribute("hidden");
    $.ajax({
        url: '/newMessages',
        method: "GET",
        success: function (response) {

            document.getElementById("newMessageCountLoading").setAttribute("hidden","");
            ele.innerHTML = response;
            if(response != "0"){
                ele.removeAttribute("hidden");
            }
            else{
                ele.setAttribute("hidden", "");
            }
        }
    });

}

$(function(){
    $('span[onload]').trigger('onload');
});


function closeMessages(ele){

    if(ele == event.target){
        ele.setAttribute('hidden','');
        document.getElementById('messageLoading').removeAttribute('hidden');
        showMessagesRequest.abort();

        let messages = document.getElementById("messagesBox").childNodes;
        for (let i = 0; i < messages.length ; i++){
            checkPriority(messages[i]);
        }
        document.getElementById("messagesBox").innerHTML = "";
    }

}

function showMessages(){

    document.getElementById('messageModal').removeAttribute('hidden');

    showMessagesRequest = $.ajax({
        url: '/allMessages',
        method: "GET",
        success: function (response) {

            document.getElementById("messageLoading").setAttribute('hidden','');
            if(response.length == 0){
                let div = document.createElement('div');
                div.setAttribute('id','emptyMessages');
                div.innerHTML = "Nemáte žádné nové zprávy!";
                document.getElementById("messagesBox").appendChild(div);
            }
            for (let i = 0; i < response.length; i++){

                let b = response[0];
                let c = response[0]['messages'];
                document.getElementById("messagesBox").appendChild(getMessageDiv(response[i]['nick']== null ? "Systém" : response[i]['nick'], response[i]['messages'], response[i]['priority'], response[i]['id']));
            }
        }
    });
}

function getMessageDiv(user_from, text, priority, id){

    let div = document.createElement('div');
    div.setAttribute('priority',priority);
    div.setAttribute('mess_id',id);
    div.setAttribute('id', 'message');
    div.setAttribute('class', 'messPriority' + priority);
    div.classList.add("message");
    div.setAttribute('title','Smazat zprávu?');
    div.setAttribute('onmouseenter','checkPriority(this)');

    let from = document.createElement('h3');
    from.setAttribute("class","text-vrs-yellow");
    from.innerHTML = "OD: " + user_from;

    let p = document.createElement('p');
    p.innerHTML = text;

    let cross = document.createElement('div');
    cross.setAttribute('class','messageCross');
    cross.setAttribute('onclick','removeMessage(this)');
    cross.innerHTML = '<b>&#x2715;</b>';

    let removingLoading = document.createElement('div');
    removingLoading.setAttribute('class','messageCrossLoading');
    removingLoading.setAttribute('hidden','');
    removingLoading.classList.add("spinner-grow");
    removingLoading.classList.add("text-vrs-cyan");

    div.appendChild(cross);
    div.appendChild(removingLoading);
    div.appendChild(from);
    div.appendChild(p);

    return div;
}

function checkPriority(ele){

    if(ele.getAttribute('priority')=='0'){
        ele.setAttribute('priority', '1');

        $.ajax({
            url: '/changeMessagePriority/' + ele.getAttribute('mess_id'),
            method: "GET",
            success: function (response) {
                ele.classList.remove("messPriority"+0);
                ele.classList.add("messPriority1");
                let val = document.getElementById("newMessageCount").innerText;
                document.getElementById("newMessageCount").innerHTML = val-1;
                if(document.getElementById("newMessageCount").innerText == "0"){
                    document.getElementById("newMessageCount").setAttribute("hidden","");
                }
            }
        });
    }

}

function removeMessage(ele){

        ele.setAttribute("hidden","");
        ele.parentNode.getElementsByClassName("messageCrossLoading")[0].removeAttribute("hidden");
        $.ajax({
            url: '/removeMessage/' + ele.parentNode.getAttribute('mess_id'),
            method: "GET",
            success: function () {
                ele.parentNode.setAttribute("hidden","");

                let mess = ele.parentNode.parentNode.getElementsByClassName("message");
                let count = 0;
                for(let i =0; i<mess.length; i++){
                    count += mess[i].getAttribute("hidden") == null ? 1 : 0 ;
                }
                if(count == 0){
                    let div = document.createElement('div');
                    div.setAttribute('id','emptyMessages');
                    div.innerHTML = "Nemáte žádné nové zprávy!";
                    document.getElementById("messagesBox").appendChild(div);
                }
            }
        });
}


function sendMessage(ele){

    let to = ele.parentNode.getElementsByTagName("input")[0].value.trim();

    let text = ele.parentNode.getElementsByTagName("textarea")[0].value.trim();
    text = text.replaceAll('>', '©-');
    text = text.replaceAll('<', '-©');
    text = text.replaceAll('/', '©©');

    if(to == ""){
        document.getElementById("httpRequestMessage").innerHTML = "Vyplňte přezdívku příjemce!";
        document.getElementById("httpRequestMessage").removeAttribute("hidden");
        clearTimeout(sendMessageTimeout);
        sendMessageTimeout = setTimeout(function (){
            document.getElementById("httpRequestMessage").setAttribute("hidden","");
        },2000);
        return;
    }

    if(text == ""){
        document.getElementById("httpRequestMessage").innerHTML = "Vyplňte text zprávy!";
        document.getElementById("httpRequestMessage").removeAttribute("hidden");
        clearTimeout(sendMessageTimeout);
        sendMessageTimeout = setTimeout(function (){
            document.getElementById("httpRequestMessage").setAttribute("hidden","");
        },2000);
        return;
    }

    document.getElementById("sendMessageLoading").removeAttribute("hidden");
    $.ajax({
        url: '/sendMessage/' + to + '/' +  text,
        method: "GET",
        success: function () {

            document.getElementById("sendMessageLoading").setAttribute("hidden", "");
            ele.parentNode.getElementsByTagName("input")[0].value = "";
            ele.parentNode.getElementsByTagName("textarea")[0].value = "";
            document.getElementById("httpRequestMessage").innerHTML = "Odesláno";
            document.getElementById("httpRequestMessage").removeAttribute("hidden");
            clearTimeout(sendMessageTimeout);
            sendMessageTimeout = setTimeout(function (){
                document.getElementById("httpRequestMessage").setAttribute("hidden","");
            },2000);
        },
        error: function (){
            document.getElementById("sendMessageLoading").setAttribute("hidden", "");
            document.getElementById("httpRequestMessage").innerHTML = "Odeslání selhalo";
            document.getElementById("httpRequestMessage").removeAttribute("hidden");
            clearTimeout(sendMessageTimeout);
            sendMessageTimeout = setTimeout(function (){
                document.getElementById("httpRequestMessage").setAttribute("hidden","");
            },2000);
        }
    });

}

function toHex(str) {
    var result = '';
    for (var i=0; i<str.length; i++) {
        result += str.charCodeAt(i).toString(16);
    }
    return result;
}



function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                /*make the matching letters bold:*/
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function(e) {
                    /*insert the value for the autocomplete text field:*/
                    inp.value = this.getElementsByTagName("input")[0].value;
                    /*close the list of autocompleted values,
                    (or any other open lists of autocompleted values:*/
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 38) { //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x) x[currentFocus].click();
            }
        }
    });
    function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }
    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}

var messageCountAchievement = 0;

function achievementCount(){
    messageCountAchievement++;
    if (messageCountAchievement == 10){
        vrsAlert('Gratuluji, získáváš achievement "Rychloklikač začátečník"' );
    }else if(messageCountAchievement == 20 ){
        vrsAlert('Nice, jde ti to dobře, získáváš achievement "Rychloklikač pokročilý"' );
    }else if(messageCountAchievement == 30 ){
        vrsAlert('Ještě tě to nepřestalo bavit? Získáváš achievement "Rychloklikač PRO+"' );
    }else if(messageCountAchievement == 45 ){
        vrsAlert('Tak už toho ale sakra nech, ne! Komu tím jako prospěješ?!' );
    }else if(messageCountAchievement == 65 ){
        vrsAlert('Výborně, myslím, že už stačilo, ne? Kašlu na tebe... klikej si dál, když chceš' );
    }else if(messageCountAchievement == 100){
        vrsAlert('Jsi LEGENDA, kliknul/a jsi víc jak 100x na tuhle blbou obálku, už jsi spokojený/á?' );
    }
}
