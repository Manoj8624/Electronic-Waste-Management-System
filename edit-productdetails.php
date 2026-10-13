<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ewsuid']==0)) {
  header('location:logout.php');
  }
  else{

if(isset($_POST['submit']))
  {
    $eid=$_GET['editid'];
    $catid=$_POST['catid'];
    $pname=$_POST['pname'];
    $model=$_POST['model'];
    $description=$_POST['description'];
    $expprice=$_POST['expprice'];
    $statename=$_POST['state'];
    $cityname=$_POST['city'];
    $pdate=$_POST['pdate'];
    $padd=$_POST['address'];
    $contactperson=$_POST['contactperson'];
    $cpmobnum=$_POST['cpmobnum'];
    
    $query=mysqli_query($con, "update tblproduct set CategoryID='$catid',ProductName='$pname',ModelorType='$model',Description='$description',ExpectedPrice='$expprice',PickupDate='$pdate', PickupAddress='$padd',StateName='$statename', CityName='$cityname',  ContactPerson='$contactperson',CPMobNumber='$cpmobnum' where ID='$eid'");
    if ($query) {
  
     echo "<script>alert('Product detail has been updated successfully');</script>";
  }
  else
    {
      echo "<script>alert('Something went wrong. Please try again.');</script>";
    }

  }
}
  ?>
<!DOCTYPE html>
<head>
<title>Electronic Waste System  | Product Updation </title>

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
<script>
function getCity(val) { 
  $.ajax({
type:"POST",
url:"get-city.php",
data:'sateid='+val,
success:function(data){
$("#city").html(data);
}});
}
 </script>


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
	<div class="form-w3layouts">
    
        <div class="row">
        <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Update Product Details
            </header>

            <div class="panel-body">
     <?php
 $cid=$_GET['editid'];
$ret=mysqli_query($con,"select tblcategory.ID as cid,tblcategory.CategoryName,tblproduct.* from  tblproduct join tblcategory on tblcategory.ID=tblproduct.CategoryID where tblproduct.ID='$cid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
                <form class="form-horizontal bucket-form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Category</label>
                        <div class="col-sm-6">
                             <select class="form-control m-bot15" name="catid" id="catid">
                                <option value="<?php echo $row['ID'];?>"><?php echo $row['CategoryName'];?></option>
                                <?php $query1=mysqli_query($con,"select * from tblcategory");
              while($row1=mysqli_fetch_array($query1))
              {
              ?>    
              <option value="<?php echo $row1['ID'];?>"><?php echo $row1['CategoryName'];?></option>
                  <?php } ?> 
                            </select>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Product Name</label>
                        <div class="col-sm-6">
                             <input class="form-control" id="pname" name="pname" type="text" required="true" value="<?php echo $row['ProductName'];?>">
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Model/Type</label>
                        <div class="col-sm-6">
                             <input class="form-control" id="model" name="model" type="text" required="true" value="<?php echo $row['ModelorType'];?>">
                            
                        </div>
                    </div>
                    
                  
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="description" name="description" type="text" required="true" value=""><?php echo $row['Description'];?>
</textarea>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-3 control-label">Expected Price</label>
                        <div class="col-sm-6">
                             <input class="form-control" id="expprice" name="expprice" type="text" required="true" value="<?php echo $row['ExpectedPrice'];?>">
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pickup Date</label>
                        <div class="col-sm-6">
                            <input class="form-control" id="pdate" name="pdate" type="date" required="true" value="<?php echo $row['PickupDate'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pickup Address</label>
                        <div class="col-sm-6">
                            <textarea type="text" class="form-control" name="address" id="address" required="true"><?php echo $row['PickupAddress'];?></textarea>
                        </div>
                    </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">Choose State</label>
                        <div class="col-lg-6">
                           
                 <select class="form-control m-bot15" name="state" id="state" onChange="getCity(this.value);">
                                <option value="<?php echo $row['StateName'];?>"><?php echo $row['StateName'];?></option>
                                <?php $query2=mysqli_query($con,"select * from tblstate");
              while($row2=mysqli_fetch_array($query2))
              {
              ?>    
              <option value="<?php echo $row2['StateName'];?>"><?php echo $row2['StateName'];?></option>
                  <?php } ?> 
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">Choose City</label>
                        <div class="col-lg-6">
                          <select class="form-control m-bot15" name="city" id="city" required="true">
                 <option value="<?php echo $row['CityName'];?>"><?php echo $row['CityName'];?></option>
                            </select>  


                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Contact Person</label>
                        <div class="col-sm-6">
                            <input class="form-control" id="contactperson" name="contactperson" type="text" required="true" value="<?php echo $row['ContactPerson'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Contact Person Mobile Number</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="cpmobnum" id="cpmobnum" required="true" value="<?php echo $row['CPMobNumber'];?>" maxlength="10" pattern="[0-9]+">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class=" col-sm-3 control-label">Image 1</label>
                        <div class="col-lg-6">
                             <img src="images/<?php echo $row['Image1'];?>" width="200" height="150" value="<?php  echo $row['Image1'];?>"><a href="changeimage.php?editid=<?php echo $row['ID'];?>">Edit Image</a>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class=" col-sm-3 control-label">Image 2</label>
                        <div class="col-lg-6">
                             <img src="images/<?php echo $row['Image2'];?>" width="200" height="150" value="<?php  echo $row['Image2'];?>"><a href="changeimage1.php?editid=<?php echo $row['ID'];?>">Edit Image</a>
                        </div>
                    </div>


                    <hr />
<div class="form-group">
                                    <div class="col-lg-offset-3 col-lg-6">
                                        <button class="btn btn-primary" type="submit" name="submit">Update</button>
                                    </div>
                                </div>

                </form>
            </div>
            <?php } ?>
        </section>



        <!-- page end-->
        </div>
</section>
 <!-- footer -->
		  <?php include_once('includes/footer.php');?>
  <!-- / footer -->
</section>

<!--main content end-->
</section>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
</body>
</html>

