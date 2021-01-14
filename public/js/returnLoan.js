
function returnLoan(ele, id){

    ele.querySelectorAll("div[id='buttonText']")[0].setAttribute("hidden","");
    ele.querySelectorAll("div[id='buttonLoading']")[0].removeAttribute("hidden");

    $.ajax({
        url: '/loans/' + id  + '/return',
        method: "GET",
        success: function (response) {

            let lastClass = 0;
            let actualClass = 0;
            let actualText = "";
            let onmouseover = "";
            if(response["status"] == "1"){

                lastClass = "btn-warning";
                actualClass = "btn-success";
                actualText = "Probíhá";
                onmouseover = "hoverChange(this,'status','Probíhá','Zrušit rezervaci','btn-success','btn-danger')";

            }else if(response["status"] == "2"){

                lastClass = "btn-success";
                actualClass = "btn-warning";
                actualText = "Čekání na schválení";
                onmouseover = "hoverChange(this,'status','Čekání na schválení','Zrušit odevzdání','btn-warning','btn-danger')";

            }else{
                lastClass = "btn-success";
                actualClass = "btn-warning";
                actualText = "Čekání";
            }


            if(response["return"] == "1"){

                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#10003;</b>';
                ele.querySelectorAll("div[id='buttonText']")[0].removeAttribute("hidden");
                ele.querySelectorAll("div[id='buttonLoading']")[0].setAttribute("hidden", "");
                ele.onmouseover = null;
                ele.setAttribute("onmouseover", onmouseover);

                if(response["status"] == "0"){

                    setTimeout(function (ele) {
                        ele.parentNode.parentNode.setAttribute("hidden", "");

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
                ele.querySelectorAll("div[id='buttonLoading']")[0].setAttribute("hidden", "");

                setTimeout(function (ele, actualText){
                    ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = actualText;

                },1000,ele, actualText);
            }

        }
    });

}
