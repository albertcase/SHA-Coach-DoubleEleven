<?php 
session_start();
$_SESSION['openid'] = $_GET['openid'];
Header("Location:/");
exit;