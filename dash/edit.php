<?php
session_start();
require '../connection.php';

  $client = $_POST['client'];
  $names = $_POST['names'];
  $mobile  = trim($_POST['mobile']," ");
  $address =  $_POST['address'];
  $username =  $_POST['username'];
  $password =  $_POST['password'];
  try {
    $sql = 'UPDATE `customer` SET `names`=?, `mobile`=?, `address`=?,username=?,`password`=? WHERE id=?';
    $stmt = $connection->prepare($sql);
    if($stmt->execute([$names,$mobile,$address,$username,$password,$client]));
    {
        $_SESSION['msg'] = "<div class='alert alert-info'>Edited Successfully</div>";
        header("Location: ./");
  } 
}
catch (PDOException $e) {
    $_SESSION['msg'] = "<div class='alert alert-warning'>Check Mobile may be Used  by others.</div>";
    header("Location: ./");
  }
   
