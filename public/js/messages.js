
function newMessage(){

    document.getElementById("allMessages").setAttribute("hidden","");
    document.getElementById("newMessages").removeAttribute("hidden");

}

function allMessage(){

    document.getElementById("newMessages").setAttribute("hidden","");
    document.getElementById("allMessages").removeAttribute("hidden");

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

        let messages = document.getElementById("messagesBox").childNodes;
        for (let i = 0; i < messages.length ; i++){
            checkPriority(messages[i]);
        }
        document.getElementById("messagesBox").innerHTML = "";
    }

}

function showMessages(){

    document.getElementById('messageModal').removeAttribute('hidden');

    $.ajax({
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
                let c = response[0]['message'];
                document.getElementById("messagesBox").appendChild(getMessageDiv(response[i]['message'], response[i]['priority'], response[i]['id']));
            }
        }
    });
}

function getMessageDiv(text, priority, id){

    let div = document.createElement('div');
    div.setAttribute('priority',priority);
    div.setAttribute('mess_id',id);
    div.setAttribute('id', 'message');
    div.setAttribute('class', 'messPriority' + priority);
    div.classList.add("message");
    div.setAttribute('title','Smazat správu?');
    div.setAttribute('onmouseenter','checkPriority(this)');

    let p = document.createElement('p');
    p.innerHTML = text;

    let cross = document.createElement('div');
    cross.setAttribute('class','messageCross');
    div.setAttribute('onclick','removeMessage(this)');
    cross.innerHTML = '&#x2715;';

    let removingLoading = document.createElement('div');
    removingLoading.setAttribute('class','messageCrossLoading');
    removingLoading.setAttribute('hidden','');
    removingLoading.classList.add("spinner-grow");
    removingLoading.classList.add("text-vrs-cyan");

    div.appendChild(cross);
    div.appendChild(removingLoading);
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

        ele.getElementsByClassName("messageCross")[0].setAttribute("hidden","");
        ele.getElementsByClassName("messageCrossLoading")[0].removeAttribute("hidden");
        $.ajax({
            url: '/removeMessage/' + ele.getAttribute('mess_id'),
            method: "GET",
            success: function (response) {
                ele.setAttribute("hidden","");

                let mess = document.getElementsByClassName("message");
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
