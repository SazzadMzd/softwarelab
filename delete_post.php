<?php
include("sqlcon.php");
?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'])) {
  $post_id = $_POST['post_id'];
    $event_id = $_POST['event_id'];


  $postQuery = "SELECT image FROM event_posts WHERE id = $post_id";
  $postResult = mysqli_query($con, $postQuery);

  if ($postResult && mysqli_num_rows($postResult) > 0) {
    $post = mysqli_fetch_assoc($postResult);
    $imageFilename = $post['image'];

    // Delete the image file if it exists
    if (!empty($imageFilename)) {
      $imagePath = "upload/event_posts/" . $imageFilename;
      if (file_exists($imagePath)) {
        unlink($imagePath);
      }
    }
  }

  // Delete the post from the database
  $deleteQuery = "DELETE FROM event_posts WHERE id = $post_id";

  if (mysqli_query($con, $deleteQuery)) {
    echo "<script>alert('Deleted Post Successfully!!!');</script>";

  } else {
    echo "<script>alert('Failed to delete post.');</script>";
  }
}
?>


<script>
    window.location.href = "event_info.php?eventid=<?php echo $event_id; ?>";
</script>
