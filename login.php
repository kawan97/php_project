<?php 
//login
//login
session_start(); 
require_once "dbcon.php"; 
if(isset($_SESSION['uNamebnz'])){
header('Location:index.php');
}


if ( isset( $_POST['submit'])) { 
    $user=addslashes((htmlentities($_POST['user'])));
    $pass=addslashes((htmlentities($_POST['pass']))); 
   $pass=hash('sha256', $pass);
    $userName="";
    $fullName=""; 
    $sql="select * from user_db where name=? and pass=?"; 
    $stmt=$pdo->prepare($sql); 
    $stmt->execute(array($user, $pass)); 
    while ($row = $stmt->fetch()) { 
        $fullName=$row['name']; 
        $passwordd=$row['pass']; 
        $pdo= null;


    }
if ($stmt->rowCount()==1){ 
  $_SESSION['uNamebnz']=$userName; 
  $_SESSION['upassbnz']=$passwordd; 
  setcookie("unamek", $fullName, time() + (86400 * 2), "/");
   echo "successful login "; 

   echo  $_SESSION['uNamebnz'];
     header ('Location: index.php'); 
    exit; 
    } 
    else 
    {
    echo"wrong username or password"; 
     }
    }

?>

<html>
<head>
    <link rel="stylesheet" href="css/login_style.css">
</head>

<body>
    
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="active"> Sign In </h2>


    <!-- Icon -->
    <div class="fadeIn first">
      <img src="img/login.png" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form method="POST">
      <input type="text" id="login" class="fadeIn second" name="user" placeholder="login">
      <input type="text" id="password" class="fadeIn third" name="pass" placeholder="password">
      <input type="submit" class="fadeIn fourth" value="Log In" name="submit">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="">Created By Kawan</a>
    </div>

  </div>
</div>
    
</body>
    
</html>