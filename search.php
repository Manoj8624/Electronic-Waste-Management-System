<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ewsuid']==0)) {
  header('location:logout.php');
  } else{

?>


<!DOCTYPE html>
<head>
<title>Electronic Waste System||Search Listed Product Details </title>
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
    

       <form class="cmxform form-horizontal" method="post" action="" name="search">
                                   
                               
                                    <div class="form-group ">
                                        <label for="username" class="control-label col-lg-6">Search by Request Number / User Name / User Mobile No:</label>
                                        <div class="col-lg-6">
                                            <input type="text" name="searchdata" id="searchdata" class="form-control" value="" required="true">
                                        </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                          <p style="text-align: center;"> <button class="btn btn-primary" type="submit" name="search">Search</button></p>
                                           
                                        </div>
                                    </div>

                                </form>
                                <?php
if(isset($_POST['search']))
{ 

$sdata=$_POST['searchdata'];
  ?>
  
<div class="panel-heading">
Result against "<?php echo $sdata;?>" keyword</div>

      <table class="table table-bordered">
 

       <thead>
          <tr>
            <th data-breakpoints="xs">S.NO</th>
            <th>Product Id</th>
            <th>Product Category</th>
            <th>Register By</th>
            
            <th>Product Items</th>
            <th>Request Date</th>
            <th>Status</th>
            <th data-breakpoints="xs">Action</th>
          </tr>
        </thead>
          
         <?php
        $uid =$_SESSION['ewsuid'];
$ret=mysqli_query($con,"select tblproduct.ID as pid,tblproduct.ProductId,tblproduct.Status,tblproduct.ContactPerson,tblproduct.CPMobNumber,tblproduct.CreationDate,tblproduct.ProductName,tblcategory.ID,tblcategory.CategoryName,tbluser.FullName,tbluser.MobileNumber from  tblproduct join tbluser on tblproduct.UserID=tbluser.ID join tblcategory on tblproduct.CategoryID=tblcategory.ID where tblproduct.UserID='$uid' && (tblproduct.ProductId like '%$sdata%' || tbluser.FullName  like '%$sdata%' || tbluser.MobileNumber like '%$sdata%') ");
$cnt=1;
$count=mysqli_num_rows($ret);
if($count>0){
while ($row=mysqli_fetch_array($ret)) {

?>
        
        <tr data-expanded="true">
            <td><?php echo $cnt;?></td>
              <td><?php  echo $row['ProductId'];?></td>
              <td><?php  echo $row['CategoryName'];?></td>
                  <td><?php  echo $row['FullName'];?></td>
                  <td><?php  echo $row['ProductName'];?></td>
                  <td><?php  echo $row['CreationDate'];?></td>

                 <td> <?php  
if($row['Status']==""){
echo "Not Confirmed Yet";
}else{
echo $row['Status'];}
;?></td>
                  <td><a href="product-details.php?pid=<?php echo $row['pid'];?>&&productid=<?php echo $row['ProductId'];?>" class="btn btn-primary">View</a></td>
                </tr>
                <?php 
$cnt=$cnt+1;
}} else {?>
<tr>
  <td colspan="9" style="color:red">No Record Found</td>
</tr>

<?php } ?>  

            </table>
            <?php } ?>
            
          
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