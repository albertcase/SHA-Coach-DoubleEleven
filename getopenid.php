<?php 
setcookie("openid",$_GET['openid'], time()+3600*24);
$_COOKIE['openid'] = $_GET['openid'];
Header("Location:/");
exit;