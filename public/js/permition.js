
function hidePanels(){

    let panel = document.getElementsByClassName("active");

    for (let i =0; i < panel.length; i++){
        panel[i].classList.remove("active");
    }
}

function showPanel(id){

    hidePanels();

    let a = document.getElementById("panel-" + id);
    document.getElementById("panel-" + id).classList.add("active");

}

function changeSwitch(ele, id){
    let a = document.getElementById(id);
    let b = "";
}
