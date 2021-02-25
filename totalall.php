<?php

if(!isset($_SESSION['uNamebnz'])){
header('Location:login.php');
$pdo= null;

}
include "dbcon.php";

$select = $pdo->prepare("SELECT * FROM items  ORDER BY `items`.`id` DESC");
$select->setFetchMode(PDO::FETCH_ASSOC);
$select->execute();

  $pdo= null;
  
$totalnotpayed=0;
$totalpayed=0;
$totalsale=0;
  while($data=$select->fetch()){
      $notpayed=$data['sale']-$data['payed'];
 $totalnotpayed=$totalnotpayed+$notpayed;
 $totalpayed=$totalpayed+$data['payed'];

$totalsale=$totalsale+$data['sale'];

  }
    ?>

<table class="table table-striped">
  <thead class="thead-dark">
  <tr>
      <th scope="col">Total Not payed</th>
      <th scope="col">Total payed</th>
      <th scope="col">total sale</th>
      </tr>
  </thead>
  <tbody>
  <tr>
  <td><?php echo $totalnotpayed; ?></td>
        <td><?php echo $totalpayed; ?></td>      
        <td><?php echo $totalsale; ?></td>
        </tr>
        <tbody>
        </table>
