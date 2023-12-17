<?php
include("sqlcon.php");
if (!isset($_SESSION["type"]) || $_SESSION["type"] != "alumni") {
  echo "<script>window.location='index.php'</script>";
}


$res = mysqli_query($con, "Select * from tbluser 
      inner join tblcourse on tbluser.courseid=tblcourse.courseid
      inner join tblalumniphoto on  tbluser.userid = tblalumniphoto.userid 

      WHERE tbluser.userid=" . $_SESSION["uid"]);

$row = mysqli_fetch_array($res);
$name = $row['name'];
$gender = $row['gender'];
$dob = $row['dob'];
$course = $row['coursename'];
$email = $row['emailid'];
$contactno = $row['phone'];
$pyear = $row['pyear'];
$occupation = $row['occupation'];
$address = $row['address'];
$location = $row['location'];
$photo = $row['profilepic'];


if (isset($_POST['submit'])) {
  //update query for alumni profile

  $rs = mysqli_query($con, "update tbluser set gender='" . $_POST['Gender'] . "',name='" . $_POST['Name'] . "',phone='" . $_POST['phone'] . "',occupation='" . $_POST['Occupation'] . "',address='" . $_POST['Address'] . "',location='" . $_POST['location'] . "',dob='" . $_POST['Date_Of_Birth'] . "' where userid=" . $_SESSION['uid']);

  if ($_FILES["aphoto"]["name"] != "") {
    $userid = $_SESSION['uid'];

    $alumniphoto = $_FILES['aphoto'];
    $alumniphotoName = $alumniphoto['name'];
    $alumniphotoTmpName = $alumniphoto['tmp_name'];

    $alumniphotoDirectory = "upload/alumni/";

    // Check if a new image is provided
    if (!empty($alumniphotoName)) {
      // Get the existing staff record to unlink the old image
      $existingAlumniRecord = mysqli_query($con, "SELECT profilepic FROM tblalumniphoto WHERE userid = $userid");
      $existingImage = mysqli_fetch_assoc($existingAlumniRecord);

      if ($existingImage && file_exists($existingImage['profilepic'])) {
        // Unlink the old image        
        unlink($existingImage['profilepic']);
      }
      // Generate a unique name for the new image
      $uniquealumniphotoName = uniqid() . '_' . $alumniphotoName;
      $alumniphotoPath = $alumniphotoDirectory . $uniquealumniphotoName;

      // Move the new image
      if (move_uploaded_file($alumniphotoTmpName, $alumniphotoPath)) {
      } else {
        echo "Failed to upload the new staff photo.";
      }
    }

    $rs1 = mysqli_query($con, "update tblalumniphoto set profilepic='" . $alumniphotoPath . "' where userid = " . $_SESSION['uid']);
  }


  echo "<script>alert('Record updated successfully...!!');window.location='alumniprofile.php';</script>";
}
include("header.php");
?>
<div class="container">
  <div class="page">
    <h3 align="center">My Profile</h3>

    <div class="bs-example" data-example-id="simple-horizontal-form">
      <form class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">&nbsp;</label>
          <label for="inputEmail3" class="col-sm-2 control-label">&nbsp;</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo $photo;   ?>" height="120px" width="120px" readonly />
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">&nbsp;</label>
          <label for="inputEmail3" class="col-sm-2 control-label">Photo</label>
          <div class="col-sm-6">
            <input type="file" class="form-control" id="aphoto" name="aphoto" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">&nbsp;</label>
          <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="Name" name="Name" placeholder="Name" required value="<?php echo $name;   ?>" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">&nbsp;</label>
          <label for="inputEmail3" class="col-sm-2 control-label">Gender</label value="<?php echo $gender;   ?>">
          <div class="col-sm-6">
            <input type="Radio" name="Gender" value="Male" checked /> Male
            <input type="Radio" name="Gender" value="Female" /> Female<br />
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">&nbsp;</label>
          <label for="inputEmail3" class="col-sm-2 control-label">Date of Birth</label>
          <div class="col-sm-6">
            <input type="date" class="form-control" id="Date_Of_Birth" name="Date_Of_Birth" placeholder="Date of Birth" value="<?php echo $dob;   ?>" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">&nbsp;</label>
          <label for="inputEmail3" class="col-sm-2 control-label">Email Id</label>
          <div class="col-sm-6">
            <input type="email" class="form-control" id="Email" name="Email" placeholder="Email Id" value="<?php echo $email;   ?>" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">&nbsp;</label>
          <label for="inputEmail3" class="col-sm-2 control-label">Contact No.</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Contact no." value="<?php echo $contactno;   ?>" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">&nbsp;</label>
          <label for="inputEmail3" class="col-sm-2 control-label">Passout Year</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="Passing_Out_year" name="Passing_Out_year" placeholder="Passout Year" readonly value="<?php echo $pyear;   ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">&nbsp;</label>
          <label for="inputEmail3" class="col-sm-2 control-label">Course</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="course" name="course" placeholder="Course" value="<?php echo $course;   ?>" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">&nbsp;</label>
          <label for="inputEmail3" class="col-sm-2 control-label">Occupation</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="Occupation" name="Occupation" placeholder="Occupation" required value="<?php echo $occupation;   ?>" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">&nbsp;</label>
          <label for="inputEmail3" class="col-sm-2 control-label">Address</label>
          <div class="col-sm-6">
            <textarea class="form-control" id="Address" name="Address" placeholder="Address" rows="3" readonly><?php echo $address;   ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">&nbsp;</label>
          <label for="inputEmail3" class="col-sm-2 control-label">City</label>
          <div class="col-sm-6">
            <select name="location" id="location" class="form-control" readonly>
              <?php
              $qry = "Select * from tblregion";
              $res3 = mysqli_query($con, $qry);
              echo "<option value='0'>-- Select Region --</option>";
              while ($row2 = mysqli_fetch_array($res3)) {
                $selected = ($row2[0] == $location) ? "selected" : "";
                echo "<option value='$row2[0]' $selected>$row2[1]</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group" align="center">
          <div class="col-sm-offset-2 col-sm-10">
            <input type="button" class="btn btn-default" name="updatep" id="updatep" value="Update Profile" onclick="updateprofile()">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">&nbsp;</label>
          <div class="col-sm-offset-2 col-sm-10" style="display:none;" id="disp">
            <input type="submit" class="btn btn-default" name="submit" id="submit" value="UPDATE" />
            <input type="reset" class="btn btn-default" name="btncancel" name="cancel" value="CANCEL" onclick="window.location.reload();" />
          </div>
        </div>
    </div>

  </div>
</div>

<?php
include("footer.php");
?>
<script>
  function updateprofile() {
    $("#Name").removeAttr('readonly');
    $("#Date_Of_Birth").removeAttr('readonly');
    $("#phone").removeAttr('readonly');
    $("#Occupation").removeAttr('readonly');
    $("#Address").removeAttr('readonly');
    $("#location").removeAttr('readonly');
    $("#aphoto").removeAttr('readonly');
    $("#Name").removeAttr('readonly');


    document.getElementById("disp").style.display = "block";

    document.getElementById("updatep").style.display = "none";
  }
</script>