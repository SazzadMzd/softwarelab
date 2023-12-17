<?php
include("sqlcon.php");
?>

<?php
// activate_event.php
if (isset($_GET['id'])) {
    $eventid = $_GET['id'];

    // Update the event status to 'Active'
    $updateStatusQuery = "UPDATE tblalumnimeet SET status='Active' WHERE eventid='$eventid'";
    if (mysqli_query($con, $updateStatusQuery)) {
        echo "<script>alert('Event activated successfully.');</script>";
    } else {
        echo "<script>alert('Failed to activate event.');</script>";
    }

    // Redirect back to the manage events page
    header("Location: verify_event.php");
    exit();
}
?>
