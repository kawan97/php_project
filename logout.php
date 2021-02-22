<?php
//Logout
//Logout
session_start();
setcookie(session_name(),'',100);
session_unset();
session_destroy();
$_SESSION=array();
unset($_COOKIE['unamek']); 
setcookie('unamek', null, -1, '/'); 

header('Location:login.php');
?>