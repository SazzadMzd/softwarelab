<?php
include("sqlcon.php");
include("header.php")
?>
<?php
$rs = mysqli_query($con, "Select * from tblalumnimeet where eventid=" . $_GET['eventid']);
$row = mysqli_fetch_array($rs);
$eventid = $row['eventid'];
$event_name = $row['event_name'];
$event_cover_photo = $row['cover_photo'];
$loc = $row['loc'];
$event_date = $row['event_date'];
$event_time = $row['event_time'];
$description = $row['description'];
$interested = $row['interested'];
$going = $row['going'];
$not_going = $row['not_going'];
$user_id = $_SESSION["uid"];
$uniqueID = $_SESSION["uniqueID"];
$profile_imge = $_SESSION["profile_imge"];
$user_name = $_SESSION["name"];
$user_type = $_SESSION["type"];

$userInteractionQuery = "SELECT interaction_type, user_type FROM user_event_interaction WHERE event_id = $eventid AND user_id = '$uniqueID'";
$userInteractionResult = mysqli_query($con, $userInteractionQuery);

if (mysqli_num_rows($userInteractionResult) > 0) {
  $userInteraction = mysqli_fetch_assoc($userInteractionResult);
  $previousInteraction = $userInteraction['interaction_type'];
  $userType = $userInteraction['user_type'];
} else {
  $previousInteraction = null;
  $userType = $_SESSION["type"];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_id']) && isset($_POST['action'])) {
  // Check if the user has already interacted with the event
  $previousInteraction = null;
  $event_id = $_POST['event_id'];
  $action = $_POST['action'];

  $userInteractionQuery = "SELECT interaction_type FROM user_event_interaction WHERE event_id = $eventid AND user_id = '$uniqueID'";
  $userInteractionResult = mysqli_query($con, $userInteractionQuery);

  // Check if the user has already interacted with the event
  if (mysqli_num_rows($userInteractionResult) > 0) {
    $userInteraction = mysqli_fetch_assoc($userInteractionResult);
    $previousInteraction = $userInteraction['interaction_type'];
    $previousInteraction = strtolower($previousInteraction); // Convert to lowercase
    $userType = $userInteraction['user_type'];

    // Check if the user clicked the same button again
    if ($previousInteraction === $action) {
      // User clicked the same button again, so update the interaction to null
      mysqli_query($con, "UPDATE user_event_interaction SET interaction_type = NULL WHERE event_id = $event_id AND user_id = '$uniqueID'");
      mysqli_query($con, "UPDATE tblalumnimeet SET $action = $action - 1 WHERE eventid = $event_id");
      $previousInteraction = null;
    }

    // User clicked a different button
    else {
      mysqli_query($con, "UPDATE user_event_interaction SET interaction_type = '$action' WHERE event_id = $event_id AND user_id = '$uniqueID'");
      mysqli_query($con, "UPDATE tblalumnimeet SET $action = $action + 1 WHERE eventid = $event_id");
      $previousInteraction = $action;
    }
  }

  // User has not interacted with the event before
  else {
    mysqli_query($con, "INSERT INTO user_event_interaction (event_id, user_id, interaction_type, user_type) VALUES ($event_id, '$uniqueID', '$action', '$userType')");
    mysqli_query($con, "UPDATE tblalumnimeet SET $action = $action + 1 WHERE eventid = $event_id");
    $previousInteraction = $action;
  }
  $rs = mysqli_query($con, "Select * from tblalumnimeet where eventid=" . $_GET['eventid']);
  $row = mysqli_fetch_array($rs);
  $interested = $row['interested'];
  $going = $row['going'];
  $not_going = $row['not_going'];

  // Redirect back to the same page or provide feedback as needed
  header("Location: event_info.php?eventid=$event_id");
}
?>


