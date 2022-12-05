<?php
session_start();
require 'connection.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

 $sql1 = 'SELECT * FROM `admin` WHERE username=:username AND `password`=:password';
 $stmt = $connection->prepare($sql1);
 $stmt->execute([':username' => $username,':password' => $password]);
 $row = $stmt->rowCount();
 if ($row > 0) {
 while($data=$stmt->fetch(PDO::FETCH_ASSOC))                
        $_SESSION['admin'] = $data['username'];
        header("Location: dash/");
               
   }
   else
   {
    $_SESSION['error'] = "<div class='alert alert-warning'>Incorrect Authentication.</div>";
      header("Location: ./");
   }