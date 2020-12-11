

$(function(){
    $('.categoryName').change(function(){
        let input_value = $(this).val();
        $.ajax({
            url: '/categories/checkCategoryNameExist/' + input_value,
            method: "GET",
            success: function(response){

                if (response == "true") {
                    alert("Bohužel kategorie s tímto názvem již existuje");
                    document.getElementsByClassName("categoryName")[0].value = window.lastValidClassName ;
                }else{
                    window.lastValidClassName = input_value;
                }
            }
        });
    })
})
