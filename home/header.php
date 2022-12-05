<?php session_start(); ?>
<?php 
if (!isset($_SESSION['names']) or empty($_SESSION['names'])) {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Login First To Continue</div>";
    echo"<script>window.location=' ../home_login.php'</script>";
}
 ?>
<!doctype html>
<html lang="en">
  <head>
    <title>Smart bed</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
  <body class="bg-dark">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="create.php">Add a person <span class="sr-only">(current)</span></a>
      </li>   
    </ul>
  </div>
  <div>
    <h4><?= $_SESSION['names']; ?> <a href="logout.php">Logout</a></h4>
    
  </div>
</nav>
