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
   $cid=$_GET['editid'];

     $pgpic=$_FILES["images"]["name"];
     $extension = substr($pgpic,strlen($pgpic)-4,strlen($pgpic));
// allowed extensions
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
// Validation for allowed extensions .in_array() function searches an array for a specific value.
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{

$ppic=md5($pgpic).$extension;
     move_uploaded_file($_FILES["images"]["tmp_name"],"images/".$ppic);
    $query=mysqli_query($con, "update tblproduct set Image2='$ppic' where ID='$cid'");
    if ($query) {
  
      echo "<script>alert('Product image has been Update');</script>";
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
<title>Electronic Waste System  | Update Image Second </title>

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
    <div class="form-w3layouts">
    
        <div class="row">
        <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Update Image
            </header>
            <div class="panel-body">
                

  <?php
 $cid=$_GET['editid'];
$ret=mysqli_query($con,"select * from tblproduct where ID='$cid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
                <form class="form-horizontal bucket-form" method="post" enctype="multipart/form-data">
                                    
                  
                    <div class="form-group">
                        <label class=" col-sm-3 control-label">Old Pictures</label>
                        <div class="col-lg-6">
                             <img src="images/<?php echo $row['Image2'];?>" width="200" height="150" value="<?php  echo $row['Image2'];?>">
                        </div>
                    </div>
                 <div class="form-group">
                        <label class=" col-sm-3 control-label">New Pictures</label>
                        <div class="col-lg-6">
                             <input type="file" class="form-control" name="images" id="images" value="">
                        </div>
                    </div>
<?php  } ?>
                    <hr />
<div class="form-group">
                                    <div class="col-lg-offset-3 col-lg-6">
                                        <button class="btn btn-primary" type="submit" name="submit">Update</button>
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