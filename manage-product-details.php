<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ewsuid']==0)) {
  header('location:logout.php');
  } else{
if($_GET['action']=='delete'){
$bsid=intval($_GET['bsid']);
$query=mysqli_query($con,"delete from tblproduct where ID='$bsid'");
if($query){
unlink($ppicpath);
echo "<script>alert('Product details deleted successfully.');</script>";
echo "<script type='text/javascript'> document.location = 'manage-product-details.php'; </script>";
} else {
echo "<script>alert('Something went wrong. Please try again.');</script>";
}

}
?>


<!DOCTYPE html>
<head>
<title>Electronic Waste System || Manage Product Detail </title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="../admin/css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="../admin/css/style.css" rel='stylesheet' type='text/css' />
<link href="../admin/css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="../admin/css/font.css" type="text/css"/>
<link href="../admin/css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="../admin/js/jquery2.0.3.min.js"></script>
</head>
<body>
<section id="container">
<!--header start-->
<?php include_once('includes/header.php');?>
<!--header end-->
<!--sidebar start-->
<?php include_once('includes/sidebar.php');?>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="table-agile-info">
 <div class="panel panel-default">
    <div class="panel-heading">
     Product Details
    </div>
    <div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th data-breakpoints="xs">S.NO</th>
            <th>Product Id</th>
            <th>Product Category</th>
            <th>Product Name</th>
            <th>Contact Person</th>
            <th>Mobile Number</th>
            <th>State Name</th>
            <th>City Name</th>
            <th>Listing Date</th>
            <th data-breakpoints="xs">Action</th>
           
           
          </tr>
        </thead>
        <?php
        $uid=$_SESSION['ewsuid'];

$ret=mysqli_query($con,"select tblcategory.ID as cid,tblcategory.CategoryName,tblproduct.* from  tblproduct join tblcategory on tblcategory.ID=tblproduct.CategoryID where tblproduct.UserID='$uid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
        <tbody>
          <tr data-expanded="true">
            <td><?php echo $cnt;?></td>
            <td><?php  echo $row['ProductId'];?></td>
            <td><?php  echo $row['CategoryName'];?></td>
            <td><?php  echo $row['ProductName'];?></td>
              <td><?php  echo $row['ContactPerson'];?></td>
              <td><?php  echo $row['CPMobNumber'];?></td>
                  <td><?php  echo $row['StateName'];?></td>
                  <td><?php  echo $row['CityName'];?></td>
                  <td><?php  echo $row['CreationDate'];?></td>
                  <td><a href="edit-productdetails.php?editid=<?php echo $row['ID'];?>&&requestid=<?php echo $row['ProductId'];?>" class="btn btn-primary">Update</a><br /><br /><a href="manage-product-details.php?action=delete&&bsid=<?php echo $row['ID']; ?>"  title="Delete this record" onclick="return confirm('Do you really want to delete this record?');" class="btn btn-danger">Delete </a>
                </tr>
                <?php 
$cnt=$cnt+1;
}?>
 </tbody>
            </table>
            
            
          
    </div>
  </div>
</div>
</section>
 <!-- footer -->
		 <?php include_once('includes/footer.php');?>  
  <!-- / footer -->
</section>

<!--main content end-->
</section>
<script src="../admin/js/bootstrap.js"></script>
<script src="../admin/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="../admin/js/scripts.js"></script>
<script src="../admin/js/jquery.slimscroll.js"></script>
<script src="../admin/js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="../admin/js/jquery.scrollTo.js"></script>
</body>
</html>
<?php }  ?>