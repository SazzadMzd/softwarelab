<?php
include("sqlcon.php");
if(isset($_POST["Apply"]))
{
  $upload_dir ="C:/xampp/htdocs/Alumni-student-system/images/resumes/";
	      $filename = $upload_dir . $_FILES["uploadresume"]["name"];
        move_uploaded_file($_FILES["uploadresume"]["tmp_name"], $filename);
        $file_content = file_get_contents($_FILES["uploadresume"]["tmp_name"]);

	$date = date("Y-m-d");
	$qry = "insert into tbljobappln(jobid,candidatename,contactno,emailid,applndate,resumecopy,coverletter) values ('".$_POST['jobid']."','".$_POST['candidatename']."','".$_POST['contactno']."','".$_POST['email']."','$date','".$filename."','".$_POST['coverletter']."')";
	if(mysqli_query($con, $qry))
	{ 
    header('Location: send_mail.php');
    echo "<script>alert('Please check your email for confirmation.');</script>";
		echo "<script>window.location='job.php';</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
?>
<div class="bs-example" data-example-id="simple-horizontal-form">
    <form class="form-horizontal" action="jobapply.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-4 control-label">Candidate Name</label>
        <div class="col-sm-6">
		<input type="hidden" name="jobid" value="<?php echo $_GET["edit_id"]; ?>">
          <input type="text" class="form-control" id="candidatename" name="candidatename" placeholder="Candidate Name" required>
        </div>
      </div> 
	    <div class="form-group">
        <label for="inputEmail3" class="col-sm-4 control-label">Contact No</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="contactno" name="contactno" placeholder="Contact No" required>
        </div>
      </div> 
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-4 control-label">Email</label>
        <div class="col-sm-6">
		<input type="text" class="form-control" id="email" name="email" placeholder="Email">
        </div>
      </div> 
	   <div class="form-group">
        <label for="inputEmail3" class="col-sm-4 control-label">Cover Letter</label>
        <div class="col-sm-6">
		<textarea class="form-control" id="coverletter" name="coverletter" placeholder="Cover Letter" rows="3"></textarea> 
        </div>
      </div> 
	    <div class="form-group">
        <label for="inputEmail3" class="col-sm-4 control-label">Upload Resume</label>
        <div class="col-sm-6">
		<input type="file" class="form-control" id="uploadresume" name="uploadresume" placeholder="Upload Resume">
        </div>
      </div> 
      
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <input type="submit" class="btn btn-default" name="Apply" value="APPLY">
		      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
      <div style="padding-left: 68px">
      <label style="text-align: center; color: green;">**Please check your email to confirm your submission.</label>
    </div>
      
    </form>
  </div>	
  
  
