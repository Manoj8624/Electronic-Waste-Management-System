<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ewsuid']==0)) {
  header('location:logout.php');
  } 
     ?>
<!DOCTYPE html>
<head>
<title>Electronic Waste System | dashboard </title>
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
<link rel="stylesheet" href="../admin/css/morris.css" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="../admin/css/monthly.css">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="../admin/js/jquery2.0.3.min.js"></script>
<script src="../admin/js/raphael-min.js"></script>
<script src="../admin/js/morris.js"></script>
</head>
<body>
<section id="container">
<!--header start-->

<!--header end-->
<?php include_once('includes/header.php');?>
<!--sidebar start-->

<!--sidebar end-->
<?php include_once('includes/sidebar.php');?>
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<!-- //market-->
		<div class="market-updates">
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-laptop fa-3x"> </i>
					</div>
					
					<?php 
$uid=$_SESSION['ewsuid'];
					$query=mysqli_query($con,"Select * from  tblproduct where UserID='$uid'");
$listedprod=mysqli_num_rows($query);
?>
					 <div class="col-md-8 market-update-left">
					 <a href="manage-product-details.php"><h4>Total Listed Product</h4></a>
					<h3><?php echo $listedprod;?></h3>
					
				  </div>
				  <div class="clearfix"> </div>
				</div>
			</div>




			<?php 
					$query=mysqli_query($con,"Select * from  tblproduct where UserID='$uid' and (tblproduct.Status='' || tblproduct.Status is null)");
$newproducts=mysqli_num_rows($query);
?>
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-5">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-plus-circle fa-3x" ></i>
					</div>
					<div class="col-md-8 market-update-left">
					<a href="all-products-status.php" style="color:#fff;"><h4>New Products </h4></a>
						<h3><?php echo $newproducts;?></h3>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>

			<?php 
					$query=mysqli_query($con,"Select * from  tblproduct where UserID='$uid' and (tblproduct.Status='Assigned')");
$assignedreq=mysqli_num_rows($query);
?>
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-5">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-tasks fa-3x" ></i>
					</div>
					<div class="col-md-8 market-update-left">
					<a href="all-products-status.php" style="color:#fff;"><h4>Assign Product Request </h4></a>
						<h3><?php echo $assignedreq;?></h3>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		
			<?php 
					$query=mysqli_query($con,"Select * from  tblproduct where UserID='$uid' and (tblproduct.Status='Sent For Recycle')");
$sfrreq=mysqli_num_rows($query);
?>
			<div class="col-md-4 market-update-gd" style="margin-top:1%;">
				<div class="market-update-block clr-block-4">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-recycle fa-3x" ></i>
					</div>
					<div class="col-md-8 market-update-left">
					<a href="all-products-status.php"><h4>Product Sent For Recycle</h4></a>
						<h3><?php echo $sfrreq;?></h3>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>	

			<?php 
					$query=mysqli_query($con,"Select * from  tblproduct where UserID='$uid' and (tblproduct.Status='Recycled')");
$recycledreq=mysqli_num_rows($query);
?>
			<div class="col-md-4 market-update-gd" style="margin-top:1%;">
				<div class="market-update-block clr-block-1">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-leaf fa-3x" ></i>
					</div>
					<div class="col-md-8 market-update-left">
					<a href="all-products-status.php"><h4>Recycled Products </h4></a>
						<h3><?php echo $recycledreq;?></h3>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>	

			<?php 
					$query=mysqli_query($con,"Select * from  tblproduct where UserID='$uid' and (tblproduct.Status='Rejected')");
$recjectedreq=mysqli_num_rows($query);
?>
			<div class="col-md-4 market-update-gd" style="margin-top:1%;">
				<div class="market-update-block clr-block-2">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-trash fa-3x" ></i>
					</div>
					<div class="col-md-8 market-update-left">
					<a href="all-products-status.php"><h4>Rejected Products </h4></a>
						<h3><?php echo $recjectedreq;?></h3>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>	




		   <div class="clearfix"> </div>
		</div>	
		
	
			<!-- tasks -->
		

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
<!-- morris JavaScript -->	
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="../admin/js/monthly.js"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
	<!-- //calendar -->
</body>
</html>
