<?php
session_start();
require '../connection.php';
  $names = $_POST['names'];
  $mobile  = trim($_POST['mobile'],"()-");
  $address =  $_POST['address'];
  $date = date("Y-m-d");
  $status = 'Active';
  $username =  $_POST['username'];
  $password =  $_POST['password'];
  try {
    $sql = 'INSERT INTO `customer`(`names`, `mobile`, `address`,username=?,`password`=? `date`,`status`) VALUES (?,?,?,?,?,?,?)';
    $stmt = $connection->prepare($sql);
    if($stmt->execute([$names,$mobile,$address,$username,$password,$date,$status]));
    {
        $_SESSION['msg'] = "<div class='alert alert-info'>New Client Add Successfully</div>";
        header("Location: ./");
  } 
}
catch (PDOException $e) {
    $_SESSION['msg'] = "<div class='alert alert-warning'>Check Mobile may be Used  by others.</div>";
    header("Location: ./");
  }
   
