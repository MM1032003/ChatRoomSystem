<?php 
function btnProvider($text,$class, $action = "") {
    return "<div class='col-sm-6 col-md-6'><button class='$class' onclick='$action'>$text</button></div>";

}

?>