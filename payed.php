<?php
session_start(); 

if(!isset($_SESSION['uNamebnz'])){
header('Location:login.php');
$pdo= null;

}
include "dbcon.php";
if (isset($_GET['pageno'])) {
  $page = addslashes((htmlentities($_GET['pageno'])));
} else {
  $page = 1;
}
$articleno = 10;
$daspik = ($page-1) * $articleno; 
$select = $pdo->prepare("SELECT * FROM items WHERE `items`.`sale`=`items`.`payed`  ORDER BY `items`.`id` DESC");
$select->setFetchMode(PDO::FETCH_ASSOC);
$select->execute();
$hamww=$select->rowCount()/$articleno;
$select = $pdo->prepare('SELECT * FROM items WHERE `items`.`sale`=`items`.`payed`  ORDER BY `items`.`id` DESC LIMIT '.$daspik.','. $articleno);
$select->setFetchMode(PDO::FETCH_ASSOC);
$select->execute();
$taybat=$select->rowCount();
if($taybat==0){
  header('Location:index.php');
}
  $pdo= null;
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.js"></script>

    <title> payed</title>
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
          <li class="nav-item active">
            <a class="nav-link" href="payed.php">Payed </a>
          </li>
          <li class="nav-item ">
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
    <div id="data" class="container">
    <p class="font-weight-bold">that Items are not payed</p>
    <a class="btn btn-success" href="print_payed.php" > Print All</a>

        <div>
        <table class="table table-striped">
  <thead class="thead-dark">
  <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Purchase</th>
      <th scope="col">Sale</th>
      <th scope="col">Pay</th>
      <th scope="col">profit</th>
      <th scope="col">inserted Date</th>
      <th scope="col">updated Date</th>

    </tr>
  </thead>
  <tbody>
  <?php
  while($data=$select->fetch()){
  ?>
                  
                   <tr>
        <th scope="row"><?php echo $data['id']; ?></th>
        <td><?php echo $data['title']; ?></td>
        <td><?php echo $data['purchase']; ?></td>      
        <td><?php echo $data['sale']; ?></td>
        <td><?php echo $data['payed']; ?></td>
        <td><?php echo $data['profit']; ?></td>
        <td><?php echo $data['intered_date']; ?></td>
        <td><?php echo $data['update_date']; ?></td>

        <td><a href="edit_item.php?id=<?php echo $data['id']; ?>" class="btn btn-primary">Edit</a> </td>
        <td><button class="btn btn-danger delete" data-id="<?php echo $data['id']; ?>">Delete</button> </td>
  
      </tr>
<?php
  }
  include "totalpayed.php";

?>

<div style="margin-left: 40%">
                <button class="btn btn-warning"> <a class="text-dark" href="<?php if($page <= 1){ echo '#'; } else { echo "?pageno=".($page - 1); } ?>">Prev</a></button>  <button class="btn btn-warning"><?php echo $page; ?></button>   <button class="btn btn-warning"><a class="text-dark" href="<?php if($page >= $hamww){ echo '#'; } else { echo "?pageno=".($page + 1); } ?>">Next</a></button>
            </div>
</table>


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