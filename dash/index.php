<?php
session_start();
require '../connection.php';
?>
<?php 
if (!isset($_SESSION['admin']) or empty($_SESSION['admin'])) {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Login First To Continue</div>";
    echo"<script>window.location=' ../'</script>";
}
 ?>
 <?php
 if (isset($_GET['delete'])) {
    $id  = $_GET['delete'];
  
    try {
      $sql = 'DELETE FROM `customer` WHERE id=?';
      $stmt = $connection->prepare($sql);
      if($stmt->execute([$id]))
      {      
        $_SESSION['msg'] = "<div class='alert alert-info'>Client Deleted</div>";
        echo"<script>window.location=' ./'</script>";
    } 
  }
  catch (PDOException $e) {
       echo $e->getMessage();
    
    }
     
   }
 ?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="keywords"
    content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template" />
  <meta name="description"
    content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework" />
  <meta name="robots" content="noindex,nofollow" />
  <title>Baby</title>
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png" />
  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="../assets/extra-libs/multicheck/multicheck.css" />
  <link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" />
  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="../assets/libs/select2/dist/css/select2.min.css" />
  <link rel="stylesheet" type="text/css" href="../assets/libs/jquery-minicolors/jquery.minicolors.css" />
  <link rel="stylesheet" type="text/css"
    href="../assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
  <link rel="stylesheet" type="text/css" href="../assets/libs/quill/dist/quill.snow.css" />
  <link href="../dist/css/style.min.css" rel="stylesheet" />
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

  <!-- ============================================================== -->
  <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
    data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar" data-navbarbg="skin5">
      <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5">
          <!-- ============================================================== -->
          <!-- Logo -->
          <!-- ============================================================== -->
          <a class="navbar-brand" href="./">
            <!-- Logo icon -->
            <b class="logo-icon ps-2">
              <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
              <!-- Dark Logo icon -->
              <img src="../assets/images/logo-icon.png" alt="homepage" class="light-logo" width="25" />
            </b>
       
          </a>
          <!-- ============================================================== -->
          <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
              class="ti-menu ti-close"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
          <!-- ============================================================== -->
          <!-- toggle and nav items -->
          <!-- ============================================================== -->
          <ul class="navbar-nav float-start me-auto">
         
          </ul>
    
          <ul class="navbar-nav float-end">
            <!-- ============================================================== -->
            <!-- Comment -->
            <!-- ============================================================== -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="logout.php" id="navbarDropdown">
                <i class="fa fa-power-off me-1 ms-1"></i> Logout
              </a>
            
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <!-- ============================================================== -->
    <div class="container-fluid bg-light">
    <?php if(isset($_SESSION['msg'])) {?>
<?php echo $_SESSION['msg']; ?>
<?php unset($_SESSION['msg']); ?>
<?php } ?>
      <!-- ============================================================== -->
      <!-- Start Page Content -->
      <!-- ============================================================== -->
      <div class="row">
        <div class="col-9">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>N<sup>o</sup></th>
                      <th>Name</th>
                      <th>Mobile</th>
                      <th>Address</th>
                      <th>Username</th>
                      <th>Added on</th>
                      <th>Setting</th>
                    </tr>
                  </thead>
                  <?php
                  $sql = 'SELECT * FROM `customer` WHERE belong=0';
                  $statement = $connection->prepare($sql);
                  $statement->execute();
                  $People = $statement->fetchAll(PDO::FETCH_OBJ);
                  $count = 1;
                  foreach($People as $client):
                  ?>
                  <tbody>
                    <td><?= $count; ?></td>
                  <td><?= $client->names; ?></td>
                  <td><?= $client->mobile; ?></td>
                  <td><?= $client->address; ?></td>
                  <td><?= $client->username; ?></td>
                  <td><?= $client->date; ?></td>
                  <td>
                    <a href="?edit=<?= $client->id; ?>"> <i class="fa fas fa-pencil-alt me-1 ms-1"></i></a>
                    <a href="?delete=<?= $client->id; ?>"> <i class="fas fa-trash-alt me-1 ms-1"></i></a>
                </td>
                  </tbody>
                  <?php $count++; ?>
                  <?php endforeach; ?>
                  <tfoot>
                    <tr>
                       <th>N<sup>o</sup></th>
                       <th>Name</th>
                      <th>Mobile</th>
                      <th>Address</th>
                      <th>Username</th>
                      <th>Added on</th>
                      <th>Setting</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card">
         <?php if (isset($_GET['edit'])) {
          $c_id = $_GET['edit'];
      ?>
         <div class="card-body">
              <h5 class="card-title mb-0">Edit New Client </h5>
              <?php
                  $sql = 'SELECT * FROM `customer` WHERE id=?';
                  $statement = $connection->prepare($sql);
                  $statement->execute([$c_id ]);
                  $People = $statement->fetchAll(PDO::FETCH_OBJ);
                  foreach($People as $client):
                  ?>
              <form action="edit.php" method="post">
              
              <div class="form-group mt-3">
                <label>Names
                  <small class="text-muted">First Name & Last Name</small></label>
                <input type="text" name="names" class="form-control" value="<?= $client->names; ?>" required/>
                <input type="hidden" name="client" value="<?= $c_id; ?>">
              </div>
              <div class="form-group">
                <label>Phone
                  <small class="text-muted">(999) 999-9999</small></label>
                <input type="text" maxlength="10" class="form-control" name="mobile" required
                value="<?= $client->mobile; ?>" />
              </div>


              <div class="form-group">
                <label>Address
                  <small class="text-muted">Home Address</small></label>
                <input type="text" class="form-control" name="address" required id="purchase-mask"  value="<?= $client->address; ?>" />
              </div>
              <div class="form-group">
                <label>Username
                  <small class="text-muted">Unique Username</small></label>
                <input type="text" class="form-control" name="username" required id="purchase-mask"  value="<?= $client->username; ?>" />
              </div>
              <div class="form-group">
                <label>Password
                  <small class="text-muted">Secret key</small></label>
                <input type="password" class="form-control" name="password" required id="purchase-mask"  value="<?= $client->password; ?>" />
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-success text-white">
                  Edit 
                </button>
              </div>
              </form>
              <?php endforeach; ?>
            </div>
      <?php
         } else {
          ?>
             <div class="card-body">
              <h5 class="card-title mb-0">Add New Client </h5>
              <form action="create.php" method="post">
              <div class="form-group mt-3">
                <label>Names
                  <small class="text-muted">First Name & Last Name</small></label>
                <input type="text" name="names" class="form-control" placeholder="Enter Names" required/>
              </div>
              <div class="form-group">
                <label>Phone
                  <small class="text-muted">(999) 999-9999</small></label>
                <input type="text" maxlength="10"  class="form-control" name="mobile" required
                  placeholder="Enter Phone Number" />
              </div>


              <div class="form-group">
                <label>Address
                  <small class="text-muted">Home Address</small></label>
                <input type="text" class="form-control" name="address" required id="purchase-mask" placeholder="Enter Home Address" />
              </div>
              <div class="form-group">
                <label>Username
                  <small class="text-muted">Username </small></label>
                <input type="text" class="form-control" name="username" required id="purchase-mask" placeholder="Enter Home Address" />
              </div>
              <div class="form-group">
                <label>Password
                  <small class="text-muted">Secret keys</small></label>
                <input type="password" class="form-control" name="password" required id="purchase-mask" placeholder="Enter Home Address" />
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-success text-white">
                  Save
                </button>
              </div>
              </form>
            </div>
          <?php
         }
         ?>
          </div>
        </div>
      </div>

    </div>

  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap tether Core JavaScript -->
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- slimscrollbar scrollbar JavaScript -->
  <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
  <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
  <!--Wave Effects -->
  <script src="../dist/js/waves.js"></script>
  <!--Menu sidebar -->
  <script src="../dist/js/sidebarmenu.js"></script>
  <!--Custom JavaScript -->
  <script src="../dist/js/custom.min.js"></script>
  <!-- this page js -->
  <script src="../assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
  <script src="../assets/extra-libs/multicheck/jquery.multicheck.js"></script>
  <script src="../assets/extra-libs/DataTables/datatables.min.js"></script>
  <script>
    /****************************************
     *       Basic Table                   *
     ****************************************/
    $("#zero_config").DataTable();
  </script>
  <!-- This Page JS -->
  <script src="../assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
  <script src="../dist/js/pages/mask/mask.init.js"></script>
  <script src="../assets/libs/select2/dist/js/select2.full.min.js"></script>
  <script src="../assets/libs/select2/dist/js/select2.min.js"></script>
  <script src="../assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
  <script src="../assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
  <script src="../assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
  <script src="../assets/libs/jquery-minicolors/jquery.minicolors.min.js"></script>
  <script src="../assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <script src="../assets/libs/quill/dist/quill.min.js"></script>
  <script>
    //***********************************//
    // For select 2
    //***********************************//
    $(".select2").select2();

    /*colorpicker*/
    $(".demo").each(function () {
      //
      // Dear reader, it's actually very easy to initialize MiniColors. For example:
      //
      //  $(selector).minicolors();
      //
      // The way I've done it below is just for the demo, so don't get confused
      // by it. Also, data- attributes aren't supported at this time...they're
      // only used for this demo.
      //
      $(this).minicolors({
        control: $(this).attr("data-control") || "hue",
        position: $(this).attr("data-position") || "bottom left",

        change: function (value, opacity) {
          if (!value) return;
          if (opacity) value += ", " + opacity;
          if (typeof console === "object") {
            console.log(value);
          }
        },
        theme: "bootstrap",
      });
    });
    /*datwpicker*/
    jQuery(".mydatepicker").datepicker();
    jQuery("#datepicker-autoclose").datepicker({
      autoclose: true,
      todayHighlight: true,
    });
    var quill = new Quill("#editor", {
      theme: "snow",
    });
  </script>
</body>

</html>