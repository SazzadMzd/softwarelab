<?php
include("sqlcon.php");

if (isset($_GET['id'])) {
    $eventid = $_GET['id'];

    // Retrieve the cover photo path and associated posts before deleting the event
    $rs = mysqli_query($con, "SELECT cover_photo FROM tblalumnimeet WHERE eventid='$eventid'");
    $row1 = mysqli_fetch_array($rs);
    $coverPhotoPath = $row1['cover_photo'];

    // Check if there are any posts associated with the event
    $postCheckQuery = "SELECT id, image FROM event_posts WHERE event_id='$eventid'";
    $postCheckResult = mysqli_query($con, $postCheckQuery);

    while ($postRow = mysqli_fetch_assoc($postCheckResult)) {
        $postId = $postRow['id'];
        $imageFilename = $postRow['image'];
        $imagePath = "upload/event_posts/" . $imageFilename;

        // Delete the post from the 'event_posts' table
        $deletePostQuery = "DELETE FROM event_posts WHERE id='$postId'";
        if (!mysqli_query($con, $deletePostQuery)) {
            echo "<script>alert('Failed to delete post.');</script>";
            // Optionally handle the error, depending on your requirements
        }

        // Delete the post image from the server
        if (!empty($imagePath) && file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // Delete the event from the 'tblalumnimeet' table
    $deleteEventQuery = "DELETE FROM tblalumnimeet WHERE eventid='$eventid'";
    if (mysqli_query($con, $deleteEventQuery)) {
        // Event deleted successfully

        // Delete the cover photo from the server
        if (!empty($coverPhotoPath) && file_exists($coverPhotoPath)) {
            unlink($coverPhotoPath);
        }

        echo "<script>alert('Event and associated posts deleted successfully.');</script>";
    } else {
        echo "<script>alert('Failed to delete event.');</script>";
    }
}





include("header.php")
?>

<div class="container">
    <div class="page">
        <h3 align='center'>Verify Event</h3>
        <p>&nbsp;</p>
        <div class="bs-example" data-example-id="contextual-table" style="border: 1px solid #eee">
            <table class="table" id="dataTables-example">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cover Photo</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Event Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $res = mysqli_query($con, "Select * from tblalumnimeet where status='Inactive'");
                    $c = 1;
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_array($res)) {
                            echo "<tr>
                                <td>" . $c++ . "</td>
                                <td><img src=" . $row['cover_photo'] . " alt='Event Cover Photo' style='height:40px; width:60px'></td>
                                <td>" . $row['event_name'] . "</td>
                                <td>" . $row['description'] . "</td>
                                <td>" . $row['loc'] . "</td>
                                <td>" . $row['event_date'] . "</td>
                                <td>" . $row['event_time'] . "</td>
                                <td><a href='activate_event.php?id=$row[0]'>Active</a></td>
                                <td>
                                    <a href='manage_events.php?id=$row[0]'>Delete</a>
                                </td>
                            </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<link rel="stylesheet" type="text/css" href="DataTables-1.10.12/extensions/Buttons/css/buttons.dataTables.css">
<link rel="stylesheet" type="text/css" href="DataTables-1.10.12/media/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="DataTables-1.10.12/media/js/jquery.dataTables.js">
</script>
<script type="text/javascript" language="javascript" src="DataTables-1.10.12/extensions/Buttons/js/dataTables.buttons.js">
</script>
<script type="text/javascript" language="javascript" src="Stuk-jszip-6d2b991/dist/jszip.min.js">
</script>
<script type="text/javascript" language="javascript" src="pdfmake-master/build/pdfmake.min.js">
</script>
<script type="text/javascript" language="javascript" src="pdfmake-master/build/vfs_fonts.js">
</script>
<script type="text/javascript" language="javascript" src="DataTables-1.10.12/extensions/Buttons/js/buttons.html5.js">
</script>
<script type="text/javascript" language="javascript" src="DataTables-1.10.12/examples/resources/syntax/shCore.js">
</script>
<script type="text/javascript" language="javascript" src="DataTables-1.10.12/examples/resources/demo.js">
</script>
<script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable({
            dom: 'Bfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']
            ],
            buttons: [
                'pageLength',
                'pdfHtml5'
            ]
        });
    });
</script>
<?php
include("footer.php");
?>