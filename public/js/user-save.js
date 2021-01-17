
function saveUserData(ele, id){

    ele.querySelectorAll("div[id='buttonText']")[0].setAttribute("hidden","");
    ele.querySelectorAll("div[id='buttonLoading']")[0].removeAttribute("hidden");

    let a = $('#userDataForm').serialize();

    $.ajax({
        url: '/users/' + id +  '/saveUserData',
        type: 'POST',
        data:$('#userDataForm').serialize(),
        success:function(response){

            ele.querySelectorAll("div[id='buttonText']")[0].removeAttribute("hidden");
            ele.querySelectorAll("div[id='buttonLoading']")[0].setAttribute("hidden", "");

            if(response == "1"){
                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#10003;</b>';
            }else{
                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#x2715;</b>';
            }

            setTimeout(function (ele){
                //ele.getElementsByClassName('submit')[0].setAttribute("hidden","");
                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = "Uložit změny";
            },1000,ele);


        },
        error: function (){
            ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#x2715;</b>';

            setTimeout(function (ele){
                //ele.getElementsByClassName('submit')[0].setAttribute("hidden","");
                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = "Uložit změny";
            },1000,ele);
        }
    });

}
