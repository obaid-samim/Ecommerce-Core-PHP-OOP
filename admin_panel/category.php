<?php
  require_once '../classes/Crud.php';
  $obj = new Crud();
  $no_of_records_per_page = 5;

  if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
  }else{
    $pageno =1;
  }
  $offset = ($pageno - 1 )* $no_of_records_per_page;
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SpringTime</title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="inc/css/style.css" type="text/css" media="all" />
<link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css" media="all" />
</head>
<body>
<!-- Header -->
<div id="header">
  <div class="shell">
    <!-- Logo + Top Nav -->
    <div id="top">
      <h1><a href="#">Category</a></h1>
      <div id="top-navigation"> Welcome <a href="#"><strong>Administrator</strong></a> <span>|</span> <a href="#">Order</a><span>|</span> <a href="#">Delivery</a> <span>|</span> <a href="#">User</a> <span>|</span> <a href="#">Log out</a> </div>
    </div>
    <!-- End Logo + Top Nav -->
    <!-- Main Nav -->
    <div id="navigation">
      <ul>
        <li><a href="dashboard.php" class="active"><span>Dashboard</span></a></li>
        <li><a href="#"><span>Brand</span></a></li>
        <li><a href="#"><span>Category</span></a></li>
        <li><a href="#"><span>Orders</span></a></li>
        <li><a href="#"><span>Products</span></a></li>
        <li><a href="#"><span>Delivery</span></a></li>
        <li><a href="#"><span>Slider</span></a></li>
        <li><a href="#"><span>Settings</span></a></li>
        <li><a href="#"><span>Profile</span></a></li>
        <li><a href="#"><span>Logout</span></a></li>
      </ul>
    </div>
    <!-- End Main Nav -->
  </div>
</div>
<!-- End Header -->
<!-- Container -->
<div id="container">
  <div class="shell">
    <!-- Small Nav -->
    <div class="small-nav"> <a href="#">Dashboard</a> <span>&gt;</span> Current Articles </div>
    <!-- End Small Nav -->
    <!-- Message OK -->
    <div class="msg msg-ok">
      <p><strong>Your file was uploaded succesifully!</strong></p>
      <a href="#" class="close">close</a> </div>
    <!-- End Message OK -->
    <!-- Message Error -->
    <div class="msg msg-error">
      <p><strong>You must select a file to upload first!</strong></p>
      <a href="#" class="close">close</a> </div>
    <!-- End Message Error -->
    <br />
    <!-- Main -->
    <div id="main">
      <div class="cl">&nbsp;</div>
      <!-- Content -->
      <div id="content">
        <!-- Box -->
        <div class="box">
          <!-- Table -->
          <div class="table">
             <!-- Box -->
        <div class="box">
          <!-- Box Head -->
          <div class="box-head">
            <h2>Add Category</h2>
          </div>
          <!-- End Box Head -->
          <form action="#" method="post">
            <!-- Form -->
            <div class="form">
              <p> <span class="req">max 100 symbols</span>
                <label>Category Name <span>(Required Field)</span></label>
                <input name="catName" id="catName" type="text" class="field size1" />
               <?php require_once 'cat_insert.php';?>
              </p>
              <p> <span class="req">max 100 symbols</span>
                <label>Empty <span>(Required Field)</span></label>
                <table class="table table-bordered">
                  <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                  <?php foreach($obj->get('tbl_category',$offset,$no_of_records_per_page) as $row){?>
                  <tr>
                    <td><?php echo $row['catId'] ?></td>
                    <td><?php echo $row['catName'] ?></td>
                    <td><?php echo $row['cat_created_at'] ?></td>
                    <td><a href="#" id="<?php echo $row['catId']; ?>" class="btn btn-primary">Edit</a></td>
                    <td><a href="<?php echo $row['catId'] ?>" class="btn btn-danger delete" >Delete</a></td>
                  </tr>
                  <?php } ?>
                </table>
                <!-- Pagging -->
                <nav aria-label="...">
                <ul class="pagination justify-content-center">
                  <li class="page-item <?php if($pageno <= $total_pages){echo 'disabled';} ?> "><a class="page-link" href="?pageno=1">First One</a></li>
                <?php
                $total_pages = $obj->pagination('tbl_category', $no_of_records_per_page);
                  for ($i=1; $i <= $total_pages; $i++) 
                  { 
                    echo '<li class="page-item"><a class="page-link" href="?pageno='.$i.' ">'.$i.'</a></li>';
                  }
                 ?>
                 <li class="page-item <?php if($pageno >= $total_pages){echo 'disabled';}  ?>"><a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Last One</a></li>
                 </ul>
              </nav>
            <!-- End Pagging -->          
  </p>
            </div>
            <!-- End Form -->
            <!-- Form Buttons -->
            <div class="buttons">
              <input type="submit" class="btn btn-success btn-sm" value="Save" />
            </div>
            <!-- End Form Buttons -->
          </form>
        </div>
        <!-- End Box -->
          </div>
          <!-- Table -->
        </div>
        <!-- End Box -->
       
      </div>
      <!-- End Content -->
      <!-- Sidebar -->
      <div id="sidebar">
        <!-- Box -->
        <div class="box">
          <!-- Box Head -->
          <div class="box-head">
            <h2>Management</h2>
          </div>
          <!-- End Box Head-->
          <div class="box-content"> <a href="#" class="add-button"><span>Add new Article</span></a>
            <div class="cl">&nbsp;</div>
            <p class="select-all">
              <input type="checkbox" class="checkbox" />
              <label>select all</label>
            </p>
            <p><a href="#">Delete Selected</a></p>
            <!-- Sort -->
            <div class="sort">
              <label>Sort by</label>
              <select class="field">
                <option value="">Title</option>
              </select>
              <select class="field">
                <option value="">Date</option>
              </select>
              <select class="field">
                <option value="">Author</option>
              </select>
            </div>
            <!-- End Sort -->
          </div>
        </div>
        <!-- End Box -->
      </div>
      <!-- End Sidebar -->
      <div class="cl">&nbsp;</div>
    </div>
    <!-- Main -->
  </div>
</div>
<!-- End Container -->
<!-- Footer -->
<div id="footer">
  <div class="shell"> <span class="left">&copy; 2010 - CompanyName</span> <span class="right"> Design by <a href="http://chocotemplates.com">Chocotemplates.com</a> </span> </div>
</div>
<!-- End Footer -->
<script src="../js/bootstrap.min.js"></script>

</body>
</html>
<script>
  
  $('.delete').click(function(){
    var id = $(this).data('id');
    alert(id);
  })

</script>