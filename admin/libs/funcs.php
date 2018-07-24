<?php
//<!-- lưu tất cả các function dùng chung cho website -->
function viewArray($ar){
    echo '<pre>';
    print_r($ar);
    echo '</pre>';
}

function checklogin(){
    if (isset($_SESSION['login']) && $_SESSION['login']){
        return true;
    } else
        return false;
}

function chuyentrang($link){
    header('location: '.$link);
}


?>