<?php
include("sqlcon.php");

if (isset($_POST['submit'])) {
  // Handle file upload for the cover photo
  $coverPhoto = $_FILES['cover_photo'];
  $coverPhotoName = $coverPhoto['name'];
  $coverPhotoTmpName = $coverPhoto['tmp_name'];

  // Define the target directory for cover photos
  $coverPhotoDirectory = "upload/event_cp/";

  if (!empty($coverPhotoName)) {
    // Generate a unique filename for the cover photo
    $uniqueCoverPhotoName = uniqid() . '_' . $coverPhotoName;

    // Set the path for the cover photo
    $coverPhotoPath = $coverPhotoDirectory . $uniqueCoverPhotoName;

    // Move the uploaded cover photo to the target directory
    if (move_uploaded_file($coverPhotoTmpName, $coverPhotoPath)) {
      // File uploaded successfully
    } else {
      echo "Failed to upload cover photo.";
    }
  }

  // Insert event details into the database, including the cover photo path
  $qry = "INSERT INTO tblalumnimeet (event_name, loc, event_date, event_time, description, status, cover_photo, interested, going, not_going) VALUES ('" . $_POST['eventname'] . "','" . $_POST['location'] . "','" . $_POST['eventdate'] . "','" . $_POST['eventtime'] . "','" . $_POST['description'] . "','" . $_POST['status'] . "','" . $coverPhotoPath . "',0,0,0)";

  if (mysqli_query($con, $qry)) {
    echo "<script>alert('Success!!!');</script>";
  }
}

if (isset($_POST['update'])) {
  // Handle file upload for the updated cover photo
  $coverPhoto = $_FILES['cover_photo'];
  $coverPhotoName = $coverPhoto['name'];
  $coverPhotoTmpName = $coverPhoto['tmp_name'];

  // Define the target directory for cover photos
  $coverPhotoDirectory = "upload/event_cp/";

  if (!empty($coverPhotoName)) {
    // Generate a unique filename for the updated cover photo
    $uniqueCoverPhotoName = uniqid() . '_' . $coverPhotoName;

    // Set the path for the updated cover photo
    $coverPhotoPath = $coverPhotoDirectory . $uniqueCoverPhotoName;

    // Move the uploaded cover photo to the target directory
    if (move_uploaded_file($coverPhotoTmpName, $coverPhotoPath)) {
      // File uploaded successfully

      // Retrieve the existing cover photo path from the database
      $rs = mysqli_query($con, "SELECT cover_photo FROM tblalumnimeet WHERE eventid='" . $_POST['arid'] . "'");
      $row = mysqli_fetch_array($rs);
      $existingCoverPhotoPath = $row['cover_photo'];

      // Delete the previous cover photo
      if (!empty($existingCoverPhotoPath) && file_exists($existingCoverPhotoPath)) {
        unlink($existingCoverPhotoPath);
      }

      // Update event details in the database, including the updated cover photo path
      $rs = mysqli_query($con, "UPDATE tblalumnimeet SET event_name='" . $_POST['eventname'] . "', loc='" . $_POST['location'] . "', event_date='" . $_POST['eventdate'] . "', event_time='" . $_POST['eventtime'] . "', description='" . $_POST['description'] . "', status='" . $_POST['status'] . "', cover_photo='" . $coverPhotoPath . "' WHERE eventid='" . $_POST['arid'] . "'");


      if ($rs) {
        echo "<script>alert('Record updated successfully...!!');</script>";
      }
    } else {
      echo "Failed to upload cover photo.";
    }
  } else {
    // No new cover photo provided; only update other event details
    $rs = mysqli_query($con, "UPDATE tblalumnimeet SET event_name='" . $_POST['eventname'] . "', loc='" . $_POST['location'] . "', event_date='" . $_POST['eventdate'] . "', event_time='" . $_POST['eventtime'] . "', description='" . $_POST['description'] . "', status='" . $_POST['status'] . "' WHERE eventid='" . $_POST['arid'] . "'");

    if ($rs) {
      echo "<script>alert('Record updated successfully...!!');</script>";
    }
  }
}

if (isset($_GET['id'])) {
  $rs = mysqli_query($con, "SELECT * FROM tblalumnimeet WHERE eventid=" . $_GET['id']);
  $row = mysqli_fetch_array($rs);
  $eventid = $row['eventid'];
  $event_name = $row['event_name'];
  $loc = $row['loc'];
  $event_date = $row['event_date'];
  $event_time = $row['event_time'];
  $description = $row['description'];
  $status = $row['status'];
  $cover_photo = $row['cover_photo'];
}
?>
<?php
include("header.php")
?>


<div class="container">
  <div class="page">
    <h3>Add Event</h3>
    <div class="bs-example" data-example-id="simple-horizontal-form">
      <form class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <input type="hidden" value="<?php echo $eventid;   ?>" name="arid" />
          <label for="inputEmail3" class="col-sm-2 control-label">Event Title</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="eventname" name="eventname" placeholder="Title" required value="<?php echo $event_name;   ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Location</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="location" name="location" placeholder="Location" required value="<?php echo $loc;   ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Event Date</label>
          <div class="col-sm-6">
            <input type="date" class="form-control" id="eventdate" name="eventdate" required value="<?php echo $event_date;   ?>" onchange="validateDate(this.value)">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Event Time</label>
          <div class="col-sm-6">
            <input type="time" class="form-control" id="eventtime" name="eventtime" required value="<?php echo $event_time;   ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Cover Photo</label>
          <div class="col-sm-6">
            <input type="file" class="form-control" id="cover_photo" value="<?php echo $cover_photo;   ?>" name="cover_photo" <?php if (!$cover_photo) { ?> required <?php } ?>>
          </div>
        </div>

        <?php if ($cover_photo) : ?>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Current Cover Photo</label>
            <div class="col-sm-6">
              <img src="<?php echo $cover_photo; ?>" alt="Current Cover Photo" class="img-responsive">
            </div>
          </div>
        <?php endif; ?>


        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
          <div class="col-sm-6">
            <textarea class="form-control" id="description" name="description" placeholder="Description" required><?php echo $description; ?></textarea>
          </div>
        </div>

        <?php if ($_SESSION['type'] != "alumni") : ?>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
            <div class="col-sm-6">
              <select name="status" id="status" class="form-control">
                <option value="Active" <?php if ($status == 'Active') echo "selected"; ?>>Active</option>
                <option value="Inactive" <?php if ($status == 'Inactive') echo "selected"; ?>>Inactive</option>
              </select>
            </div>
          </div>
        <?php else : ?>
          <!-- If alumni, set default status to Inactive -->
          <input type="hidden" name="status" value="Inactive">
        <?php endif; ?>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <?php
            if (isset($_GET['id'])) {
            ?>
              <input type="submit" class="btn btn-default" name="update" value="UPDATE">
            <?php
            } else {
            ?>
              <input type="submit" class="btn btn-default" name="submit" value="SUBMIT">
            <?php
            }
            ?>
            <input type="reset" class="btn btn-default" name="cancel" value="CANCEL">
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
  function validateDate(date) {
    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
    } else {
      // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

        if (xmlhttp.responseText.trim() == "error") {
          document.getElementById("eventdate").value = "";
          document.getElementById("eventdate").focus();
          alert("Invalid Event Date");
        }

      }
    }
    var getlink = "ajaxsetup.php?date=" + date;
    xmlhttp.open("GET", getlink, true);
    xmlhttp.send();
  }
</script>