<?php 
session_start(); 

if(!isset($_SESSION['uNamebnz'])){
header('Location:login.php');
$pdo= null;

}
include "dbcon.php";

if(isset($_POST['adduser'])) 
{
    $naw=addslashes((htmlentities($_POST["username"])));
    $nhiny=addslashes((htmlentities($_POST["password"])));
    $nhiny=hash('sha256', $nhiny);
$sql="insert into user_db(name,pass)values(?,?) ";  
$execu=$pdo->prepare($sql);
$execu->execute((array($naw,$nhiny))); 
$pdo= null;


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.js"></script>

    <title>Add User</title>
</head>
<body>
<nav class="navbar navbar-expand navbar-dark bg-primary">
      <a class="navbar-brand" href="#">DataBase</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample02">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item ">
            <a class="nav-link" href="index.php">Home </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="not_payed.php">Not Payed </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="payed.php"> Payed </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="add_item.php">Add Item </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="add_user.php">Add User </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="logout.php">Logout </a>
          </li>
        </ul>
        <form class="form-inline my-2 my-md-0">
          <input id="search" name="search"class="form-control" type="text" placeholder="Search">
        </form>
      </div>
    </nav>
    
    <div id="searcharea" class="container">
    <p class="font-weight-bold">Result</p>

        <div>

        <table class="table table-striped">

  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Sale</th>
      <th scope="col">Date</th>

    </tr>
  </thead>
  <tbody id="searchs">
   
   </tbody>
</table>
        </div>
        </div>
<br>
        <div class="row">
                    <div class="col-lg-5 offset-md-5 offset-lg-3 col-md-4">
                        <div class="form-group">
                            <h4>Add User</h4>
                         <form method="POST" enctype="multipart/form-data">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username"/>
                            <label>Password</label>
                            <input type="text" class="form-control" name="password"/>
                            <br>
                            <input type="submit" value="Add User" class="btn btn-primary btn-lg btn-block" name="adduser">
                        </form>
                        </div>
                    </div>   



<script>
$(document).ready(function (){

    $("#searcharea").hide();
    $("#search").on("keydown", function(){

      if($("#search").val()!==""){
      let search="search.php?search="+$("#search").val();

      $.ajax({
            url  : search,
            success :  function(data)
            {
           $( "#resultss" ).remove();

             $("#searchs").html(data);
      }});
    }

});
$( ".delete" ).click(function() {

let id=$(this).data("id");
window.location.href = 'delete.php?id='+id;
});




$( "#search" ).focus(function() {
  $( "#resultss" ).remove();
    $("#searcharea").fadeIn("slow");
    

});

$("#search").focusout(function() {
  $("#searcharea").fadeOut("slow");

});

});

</script>

</body>
</html>