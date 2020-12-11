

function categoryNameChange(ele) {
    let input_value = ele.value;
    if (input_value != window.categoryName) {
        $.ajax({
            url: '/categories/checkCategoryNameExist/' + input_value,
            method: "GET",
            success: function (response) {

                if (response == "true") {
                    alert("Bohužel kategorie s tímto názvem již existuje");
                    document.getElementsByClassName("categoryName")[0].value = window.categoryName;
                }
            }
        });
    }
}

// Zkouška o předělání změny availability na GET
// function availabilityChange(ele){
//
//     let input_value = ele.value;
//     $.ajax({
//         url: 'item/' + ele.getAttribute("itemId") +  '/changeItemAvailability/',
//         method: "GET",
//         success: function(response){
//
//             if (response == "true") {
//                 alert("prošlo");
//
//             }else{
//                 alert("neprošlo");
//             }
//         }
//     });
//
// }
