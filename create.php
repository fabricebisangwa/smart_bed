<?php
require 'db.php';
$message = '';
if (isset ($_POST['name'])  && isset($_POST['phone']) ) {
  $name = $_POST['name'];
  $mobile = $_POST['phone'];
  $sql = 'INSERT INTO people(name, mobile	) VALUES(:name, :mobile	)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':name' => $name, ':mobile' => $mobile])) {
    header("Location: index.php");
  }



}


 ?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Create a person</h2>
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
          <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">Phone</label>
          <input type="text" maxlength="13" name="phone" value="+250" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Create a person</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