<style>
  h1 {
    font-size: 35px;
    color: #333;
  }

  .card-img-top {
    /* max-width: 100%; */
    /* height: auto; */
    width: 100%;
    height: 500px;
    /* border: 5px solid #fff; */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  }

  p {
    font-size: 16px;
    color: #FF9F50;
  }

  .s {
    font-size: 16px;
    color: #FF9F50;
  }

  h2 {
    font-size: 20px;
    color: #333;
  }

  h4 {
    font-size: 16px;
    color: #333;
  }

  h5 {
    color: #c3b9b9;
  }

  .custom-card {
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    background-color: #f9f9f9;
  }

  /* Custom CSS for the card body */
  .custom-card-body {
    padding: 20px;
  }

  .avatar {
    vertical-align: middle;
    width: 100%;
    height: 320px;
  }

  /* .modal-dialog {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 1000px;
    height: 100%;
  } */

  .custom-button-container {
    display: flex;
    justify-content: flex-end;
  }

  .custom-button-container form {
    margin-right: 7px;
    /* Adjust the margin as needed to control spacing */
  }

  .post-image {
    width: 100%;
    height: 300px;
    /* border: 5px solid #fff; */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  }

  .post-header {
    display: flex;
    justify-content: space-between;
  }

  .user-name {
    flex: 1;
    /* User name takes up available space on the left */
    margin-right: 10px;
    /* Add some spacing between user name and date */
    text-align: left;
  }

  .post-date {
    flex: 1;
    /* Creation date takes up available space on the right */
    text-align: right;
  }

  .delete-button-container {
    display: flex;
    justify-content: flex-end;
  }

  /* CSS for User Image */
  .user-image {
    width: 50px;
    /* Set the width of the user image */
    height: 50px;
    /* Set the height of the user image */
    border-radius: 50%;
    /* Make the image circular */
    object-fit: cover;
    /* Ensure the image covers the entire space */
    margin-right: 10px;
    /* Adjust spacing between the image and user name if needed */
    /* Add any other styles you require */
  }
