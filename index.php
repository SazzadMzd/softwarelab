<?php
include("sqlcon.php");

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
	<meta name="keywords" content="Vigor Responsive web template, Bootstrap Web Templates, Flat Web Templates, AndroId Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
	<!--header-->
	<div class="header">
		<div class="container">
			<div class="header-top">
				<div class="col-sm-2 header-login">
					<div class=" logo animated wow shake" data-wow-duration="1000ms" data-wow-delay="500ms">
						<h1><a href="index.php">UIU NEXUS </a> </h1>
					</div>
				</div>
				<div class="col-sm-10 header-social ">

					<ul class="social-icon">
						<?php
						if (!isset($_SESSION["type"])) {
						?>
							<li><a href="adminlogin.php" style="font-weight:bold;"> Admin Login</a></li>
						<?php
						} else {
							echo "<li><a href='#' style='font-weight:bold;'>Welcome " . $_SESSION["name"] . "</a></li>";
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
	<div class="banner-head">
		<div class="col-sm-10 col-sm-offset-1 banner-top">
			<div class=" banner animated wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="500ms">

			</div>

		</div>
		<div class="clearfix"> </div>
	</div>
	<!--content-->
	<div class="content">
		<!--welcome-->
		<div class="col-top">
			<div class="container">

				<marquee behavior="scroll" scrollamount="5" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
					<h3>Welcome to UIU NEXUS - An Interactive Alumni & Student Platform </h3>
				</marquee>

				<div class="content-top">
					<div class="col-md-4 content-top-1 animated wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="500ms">
						<h4>Alumni today are the best source of jobs, donation & knowledge capital for you institute,
							so get them back by signing up for ALUMNI today! </h4>
					</div>
					<div class="col-md-8 content-top-2 animated wow fadeInRight" data-wow-duration="1000ms" data-wow-delay="500ms">

						<p>Alumni of a college generally stay in touch with their immediate friends but find it hard to stay connected with other college mates. Contact between alumni can be used to forge business connections and to gain references or insight in a new field. Alumni work can consist of alumni mentoring students, organizing alumni days, having training sessions during alumni days for alumni, inviting alumni to give lectures, arranging work practices, and proposing topics of theses, raise funds for the organizations. It is important to carry out a good follow-up marketing of alumni events.</p>



					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>

		<div class="content-mid">
			<div class="container">
				<div class="content-mid-top">
					<h3> Events</h3>
					<p>It is important to carry out a good follow-up marketing of alumni events. With over 100 worldwide events a year, you have a wealth of alumni networking opportunities.</p>

				</div>
				<div class="news">
					<?php
					$rs = mysqli_query($con, "select * from tblalumnimeet where status='Active' and event_date >= CURDATE() order by eventid DESC LIMIT 3");
					if (mysqli_num_rows($rs) > 0) {
						while ($rowd = mysqli_fetch_array($rs)) {
							$event_date = $rowd['event_date'];
							$parts = explode("-", $event_date);
							$day = $parts[2];
							$dateobj = DateTime::createFromFormat('!m', $parts[1]);
							$month = $dateobj->format('F');
							// Limit description to two lines
							$description = $rowd['description'];
							$truncated_description = (strlen($description) > 100) ? substr($description, 0, 100) . '...' : $description;
					?>
							<div class="new-more animated wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="500ms">
								<!--<div class="col-md-2 new-1">
								<a href="single.html"><img src="images/ev.jpg" class="img-responsive" alt=""></a>
							</div>-->
								<div class="col-md-2 six">
									<h4><?php echo $day;   ?><span><?php echo $month;   ?></span></h4>

								</div>
								<div class="col-md-7 new-2">
									<h3><?php echo $rowd['event_name'];   ?></h3>
									<p><?php echo $truncated_description;   ?></p>
								</div>
								<div class="col-md-3 new-3">
									<a class="more1 hvr-sweep-to-bottom" href="event_info.php?eventid=<?php echo $rowd[0];   ?>">Read More</a>
								</div>
								<div class="clearfix"> </div>
								<hr>
							</div>
					<?php
						}
					} else {
						echo "<h3 align='center'>No Upcoming Events</h3>";
					}
					?>

				</div>
			</div>
		</div>

	</div>

	<?php
	include("footer.php");
	?>