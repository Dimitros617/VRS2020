
function returnLoan(ele, id){

    ele.querySelectorAll("div[id='buttonText']")[0].setAttribute("hidden","");
    ele.querySelectorAll("div[id='buttonHoverText']")[0].setAttribute("hidden","");
    ele.querySelectorAll("div[id='buttonLoading']")[0].removeAttribute("hidden");

    $.ajax({
        url: '/loans/' + id  + '/return',
        method: "GET",
        success: function (response) {

            let lastClass = 0;
            let actualClass = 0;
            let actualText = "";
            let actualHover = "";
            let onmouseover = "";
            if(response["status"] == "1"){

                lastClass = "btn-warning";
                actualClass = "btn-success";
                actualText = "Probíhá";
                actualHover = "kliknutím zrušíte rezervaci"
                onmouseover = "hoverChange(this,'status','Probíhá','Zrušit rezervaci','btn-success','btn-danger')";

            }else if(response["status"] == "2"){

                lastClass = "btn-success";
                actualClass = "btn-warning";
                actualText = "Čekání na schválení";
                actualHover = "kliknutím zrušíte odevzdání"
                onmouseover = "hoverChange(this,'status','Čekání na schválení','Zrušit odevzdání','btn-warning','btn-danger')";

            }else{
                lastClass = "btn-success";
                actualClass = "btn-warning";
                actualText = "Čekání";
            }


            if(response["return"] == "1"){

                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#10003;</b>';
                ele.querySelectorAll("div[id='buttonText']")[0].removeAttribute("hidden");
                ele.querySelectorAll("div[id='buttonHoverText']")[0].innerHTML = actualHover;
                ele.querySelectorAll("div[id='buttonHoverText']")[0].removeAttribute("hidden");
                ele.querySelectorAll("div[id='buttonLoading']")[0].setAttribute("hidden", "");
                ele.onmouseover = null;
                ele.setAttribute("onmouseover", onmouseover);

                if(response["status"] == "0"){

                    setTimeout(function (ele) {
                        ele.parentNode.parentNode.setAttribute("hidden", "");

                        let allLoans = document.getElementsByClassName("loanRecordBox");
                        let count = 0;
                        for (let i = 0 ; i < allLoans.length ; i++){
                            count += allLoans[i].getAttribute("hidden") == null ? 1 : 0 ;
                        }
                        if(count == 0){
                            ele.parentNode.getElementsByClassName("emptyElementLoans")[0].removeAttribute("hidden");
                        }

                    }, 1000, ele);

                }else {

                    setTimeout(function (ele, actualText, lastClass, actualClass) {
                        ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = actualText;
                        ele.classList.remove(lastClass);
                        ele.classList.add(actualClass);
                    }, 1000, ele, actualText, lastClass, actualClass);
                }
            }else{
                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#x2715;</b>';
                ele.querySelectorAll("div[id='buttonText']")[0].removeAttribute("hidden");
                ele.querySelectorAll("div[id='buttonHoverText']")[0].removeAttribute("hidden");
                ele.querySelectorAll("div[id='buttonLoading']")[0].setAttribute("hidden", "");

                setTimeout(function (ele, actualText){
                    ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = actualText;

                },1000,ele, actualText);
            }

        },
        error: function (response){
            ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#x2715;</b>';

            setTimeout(function (ele){
                //ele.getElementsByClassName('submit')[0].setAttribute("hidden","");
                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = "Chyba!";
            },1000,ele);
        }
    });

}
