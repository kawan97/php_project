<?php
session_start(); 

if(!isset($_SESSION['uNamebnz'])){
header('Location:login.php');
$pdo= null;

}
require_once "dbcon.php";
 if(isset($_POST['submit'])) 
 {
      $title=addslashes((htmlentities($_POST["title"])));
      $purchase=addslashes((htmlentities($_POST['purchase'])));
      $sale=addslashes((htmlentities($_POST['sale'])));
      $payed=addslashes((htmlentities($_POST['payed'])));
      if($payed>$sale){
        $payed=0;
      }
      $intered_date=addslashes((htmlentities($_POST['intered_date'])));
      $profit=$sale-$purchase;
      $sql="insert into items(title,purchase,sale,payed,intered_date,profit)values(?,?,?,?,?,?) ";  
      $execu=$pdo->prepare($sql);
      $execu->execute((array($title,$purchase,$sale,$payed,$intered_date,$profit))); 
      $pdo= null;
      header("location: index.php",  true,  301 );  exit;

  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.js"></script>

    <title>Add Item</title>
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
            <a class="nav-link" href="payed.php">Payed </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="add_item.php">Add Item </a>
          </li>
          <li class="nav-item ">
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
    <div id="add_item" class="container">
      <p class="font-weight-bold">Add Item :</p>
      <form method="post">
       <div class="form-group">
        <label for="title"> Title:</label>
         <input type="text" class="form-control" name="title" required>
        </div>
        <div class="form-group">
        <label for="purchase"> purchase:</label>
         <input type="number" class="form-control" name="purchase" required>
        </div>
        <div class="form-group">
        <label for="sale"> sale:</label>
         <input type="number" class="form-control" name="sale" required>
        </div>
        <div class="form-group">
        <label for="pay"> payed:</label>
         <input type="number" class="form-control" name="payed" required>
        </div>
        <div class="form-group">
        <label for="Date"> date:</label>
         <input type="date" class="form-control" name="intered_date" required>
        </div>
       <input type="submit" name="submit" value="submit"class="btn btn-success">
              </form>
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