<?php
session_start(); 

if(!isset($_SESSION['uNamebnz'])){
header('Location:login.php');
$pdo= null;

}
require_once "dbcon.php";

$sql="DELETE FROM items WHERE id=?;";  
    $execu=$pdo->prepare($sql);
    $id=addslashes((htmlentities($_GET["id"])));
    $execu->execute((array($id))); 
    $pdo= null;

    header("location: index.php",  true,  301 );  exit;
    ?>