</style>
<div class="container">
  <div class="custom-card" style="margin-top: 10px;">
    <div class="custom-card-body">
      <img src="<?php echo $event_cover_photo; ?>" class="card-img-top" alt="Event Cover Photo">
      <p class="card-text" style="margin-top: 10px;"><strong><?php echo date("F j, Y", strtotime($event_date)) ?> AT <?php echo date("g:i A", strtotime($event_time)) ?></strong> </p>
      <h1 class="card-title"><?php echo $event_name; ?></h1>
      <h5><?php echo $loc ?></h5>

      <?php if (isset($_SESSION['user_logged_in'])) { // Check if the user is logged in 
      ?>
        <hr>

        <div class="text-right custom-button-container">
          <?php if ($previousInteraction == null) { ?>
            <form method="post" action="" class="d-inline">
              <input type="hidden" name="event_id" value="<?php echo $eventid; ?>">
              <input type="hidden" name="action" value="interested">
              <button type="submit" class="btn btn-info">Interested</button>
            </form>

            <form method="post" action="" class="d-inline">
              <input type="hidden" name="event_id" value="<?php echo $eventid; ?>">
              <input type="hidden" name="action" value="going">
              <button type="submit" class="btn btn-success">Going</button>
            </form>

            <form method="post" action="" class="d-inline">
              <input type="hidden" name="event_id" value="<?php echo $eventid; ?>">
              <input type="hidden" name="action" value="not_going">
              <button type="submit" class="btn btn-danger">Not Going</button>
            </form>
          <?php } else { ?>
            <form method="post" action="" class="d-inline">
              <input type="hidden" name="event_id" value="<?php echo $eventid; ?>">
              <input type="hidden" name="action" value="<?php echo $previousInteraction; ?>">
              <?php if ($previousInteraction == 'interested') { ?>
                <button type="submit" class="btn btn-info">Interested</button>
              <?php } elseif ($previousInteraction == 'going') { ?>
                <button type="submit" class="btn btn-success">Going</button>
              <?php } elseif ($previousInteraction == 'not_going') { ?>
                <button type="submit" class="btn btn-danger">Not Going</button>
              <?php } else { ?>
                <button type="submit" class="btn btn-secondary"><?php echo ucfirst($previousInteraction); ?></button>
              <?php } ?>
            </form>
            <?php $previousInteraction = null; ?>
          <?php } ?>
        </div>
      <?php } ?>

    </div>
  </div>
  <div class="row">
    <div class="col-md-8">
      <?php if (isset($_SESSION['user_logged_in'])) { // Check if the user is logged in 
      ?>
        <div class="custom-card" style="margin-top: 10px; margin-bottom: 10px">
          <div class="custom-card-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPostModal" style="width: 100%;">Add Post</button>
          </div>
        </div>
      <?php } ?>
      <div class="custom-card" style="margin-top: 10px; margin-bottom: 10px">
        <div class="custom-card-body">
          <p class="card-title"><strong>Posts:</strong></p>
          <hr>

          <?php
          $postQuery = "SELECT * FROM event_posts WHERE event_id = $eventid ORDER BY creation_date DESC";
          $postResult = mysqli_query($con, $postQuery);

          while ($post = mysqli_fetch_assoc($postResult)) {
          ?>
            <div class="post">
              <div class="post-header">
                <?php if (!empty($post['user_image'])) { ?>
                  <img src="<?php echo $post['user_image']; ?>" alt="User Image" class="user-image">
                <?php
                } else {
                ?>
                  <img src='images/821no-user-image.png' class="user-image" alt='User Image'>
                <?php
                }
                ?>
                <p class="user-name"><?php echo $post['user_name'] ?></p>
                <p class="post-date">
                  <?php echo date("F j, Y", strtotime($post['creation_date'])) ?>
                  <!-- Create a form for post deletion -->
                  <?php if ($uniqueID == $post['uniqueID']) { ?>
                <form method="post" action="delete_post.php">
                  <input type="hidden" name="event_id" value="<?php echo $eventid; ?>">
                  <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                  &nbsp;
                  <button class="btn btn-danger btn-sm" type="submit">
                    <i class="fa fa-trash"></i>
                  </button>
                <?php } ?>
                </form>
                </p>
              </div>
              <!-- <hr> -->
              <h4><?php echo $post['text_content'] ?></h4>
              <?php if (!empty($post['image'])) { ?>
                <img src="upload/event_posts/<?php echo $post['image'] ?>" alt="Posted Image" class="post-image">
              <?php } ?>
              <hr>
            </div>
          <?php
          }
          ?>

          <hr>
        </div>
      </div>


    </div>
    <div class="col-md-4">
      <div class="custom-card" style="margin-top: 10px; margin-bottom: 20px">
        <div class="custom-card-body">
          <p class="card-title"><strong>Event Details:</strong></p>
          <hr>
          <h4><span class="s"><?php echo $interested ?></span> Persons Interested </h4>
          <h4><span class="s"><?php echo $going ?></span> Persons Going </h4>
          <h4><span class="s"><?php echo $not_going ?></span> Persons Not Going </h4>
          <hr>
          <h2 class="card-text"><?php echo $description; ?></h2>
        </div>
      </div>
    </div>
  </div>

</div>


<div class="modal fade" id="addPostModal" tabindex="-1" role="dialog" aria-labelledby="addPostModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addPostModalLabel">Create Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="post_handler.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="post-text">Post Text:</label>
            <textarea class="form-control" id="post-text" name="post_content" rows="3" placeholder="Write Your Post Here"></textarea>
          </div>
          <div class="form-group">
            <label for="post-image">Upload an Image(optional):</label>
            <input type="file" class="form-control-file" id="post-image" name="post_image">
            <input type="hidden" name="event_id" value="<?php echo $eventid; ?>">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>


<?php
include("footer.php");    ?>