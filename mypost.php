<?php
include("sqlcon.php");
error_reporting(0);
session_start();
include("header.php")
?>

 
<div class="container">
	<div class="page">
   <h3>My Posts</h3>
   <?php 
   if(isset($_SESSION["type"]) && $_SESSION['type'] == 'alumni')
   {
     ?>
    <div class="col-md-12">         
<div class="btn-toolbar list-toolbar" style="text-align:right;">
    <a href="jobposting.php">
    <button class="btn btn-primary"><i class="fa fa-plus"></i> Post Job</button></a>
  <div class="btn-group">
  </div>
</div> <br/>
</div>
<?php
   }
     ?>
   
 <?php
  $res = mysqli_query($con, "Select * from tbljob inner join tbluser on tbljob.alumnid=tbluser.userid where tbljob.status='Active' and tbluser.name = '".$_SESSION["name"]."'");
  if(mysqli_num_rows($res) >0)
  {
while($result = mysqli_fetch_array($res))
{
	
    ?>
<div class="service-top">
			<div class="col-md-11 ser-1 animated wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="500ms">
				<div class="ser-img">
					<h6><?php echo $result['jobtitle'];   ?>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:blue;">Posted By: <?php echo $result['name'];   ?></span></h6>
					<a href="deletepost.php?id=<?php echo $result[0]; ?>"><i class="glyphicon glyphicon-cross">Delete</i></a>

					
					<div class="clearfix"> </div>
				</div>
				<p><span style="font-size: 30px; font-weight: bold; color: black;"><?php echo $result['company'];   ?></span><br/><?php echo $result['exp_required'];   ?> Yrs. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<i class="glyphicon glyphicon-map-marker"></i> <?php echo $result['job_location'];   ?>
				<br/>
				Job Description : &nbsp;&nbsp;&nbsp;<?php echo $result['jobdescription'];   ?><br/>
				Key Skills:&nbsp;&nbsp;&nbsp;<?php echo $result['keyskils'];   ?><br/>
				<span style="color:green;font-weight:bold;">Pay Scale: BDT <?php echo $result['salary'];   ?> P.A.</span></p>
				
			</div>
			
			<div class="clearfix"> </div>
		
			</div>
		<?php
}
  }
  else
  {
	  echo "<div class='service-top' style='min-height:400px;'><h3 align='center'>You Haven't Posted Yet!!.</h3></div>";
  }
  ?>	
