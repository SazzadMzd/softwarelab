<?php
include("sqlcon.php");
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_content'])) {
    // Retrieve post content and sanitize it (consider using prepared statements)
    $postContent = mysqli_real_escape_string($con, $_POST['post_content']);

    $uniqueID = $_SESSION["uniqueID"];
    $user_image = $_SESSION["profile_imge"];
    $user_name = $_SESSION["name"];
    $event_id = $_POST['event_id']; // Retrieve the event_id from the hidden input
    $user_image = $_SESSION["profile_imge"];

    $imageFilename = null;

    // File upload directory for event posts
    $postUploadDirectory = "upload/event_posts/";
    if ($_FILES['post_image']['error'] === UPLOAD_ERR_OK) {
        $imageFilename = $uniqueID . "_" . $_FILES["post_image"]["name"];

        // Copy the uploaded image to the event post directory
        if (copy($_FILES["post_image"]["tmp_name"], $postUploadDirectory . $imageFilename)) {
            // Image copied successfully for event post
        } else {
            // Failed to copy the image for event post
        }
    }

    // File upload directory for gallery
    $galleryImageFilename = null;
    $galleryUploadDirectory = "gallery/";
    if ($_FILES['post_image']['error'] === UPLOAD_ERR_OK) {
        $galleryImageFilename = $uniqueID . "_" . $_FILES["post_image"]["name"];

        // Copy the uploaded image to the gallery directory
        if (copy($_FILES["post_image"]["tmp_name"], $galleryUploadDirectory . $galleryImageFilename)) {
            // Image copied successfully for gallery
            // Insert the image into tblgallery
            $galleryImageFilename = $galleryUploadDirectory . $galleryImageFilename;
            $insertImageQuery = "INSERT INTO tblgallery (eventid, photo) VALUES ('$event_id', '$galleryImageFilename')";
            if (mysqli_query($con, $insertImageQuery)) {
                // Image inserted into tblgallery successfully
            } else {
                // Failed to insert image into tblgallery
            }
        } else {
            // Failed to copy the image for gallery
        }
    }

    // Insert the post into the event_posts table
    $insertQuery = "INSERT INTO event_posts (event_id, uniqueID, user_name, text_content, image, user_image, creation_date)
    VALUES ('$event_id', '$uniqueID', '$user_name', '$postContent', '$imageFilename', '$user_image', NOW())";

    if (mysqli_query($con, $insertQuery)) {
        // Post inserted successfully
        echo "<script>alert('Added Post Successfully!!!');</script>";
    } else {
        // Failed to insert the post
        echo "<script>alert('Failed to add post.');</script>";
    }
}
?>

<!-- Redirect back to the event page or provide feedback as needed -->
<script>
    window.location.href = "event_info.php?eventid=<?php echo $event_id; ?>";
</script>
