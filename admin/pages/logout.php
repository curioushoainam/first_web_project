<?php 
include_once ("./config.php");
include_once ("./libs/funcs.php");

unset($_SESSION['login']);
unset($_SESSION['account']);
unset($_SESSION['password']);
unset($_SESSION['avatar']);

setcookie('login', '', -1);
setcookie('account', '', -1);
setcookie('password', '', -1);
setcookie('avatar', '', -1);

chuyentrang('index.php');
?>