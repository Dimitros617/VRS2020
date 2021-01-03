<?php





$a = explode("/","http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
array_pop($a);
array_pop($a);
$json = file_get_contents(implode("/",$a) . '/data.json');
$myArr = json_decode($json, true);

if($myArr == null){
    $myArr = array();
}



foreach ($myArr as $user) {
    if(array_key_exists($_POST["UID"], $user))
    {
        echo "-1";
        return;
    }
}



array_push($myArr, array($_POST["UID"] => $_POST["NAME"]));


$myJSON = json_encode($myArr);




json_encode($myJSON);
if (file_put_contents("../data.json", $myJSON)){
    echo "1";
}
else {
    echo "0";
}



?>


