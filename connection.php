<?php
     $dsn = 'mysql:host=localhost;dbname=baby_care';
     $username = 'root';
     $password = '';
     $options = [];
     try {
     $connection = new PDO($dsn, $username, $password, $options);
     } catch(PDOException $e) {
     
     }
     ?>