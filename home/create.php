<?php require 'header.php'; ?>
<?php
require '../connection.php';
$message = '';
if (isset ($_POST['name'])  && isset($_POST['phone']) ) {
  $name = $_POST['name'];
  $mobile = $_POST['phone'];
  $status = 'Disactive';
try
{
  $sql = 'INSERT INTO customer(names, mobile , belong, `status`) VALUES(?,?,?,?)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([$name,$mobile,$_SESSION['parent'],$status])) {
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
      <h2>Create a person</h2>
    </div>
    <?php if(isset($_SESSION['msg'])) {?>
<?php echo $_SESSION['msg']; ?>
<?php unset($_SESSION['msg']); ?>
<?php } ?>
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
          <input type="text" maxlength="10" name="phone" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Create a person</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
