<?php
session_start(); 

if(!isset($_SESSION['uNamebnz'])){
header('Location:login.php');
$pdo= null;

}

include "dbcon.php";
$search=addslashes((htmlentities($_GET["search"])));
$sql="SELECT * FROM items WHERE `items`.`title` LIKE ?  ORDER BY `items`.`id` DESC LIMIT 10;";  
$execu=$pdo->prepare($sql);
$execu->execute(array("%".$search."%")); 
//$data=$execu->fetch();

?>
<?php
  while($data=$execu->fetch()){
  ?>
                  
                   <tr  id="resultss">
        <th  scope="row"><?php echo $data['id']; ?></th>
        <td><?php echo $data['title']; ?></td>
        <td><?php echo $data['sale']; ?></td>
        <td><?php echo $data['intered_date']; ?></td>

        <td><a href="item.php?id=<?php echo $data['id']; ?>" class="btn btn-warning">Read More</a> </td>
  
      </tr>
<?php
  }
?>

