

function savePermitionData(ele, id){


    ele.querySelectorAll("div[id='buttonText']")[0].setAttribute("hidden","");
    ele.querySelectorAll("div[id='buttonLoading']")[0].removeAttribute("hidden");

let a = $('#savePermitionData-' + id).serialize();

    $.ajax({
        url: '/savePermitionData',
        method: 'POST',
        data:$('#savePermitionData-' + id).serialize(),
        success:function(response){

            ele.querySelectorAll("div[id='buttonText']")[0].removeAttribute("hidden");
            ele.querySelectorAll("div[id='buttonLoading']")[0].setAttribute("hidden", "");

            if(response == "1"){

                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#10003;</b>';
                let roleCount = document.getElementById("list-"+id).getElementsByClassName("roleCount")[0].cloneNode(true);
                document.getElementById("list-"+id).innerHTML = document.getElementById("panel-" + id).getElementsByClassName("permition-name")[0].value;
                document.getElementById("list-"+id).appendChild(roleCount);

            }else if(response == "-1"){

                vrsAlert('Alespoň jedna role musí mít možnost "Správy oprávnění"!' );
                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#x2715;</b>';
                let input = document.getElementById("edit_permitions"+id).parentNode
                let a = input.getElementsByClassName("toggle-off")[0].click();

                let roleCount = document.getElementById("list-"+id).getElementsByClassName("roleCount")[0].cloneNode(true);
                document.getElementById("list-"+id).innerHTML = document.getElementById("panel-" + id).getElementsByClassName("permition-name")[0].value;
                document.getElementById("list-"+id).appendChild(roleCount);

            }else{
                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#x2715;</b>';
            }

            setTimeout(function (ele){
                //ele.getElementsByClassName('submit')[0].setAttribute("hidden","");
                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = "Uložit změny";
            },1000,ele);


        },
        error: function (){

            ele.querySelectorAll("div[id='buttonText']")[0].removeAttribute("hidden");
            ele.querySelectorAll("div[id='buttonLoading']")[0].setAttribute("hidden", "");

            ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#x2715;</b>';

            setTimeout(function (ele){
                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = "Uložit změny";
            },1000,ele);
        }
    });

}

function removePermition(ele, id){

    ele.querySelectorAll("div[id='buttonText']")[0].setAttribute("hidden","");
    ele.querySelectorAll("div[id='buttonLoading']")[0].removeAttribute("hidden");


    $.ajax({
        url: '/removePermition/' + id,
        type: 'GET',
        success:function(response){

            ele.querySelectorAll("div[id='buttonText']")[0].removeAttribute("hidden");
            ele.querySelectorAll("div[id='buttonLoading']")[0].setAttribute("hidden", "");

            if(response == "1"){
                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#10003;</b>';
                setTimeout(function (ele){
                    document.getElementById("list-"+id).setAttribute("hidden", "");
                    document.getElementsByClassName("active")[0].setAttribute("hidden", "");
                },1000,ele);

            }else if(response == "2"){
                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#x2715;</b>';
                vrsAlert('Nemůžete smazat roli, pokud je někomu přiřazena!' );
                setTimeout(function (ele){
                    ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = "Smazat oprávnění";

                },1000,ele);
            }else{
                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#x2715;</b>';
                setTimeout(function (ele){
                    ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = "Smazat oprávnění";

                },1000,ele);
            }

        },
        error: function (){

            ele.querySelectorAll("div[id='buttonText']")[0].removeAttribute("hidden");
            ele.querySelectorAll("div[id='buttonLoading']")[0].setAttribute("hidden", "");

            ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#x2715;</b>';

            setTimeout(function (ele){
                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = "Uložit změny";
            },1000,ele);
        }
    });

}
