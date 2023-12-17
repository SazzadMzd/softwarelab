<?php
error_reporting(0);
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Alumni Management System</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<script src="js/jquery.min.js"></script>
<!--theme-style-->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<!--//theme-style-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/fontawesome.min.css" integrity="sha512-siarrzI1u3pCqFG2LEzi87McrBmq6Tp7juVsdmGY1Dr8Saw+ZBAzDzrGwX3vgxX1NkioYNCFOVC0GpDPss10zQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href='//fonts.googleapis.com/css?family=Simonetta:400,900' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
<script src="js/bootstrap.min.js"></script>
<!--pop-up-box-->
	<script type="text/javascript" src="js/modernizr.custom.53451.js"></script>  
	<link href="css/popup-box.css" rel="stylesheet" type="text/css" media="all">
	<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
<!--pop-up-box-->
<!-- animation-effect -->
<link href="css/animate.min.css" rel="stylesheet"> 
<script src="js/wow.min.js"></script>
<script>
 new WOW().init();
</script>
<!-- //animation-effect -->
</head>
<body>
<!--header-->
<div class="header">
	<div class="container">
		<div class="header-top">
			<div class="col-sm-2 header-login">
				<div class=" logo animated wow shake" data-wow-duration="1000ms" data-wow-delay="500ms">
					<h1><a href="index.php">UIU NEXUS</a></h1>
				</div>
			</div>	
			<div class="col-sm-10 header-social ">
							
				 <ul class="social-icon">
				 <?php
				 if(!isset($_SESSION["type"]))
				 {
				 ?>
						<li><a href="adminlogin.php" style="font-weight:bold;"> Admin Login</a></li>
				 <?php
				 }
				 else
				 {
					 echo "<li><a href='#' style='font-weight:bold;'>Welcome ".$_SESSION["name"]."</a></li>";
				 }
				 ?>
						<!--<li><a href="#"><i class="ic1"></i></a></li>
						<li><a href="#"><i class="ic2"></i></a></li>
						<li><a href="#"><i class="ic3"></i></a></li>
						<li><a href="#"><i class="ic4"></i></a></li>-->
					</ul> 
					<div class="clearfix"> </div>
     		<div class="head">
<?php include("menu.php"); ?>
		</div>
					
			</div>
				<div class="clearfix"> </div>
		</div>

	</div>
</div>


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>