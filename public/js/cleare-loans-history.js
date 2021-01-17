function clearLoansHistory(ele,text,url){

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

                let data = document.getElementsByClassName("loanRecordBox");
                for (let i = 0; i < data.length ; i++){
                    let atr = data[i].getElementsByClassName("created")[0];
                    if(atr != undefined) {
                        let date = new Date(atr.getAttribute("date"));
                        date = new Date(date.setDate(date.getDate()+30));
                        let now = new Date();
                        if(now > date){
                            data[i].setAttribute("hidden", "");
                        }
                    }
                }

            }else{
                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#x2715;</b>';
            }

            setTimeout(function (ele){
                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = text;
            },1000,ele);
        },
    });
}
