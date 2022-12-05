
<?php require 'header.php'; ?>
<?php
require '../connection.php';
$id = $_GET['id'];
$sql = 'SELECT * FROM customer WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['name'])  && isset($_POST['phone']) ) {
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  try{
  $sql = 'UPDATE customer SET names=:name, mobile=:mobile WHERE id=:id';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':name' => $name, ':mobile' => $phone, ':id' => $id])) {
    header("Location: index.php");
  }
} catch (PDOException $e) {
  $_SESSION['msg'] = "<div class='alert alert-warning'>Check Mobile may be Used  by others.</div>";
  header("Location: ./");
}

}


 ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Update person</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="name">Name</label>
          <input value="<?= $person->names; ?>" type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">Mobile Number</label>
          <input type="text" maxlength="10" value="<?= $person->mobile; ?>" name="phone" id="email" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Update person</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
