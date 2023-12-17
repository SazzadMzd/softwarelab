<?php
include("sqlcon.php");
if (!isset($_SESSION["type"]) || $_SESSION["type"] != "staff") {
  echo "<script>window.location='index.php'</script>";
}
$res = mysqli_query($con, "Select * from tblstaff where staffid=" . $_SESSION["uid"]);
$row = mysqli_fetch_array($res);
$name = $row['staffname'];
$qualification = $row['qualification'];
$email = $row['emailid'];
$contactno = $row['contactno'];
$designation = $row['designation'];
$dateof_join = $row['dateof_join'];
$dob = $row['dob'];
$address = $row['address'];
$staffphoto = $row['staffphoto'];


// if(isset($_POST['submit']))
// {
// 	//update query for staff profile
//   $filename = rand().$_FILES["profile_imge"]["staffname"];
// 	move_uploaded_file($_FILES["profile_imge"]["tmp_name"],"upload/staff/".$filename);

// 	$rs = mysqli_query($con,"update tblstaff set staffname='".$_POST['Name']."',qualification='".$_POST['qualification']."',designation='".$_POST['designation']."',address='".$_POST['Address']."',contactno='".$_POST['phone']."',dateof_join='".$_POST['dateof_join']."',dob='".$_POST['dob']."' where staffid=".$_SESSION['uid']);
//   if($rs){ 
// 		echo "<script>alert('Profile updated successfully!!!');</script>";  
// 	 }
// 	 else
// 	 {
// 		 echo mysqli_error($con);
// 	 }
// }
if (isset($_POST['submit'])) {
  // Existing staff ID you want to update
  $staffId = $_SESSION['uid'];

  $staffphto = $_FILES['staffphoto'];
  $staffphtoName = $staffphto['name'];
  $staffphtoTmpName = $staffphto['tmp_name'];

  $staffphtoDirectory = "upload/staff/";

  // Check if a new image is provided
  if (!empty($staffphtoName)) {
    // Get the existing staff record to unlink the old image
    $existingStaffRecord = mysqli_query($con, "SELECT staffphoto FROM tblstaff WHERE staffid = $staffId");
    $existingImage = mysqli_fetch_assoc($existingStaffRecord);

    if ($existingImage && file_exists($existingImage['staffphoto'])) {
      // Unlink the old image
      unlink($existingImage['staffphoto']);
    }
    // Generate a unique name for the new image
    $uniquestaffphtoName = uniqid() . '_' . $staffphtoName;
    $staffphtoPath = $staffphtoDirectory . $uniquestaffphtoName;

    // Move the new image
    if (move_uploaded_file($staffphtoTmpName, $staffphtoPath)) {
    } else {
      echo "Failed to upload the new staff photo.";
    }
  }


  // Update the staff record
  $rs = mysqli_query($con, "update tblstaff set staffname='" . $_POST['Name'] . "',qualification='" . $_POST['qualification'] . "',designation='" . $_POST['designation'] . "',address='" . $_POST['Address'] . "',contactno='" . $_POST['phone'] . "',dateof_join='" . $_POST['dateof_join'] . "',dob='" . $_POST['dob'] . "',staffphoto = '" . $staffphtoPath . "' where staffid=" . $_SESSION['uid']);

  if ($rs) {
    echo "<script>alert('Profile updated successfully...!!');window.location='staffprofile.php';</script>";
  } else {
    echo mysqli_error($con);
  }
}

?>

<?php
include("header.php");

?>


<div class="container">
  <div class="page">
    <h3>My Profile</h3>

    <div class="bs-example" data-example-id="simple-horizontal-form">
      <form class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label"></label>
          <div class="col-sm-6">
            <img src="<?php echo $staffphoto; ?>" style="width: 150px;height: 170px;">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Photo</label>

          <div class="col-sm-6">
            <input type="file" class="form-control" id="staffphoto" name="staffphoto" readonly  >
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="Name" name="Name" placeholder="Name" required value="<?php echo $name; ?>" readonly required>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Date of Birth</label>
          <div class="col-sm-6">
            <input type="date" class="form-control" id="dob" name="dob" placeholder="Date of join" value="<?php echo $dob;   ?>" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Designation</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="designation" name="designation" placeholder="Designation" value="<?php echo $designation;   ?>" required readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Date of Join</label>
          <div class="col-sm-6">
            <input type="date" class="form-control" id="dateof_join" name="dateof_join" placeholder="Date of join" value="<?php echo $dateof_join;   ?>" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Email Id</label>
          <div class="col-sm-6">
            <input type="email" class="form-control" id="Email" name="Email" placeholder="Email Id" value="<?php echo $email;   ?>" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Contact No.</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Contact no." required value="<?php echo $contactno;   ?>" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Qualification</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="qualification" name="qualification" placeholder="Qualification" required value="<?php echo   $qualification;   ?>" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Address</label>
          <div class="col-sm-6">
            <textarea class="form-control" id="Address" name="Address" placeholder="Address" rows="3" required readonly><?php echo $address;   ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <input type="button" class="btn btn-default" name="updatep" id="updatep" value="Update Profile" onclick="updateprofile()" style="display:block;">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10" style="display:none;" id="disp">
            <input type="submit" class="btn btn-default" name="submit" id="submit" value="UPDATE" />
            <input type="submit" class="btn btn-default" name="btncancel" name="btncancel" value="CANCEL" onclick="window.location.reload();" />
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
  function updateprofile() {
    $("#Name").removeAttr('readonly');
    $("#dateof_join").removeAttr('readonly');
    $("#phone").removeAttr('readonly');
    $("#qualification").removeAttr('readonly');
    $("#Address").removeAttr('readonly');
    $("#dob").removeAttr('readonly');
    $("#staffphoto").removeAttr('readonly');

    document.getElementById("disp").style.display = "block";
    //document.getElementById("btncancel").style.display="block";

    document.getElementById("updatep").style.display = "none";
  }
</script>