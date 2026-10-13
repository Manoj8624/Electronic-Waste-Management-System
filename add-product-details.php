<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ewsuid']==0)) {
  header('location:logout.php');
  }
  else{

if(isset($_POST['submit']))
  {
    $uid=$_SESSION['ewsuid'];
    $pid=mt_rand(100000000, 999999999);
    $catid=$_POST['catid'];
    $pname=$_POST['pname'];
    $model=$_POST['model'];
    $description=$_POST['description'];
    $expprice=$_POST['expprice'];
   

    $statename=$_POST['state'];
    $cityname=$_POST['city'];
    
    $pdate=$_POST['pdate'];
    $padd=$_POST['padd'];
    $contactperson=$_POST['contactperson'];
    $cpmobnum=$_POST['cpmobnum'];
    
     $pic=$_FILES["images"]["name"];
     $pic1=$_FILES["images1"]["name"];
     $extension = substr($pic,strlen($pic)-4,strlen($pic));
     $extension1 = substr($pic1,strlen($pic)-4,strlen($pic1));
// allowed extensions
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
$allowed_extensions1 = array(".jpg","jpeg",".png",".gif");
// Validation for allowed extensions .in_array() function searches an array for a specific value.
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
if(!in_array($extension1,$allowed_extensions))
{
echo "<script>alert('Product image1 has Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{

$productpic1=md5($pic.time()).$extension;
$productpic2=md5($pic1.time()).$extension;
     move_uploaded_file($_FILES["images"]["tmp_name"],"images/".$productpic1);
     move_uploaded_file($_FILES["images1"]["tmp_name"],"images/".$productpic2);


    $query=mysqli_query($con, "insert into tblproduct(UserID,ProductId,CategoryID,ProductName,ModelorType,Description,ExpectedPrice,PickupDate,PickupAddress,StateName, CityName,ContactPerson,CPMobNumber,Image1,Image2) value('$uid','$pid','$catid','$pname','$model','$description','$expprice','$pdate','$padd','$statename','$cityname','$contactperson','$cpmobnum','$productpic1','$productpic2')");

    if ($query) {
    echo "<script>alert('Product Detail added successfully.');</script>";
echo "<script type='text/javascript'> document.location = 'add-product-details.php'; </script>";
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
<title>Electronic Waste System  | Add Product Detail </title>

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
                List Your Product Details
            </header>
            <div class="panel-body">
                
                <form class="form-horizontal bucket-form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Category</label>
                        <div class="col-sm-6">
                             <select class="form-control m-bot15" name="catid" id="catid">
                                <option value="">Choose Category</option>
                                <?php $query=mysqli_query($con,"select * from tblcategory");
              while($row=mysqli_fetch_array($query))
              {
              ?>    
              <option value="<?php echo $row['ID'];?>"><?php echo $row['CategoryName'];?></option>
                  <?php } ?> 
                            </select>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Product Name</label>
                        <div class="col-sm-6">
                             <input class="form-control" id="pname" name="pname" type="text" required="true" value="">
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Model/Type</label>
                        <div class="col-sm-6">
                             <input class="form-control" id="model" name="model" type="text" required="true" value="">
                            
                        </div>
                    </div>
               

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="description" name="description" type="text" required="true" value="">
</textarea>                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Expected Price</label>
                        <div class="col-sm-6">
                             <input class="form-control" id="expprice" name="expprice" type="text" required="true" value="">
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pickup Date</label>
                        <div class="col-sm-6">
                            <input class="form-control" id="pdate" name="pdate" type="date" required="true" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pickup Address</label>
                        <div class="col-sm-6">
                             <textarea class="form-control" id="padd" name="padd" type="text" required="true" value="">
</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">Choose State</label>
                        <div class="col-lg-6">
                            <select class="form-control m-bot15" name="state" id="state" onChange="getCity(this.value);">
                                <option value="">Choose State</option>
                                <?php $query=mysqli_query($con,"select * from tblstate");
              while($row=mysqli_fetch_array($query))
              {
              ?>    
              <option value="<?php echo $row['StateName'];?>"><?php echo $row['StateName'];?></option>
                  <?php } ?> 
                            </select>

                           
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">Choose City</label>
                        <div class="col-lg-6">
                            <select class="form-control m-bot15" name="city" id="city" required="true">
              
                            </select>

                           
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Contact Person</label>
                        <div class="col-sm-6">
                            <input class="form-control" id="contactperson" name="contactperson" type="text" required="true" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Contact Person Mobile Number</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="cpmobnum" id="cpmobnum" required="true" value="" maxlength="10" pattern="[0-9]+">
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label class=" col-sm-3 control-label">Product Image-1</label>
                        <div class="col-lg-6">
                             <input type="file" class="form-control" name="images" id="images" value="">
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class=" col-sm-3 control-label">Product Image-2</label>
                        <div class="col-lg-6">
                             <input type="file" class="form-control" name="images1" id="images1" value="">
                        </div>
                    </div>

                    <hr />
<div class="form-group">
                                    <div class="col-lg-offset-3 col-lg-6">
                                        <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                                    </div>
                                </div>

                </form>
            </div>
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
<script src="../admin/js/bootstrap.js"></script>
<script src="../admin/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="../admin/js/scripts.js"></script>
<script src="../admin/js/jquery.slimscroll.js"></script>
<script src="../admin/js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="../admin/js/jquery.scrollTo.js"></script>
</body>
</html>
<?php  } ?>
