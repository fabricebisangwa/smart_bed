<?php
require 'db.php';
session_start();
$sql = 'SELECT * FROM people';
$statement = $connection->prepare($sql);
$statement->execute();
$people = $statement->fetchAll(PDO::FETCH_OBJ);
 ?>
 <?php
if (isset($_GET['active'])) {
  $id = $_GET['active'];
$sql = 'UPDATE people SET `status`="Active" WHERE id=:id';
$statement = $connection->prepare($sql);
if ($statement->execute([':id' => $id])) {
      $sql = 'UPDATE people SET `status`="Disactive" WHERE id!=:id';
      $statement = $connection->prepare($sql);
      if ($statement->execute([':id' => $id])) {
        header("Location: index.php");
      }
}
}
?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>All people</h2>
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Phone Number</th>
          <th>Active number</th>
          <th>Action</th>
        </tr>
        <?php  $count = 1; ?>
        <?php foreach($people as $person):
          ?>
          <tr>
            <td><?= $count; ?></td>
            <td><?= $person->name; ?></td>
            <td><?= $person->mobile; ?></td>
            <td><?php if($person->status == 'Active'){ ?>
              <a onclick="return confirm('you want change recieve?')" href="?active=<?= $person->id ?>" class='btn btn-sm btn-primary'>Active</a>
            <?php } 
            else{?>
            <a onclick="return confirm('you want change recieve?')" href="?active=<?= $person->id ?>" class='btn btn-sm btn-danger'>Disactive</a>
            <?php } ?>
            </td>
            <td>
              <a href="edit.php?id=<?= $person->id ?>" class='btn btn-sm btn-success'>edit</a>
              <a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete.php?id=<?= $person->id ?>" class='btn btn-sm btn-danger'>Delete</a>
            </td>
          </tr>
        <?php
          $count++;
      endforeach; ?>
      </table>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
