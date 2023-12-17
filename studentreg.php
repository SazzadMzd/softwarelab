<?php
include("sqlcon.php");
if(isset($_POST['register']))
{

	$filename = rand().$_FILES["profile_imge"]["name"];
	move_uploaded_file($_FILES["profile_imge"]["tmp_name"],"upload/student/".$filename);
	
	 $qry = "insert into student(name, gender, profile_imge, dob, emailid, password, address, phone, courseid, semester, status) values ('".$_POST['name']."','".$_POST['gender']."','". $filename ."','".$_POST['dob']."','".$_POST['emailid']."','".$_POST['password']."','".$_POST['address']."','".$_POST['contactno']."','".$_POST['courseid']."','".$_POST['semester']."','Inactive')";
	 
	 if(mysqli_query($con, $qry))
	 { 
		echo "<script>alert('Record inserted!!!');</script>";
		echo "<script>window.location='login.php';</script>";  
	 }
	 else
	 {
		 echo mysqli_error($con);
	 }
}
include("header.php")
?> 
<div class="container">
	<div class="page">
   <center><h3>Student Registration Panel</h3></center>
 
<div class="bs-example" data-example-id="simple-horizontal-form">
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label"></label>
        <label for="inputEmail3" class="col-sm-2 control-label">Full Name</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
        </div>
      </div> 
	  
	  <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label"></label>
        <label for="inputEmail3" class="col-sm-2 control-label">Date Of Birth</label>
        <div class="col-sm-6">
          <input type="date" class="form-control" id="dob" name="dob" placeholder="Qualification" required>
        </div>
      </div> 
	  
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label"></label>
        <label for="inputEmail3" class="col-sm-2 control-label">Gender</label>
        <div class="col-sm-6">
			<select class="form-control" name="gender" id="gender" >
				<option value="">Select Gender</option>
				<?php
				$arr = array("Male","Female");
				foreach($arr as $val)
				{
					echo "<option value='$val'>$val</option>";
				}
				?>
			</select>
        </div>
      </div> 
	  
	  
	 <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label"></label>
        <label for="inputEmail3" class="col-sm-2 control-label">Photo</label>
        <div class="col-sm-6">
          <input type="file" class="form-control" id="profile_imge" name="profile_imge" required>
        </div>
      </div>
	  
	  
	  <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label"></label>
        <label for="inputEmail3" class="col-sm-2 control-label">Email ID</label>
        <div class="col-sm-6">
          <input type="email" class="form-control" id="emailid" name="emailid" placeholder="Email Id" required=""  onchange="checkemail(this.value)">
        </div>
      </div>
	  
	  
	  
	  <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label"></label>
        <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-6">
          <input type="Password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>
      </div>
	  
	  
	  <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label"></label>
        <label for="inputEmail3" class="col-sm-2 control-label">Confirm Password</label>
        <div class="col-sm-6">
          <input type="Password" class="form-control" id="Cpass" name="Cpass" placeholder="Confirm Password" required>
        </div>
      </div>
	  
	  
	  
	 <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label"></label>
        <label for="inputEmail3" class="col-sm-2 control-label">Course</label>
        <div class="col-sm-6">
	<?php
	$sqlcourse = "SELECT * FROM `tblcourse`";
	$qsqlcourse = mysqli_query($con,$sqlcourse);
	echo mysqli_error($con);
	?>
<select class="form-control" name="courseid" id="courseid">
	<option value="">Select Course</option>
	<?php
	while($rscourse = mysqli_fetch_array($qsqlcourse))
	{
		echo  "<option value='$rscourse[courseid]'>$rscourse[coursename]</option>";
	}
	?>
</select>
        </div>
     </div> 
	  
	 <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label"></label>
        <label for="inputEmail3" class="col-sm-2 control-label">Semester</label>
        <div class="col-sm-6">
        	<select class="form-control" name="semester" id="semester" >
				<option value="">Select Semester</option>
				<?php
				$arr = array("First Semester","Second Semester","Third Semester","Fourth Semester","Fifth Semester","Sixth Semester");
				foreach($arr as $val)
				{
					echo "<option value='$val'>$val</option>";
				}
				?>
			</select>
        </div>
      </div> 
	  

	    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label"></label>
        <label for="inputEmail3" class="col-sm-2 control-label">Address</label>
        <div class="col-sm-6">
		<textarea class="form-control" id="address" name="address" placeholder="Address" rows="3"></textarea> 
        </div>
      </div> 
	    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label"></label>
        <label for="inputEmail3" class="col-sm-2 control-label">Contact No.</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="contactno" name="contactno" placeholder="Contact no." required="">
        </div>
      </div>
      <div class="form-group">
        <div class=" col-sm-12">
				<center><input type="submit" class="btn btn-default" name="register" value="REGISTER" onclick="return isPasswordMatch();">
		       <input type="reset" class="btn btn-default" name="cancel" value="CANCEL"></center>
        </div>
      </div>
    </form>
  </div>	
 
</div>
</div>

<?php
include("footer.php");
  ?>

<script>
function checkemail(email)
{
			 if (window.XMLHttpRequest) {
					// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} else {
					// code for IE6, IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							 
							if(xmlhttp.responseText.trim() == "error")																							
							{
								  document.getElementById("email").value="";
								  document.getElementById("email").focus();
								  alert("Email Id already Registred");
							}
							 
						}
					}
			var getlink = "ajaxsetup.php?studentemail="+email;
			xmlhttp.open("GET",getlink,true);
			xmlhttp.send();
}


function validateDate(doj, dob)
{
	 if (window.XMLHttpRequest) {
					// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} else {
					// code for IE6, IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							 
							if(xmlhttp.responseText.trim() == "error")
							{
								  document.getElementById("doj").value="";
								  document.getElementById("doj").focus();
								  alert("Invalid Date. Minimum age 24 years ");
							}
							 
						}
					}
			var getlink = "ajaxsetup.php?doj="+doj+"&sdob="+dob;
			xmlhttp.open("GET",getlink,true);
			xmlhttp.send();
}
</script>

<script>
function isPasswordMatch() {
    var password = document.getElementById("password");
   var confirm_password = document.getElementById("Cpass");
   
 if(document.getElementById("contactno").value.length == 0)
   {
	   alert('Enter Mobile Number');
	   document.getElementById("contactno").focus();
	   return false;
   }
   else if(document.getElementById("contactno").value.length != 10)
   {
	   alert('Inavalid Mobile Number');
	   document.getElementById("contactno").focus();
	   return false;
   }
    else if(password.value == "")
   {
	   alert('Enter Password');
	   password.focus();
	   return false;
   }
   else if(password.value.length < 6 || password.value.length >10)
   {
	   alert('Password length should be between 6 to 10.');
	   password.focus();
	   return false;
   }
   else if(password.value != confirm_password.value) 
	{
			alert('Password Mismatch!!!');
			document.getElementById("password").value = "";
			document.getElementById("Cpass").value = "";
    } 
   else 
   {
    return true;
   }
}
</script>

 <script>
$(document).ready(function(){
    $("#lecturename, #designation, #qualification").keypress(function(event){
        var inputValue = event.which;
        // allow letters and whitespaces only.
        if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) { 
            event.preventDefault(); 
        }
    });
});
</script>