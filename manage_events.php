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
    <h3 align='center'>Manage Events</h3>
    <p>&nbsp;</p>
    <div class="bs-example" data-example-id="contextual-table" style="border: 1px solid #eee">
      <table class="table" id="dataTables-example">
        <thead>
          <tr>
            <th class="text-center">#</th>
            <th class="text-center">Event Title</th>
            <th class="text-center">Location</th>
            <th class="text-center">Event Date</th>
            <th class="text-center">Time</th>
            <?php
            if ($_SESSION['type'] == "admin") {
              ?>
            <th class="text-center">User Event Interaction</th>
            <?php
            }
            ?>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $res = mysqli_query($con, "SELECT * FROM tblalumnimeet WHERE status='Active'");
          $c = 1;
          while ($row = mysqli_fetch_array($res)) {
            echo "<tr>
                    <td class='text-center'>$c</td>
                    <td class='text-center'>{$row['event_name']}</td>
                    <td class='text-center'>{$row['loc']}</td>
                    <td class='text-center'>{$row['event_date']}</td>
                    <td class='text-center'>{$row['event_time']}</td>";
                    if ($_SESSION['type'] == "admin") {    
                    echo "   
                    <td>
                    <div class='text-center'>
                        <button type='button' class='btn btn-primary text-center' data-toggle='modal' data-target='#userStatusModal{$row[0]}' onclick='getUserStatus({$row[0]})'>
                            View
                        </button>
                        </div>
                        <div class='modal fade' id='userStatusModal{$row[0]}' tabindex='-1' role='dialog' aria-labelledby='userStatusModalLabel' aria-hidden='true'>
                        <div class='modal-dialog modal-lg modal-dialog-centered' role='document'>
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <h1 class='modal-title text-warning' id='userStatusModalLabel'>{$row['event_name']} Event Interaction Name List</h1>
                              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                              </button>
                            </div>
                            <div class='modal-body'>
                              <table class='table table-striped'>
                              <tr>
                                <th>User Type</th>
                                <th class='text-success'>Going</th>
                                <th class='text-danger'>Not Going</th>
                                <th class='text-info'>Interested</th>
                              </tr>
                              <tr>
                                <td>Student</td>
                                <td>";
            $goingUsersQuery = "SELECT * FROM user_event_interaction
                                JOIN student ON user_event_interaction.user_id = student.uniqueID
                                WHERE user_event_interaction.event_id = '{$row[0]}'
                                AND user_event_interaction.interaction_type = 'going'";

            $goingUsersResult = mysqli_query($con, $goingUsersQuery);
            $goingUsersCount = mysqli_num_rows($goingUsersResult);

            if ($goingUsersCount > 0) {
              echo "<ul>";
              while ($goingUser = mysqli_fetch_array($goingUsersResult)) {
                echo "<li>{$goingUser['name']}</li>";
              }
              echo "</ul>";
            } else {
              echo "X";
            }
            echo "</td>
                                <td>";
            $notGoingUsersQuery = "SELECT * FROM user_event_interaction
                                JOIN student ON user_event_interaction.user_id = student.uniqueID
                                WHERE user_event_interaction.event_id = '{$row[0]}'
                                AND user_event_interaction.interaction_type = 'not_going'";

            $notGoingUsersResult = mysqli_query($con, $notGoingUsersQuery);
            $notGoingUsersCount = mysqli_num_rows($notGoingUsersResult);

            if ($notGoingUsersCount > 0) {
              echo "<ul>";
              while ($notGoingUser = mysqli_fetch_array($notGoingUsersResult)) {
                echo "<li>{$notGoingUser['name']}</li>";
              }
              echo "</ul>";
            } else {
              echo "X";
            }
            echo "</td>
                                <td>";
            $interestedUsersQuery = "SELECT * FROM user_event_interaction
                                JOIN student ON user_event_interaction.user_id = student.uniqueID
                                WHERE user_event_interaction.event_id = '{$row[0]}'
                                AND user_event_interaction.interaction_type = 'interested'";
            $interestedUsersResult = mysqli_query($con, $interestedUsersQuery);
            $interestedUsersCount = mysqli_num_rows($interestedUsersResult);

            if ($interestedUsersCount > 0) {
              echo "<sl>";
              while ($interestedUser = mysqli_fetch_array($interestedUsersResult)) {
                echo "<li>{$interestedUser['name']}</li>";
              }
              echo "</sl>";
            } else {
              echo "X";
            }
            echo "</td>
                                
                              </tr>

                              <tr>
                                <td>Alumni</td>
                                <td>";
            $goingUsersQuery = "SELECT * FROM user_event_interaction
                                JOIN tbluser ON user_event_interaction.user_id = tbluser.uniqueID
                                WHERE user_event_interaction.event_id = '{$row[0]}'
                                AND user_event_interaction.interaction_type = 'going'";

            $goingUsersResult = mysqli_query($con, $goingUsersQuery);
            $goingUsersCount = mysqli_num_rows($goingUsersResult);

            if ($goingUsersCount > 0) {
              echo "<ul>";
              while ($goingUser = mysqli_fetch_array($goingUsersResult)) {
                echo "<li>{$goingUser['name']}</li>";
              }
              echo "</ul>";
            } else {
              echo "X";
            }
            echo "</td>
                                <td>";
            $notGoingUsersQuery = "SELECT * FROM user_event_interaction
                                JOIN tbluser ON user_event_interaction.user_id = tbluser.uniqueID
                                WHERE user_event_interaction.event_id = '{$row[0]}'
                                AND user_event_interaction.interaction_type = 'not_going'";

            $notGoingUsersResult = mysqli_query($con, $notGoingUsersQuery);
            $notGoingUsersCount = mysqli_num_rows($notGoingUsersResult);

            if ($notGoingUsersCount > 0) {
              echo "<ul>";
              while ($notGoingUser = mysqli_fetch_array($notGoingUsersResult)) {
                echo "<li>{$notGoingUser['name']}</li>";
              }
              echo "</ul>";
            } else {
              echo "X";
            }
            echo "</td>
                                <td>";
            $interestedUsersQuery = "SELECT * FROM user_event_interaction
                                JOIN tbluser ON user_event_interaction.user_id = tbluser.uniqueID
                                WHERE user_event_interaction.event_id = '{$row[0]}'
                                AND user_event_interaction.interaction_type = 'interested'";
            $interestedUsersResult = mysqli_query($con, $interestedUsersQuery);
            $interestedUsersCount = mysqli_num_rows($interestedUsersResult);

            if ($interestedUsersCount > 0) {
              echo "<sl>";
              while ($interestedUser = mysqli_fetch_array($interestedUsersResult)) {
                echo "<li>{$interestedUser['name']}</li>";
              }
              echo "</sl>";
            } else {
              echo "X";
            }
            echo "</td>
                                
                              </tr>

                              <tr>
                                <td>Staff</td>
                                <td>";
            $goingUsersQuery = "SELECT * FROM user_event_interaction
                                JOIN tblstaff ON user_event_interaction.user_id = tblstaff.uniqueID
                                WHERE user_event_interaction.event_id = '{$row[0]}'
                                AND user_event_interaction.interaction_type = 'going'";

            $goingUsersResult = mysqli_query($con, $goingUsersQuery);
            $goingUsersCount = mysqli_num_rows($goingUsersResult);

            if ($goingUsersCount > 0) {
              echo "<ul>";
              while ($goingUser = mysqli_fetch_array($goingUsersResult)) {
                echo "<li>{$goingUser['staffname']}</li>";
              }
              echo "</ul>";
            } else {
              echo "X";
            }
            echo "</td>
                                <td>";
            $notGoingUsersQuery = "SELECT * FROM user_event_interaction
                                JOIN tblstaff ON user_event_interaction.user_id = tblstaff.uniqueID
                                WHERE user_event_interaction.event_id = '{$row[0]}'
                                AND user_event_interaction.interaction_type = 'not_going'";

            $notGoingUsersResult = mysqli_query($con, $notGoingUsersQuery);
            $notGoingUsersCount = mysqli_num_rows($notGoingUsersResult);

            if ($notGoingUsersCount > 0) {
              echo "<ul>";
              while ($notGoingUser = mysqli_fetch_array($notGoingUsersResult)) {
                echo "<li>{$notGoingUser['staffname']}</li>";
              }
              echo "</ul>";
            } else {
              echo "X";
            }
            echo "</td>
                                <td>";
            $interestedUsersQuery = "SELECT * FROM user_event_interaction
                                JOIN tblstaff ON user_event_interaction.user_id = tblstaff.uniqueID
                                WHERE user_event_interaction.event_id = '{$row[0]}'
                                AND user_event_interaction.interaction_type = 'interested'";
            $interestedUsersResult = mysqli_query($con, $interestedUsersQuery);
            $interestedUsersCount = mysqli_num_rows($interestedUsersResult);

            if ($interestedUsersCount > 0) {
              echo "<sl>";
              while ($interestedUser = mysqli_fetch_array($interestedUsersResult)) {
                echo "<li>{$interestedUser['staffname']}</li>";
              }
              echo "</sl>";
            } else {
              echo "X";
            }
            echo "</td>
                                
                              </tr>

                              <tr>
                                <td>Admin</td>
                                <td>";
            $goingUsersQuery = "SELECT * FROM user_event_interaction
                                JOIN tbladmin ON user_event_interaction.user_id = tbladmin.uniqueID
                                WHERE user_event_interaction.event_id = '{$row[0]}'
                                AND user_event_interaction.interaction_type = 'going'";

            $goingUsersResult = mysqli_query($con, $goingUsersQuery);
            $goingUsersCount = mysqli_num_rows($goingUsersResult);

            if ($goingUsersCount > 0) {
              echo "<ul>";
              while ($goingUser = mysqli_fetch_array($goingUsersResult)) {
                echo "<li>{$goingUser['fullname']}</li>";
              }
              echo "</ul>";
            } else {
              echo "X";
            }
            echo "</td>
                                <td>";
            $notGoingUsersQuery = "SELECT * FROM user_event_interaction
                                JOIN tbladmin ON user_event_interaction.user_id = tbladmin.uniqueID
                                WHERE user_event_interaction.event_id = '{$row[0]}'
                                AND user_event_interaction.interaction_type = 'not_going'";

            $notGoingUsersResult = mysqli_query($con, $notGoingUsersQuery);
            $notGoingUsersCount = mysqli_num_rows($notGoingUsersResult);

            if ($notGoingUsersCount > 0) {
              echo "<ul>";
              while ($notGoingUser = mysqli_fetch_array($notGoingUsersResult)) {
                echo "<li>{$notGoingUser['fullname']}</li>";
              }
              echo "</ul>";
            } else {
              echo "X";
            }
            echo "</td>
                                <td>";
            $interestedUsersQuery = "SELECT * FROM user_event_interaction
                                JOIN tbladmin ON user_event_interaction.user_id = tbladmin.uniqueID
                                WHERE user_event_interaction.event_id = '{$row[0]}'
                                AND user_event_interaction.interaction_type = 'interested'";
            $interestedUsersResult = mysqli_query($con, $interestedUsersQuery);
            $interestedUsersCount = mysqli_num_rows($interestedUsersResult);

            if ($interestedUsersCount > 0) {
              echo "<sl>";
              while ($interestedUser = mysqli_fetch_array($interestedUsersResult)) {
                echo "<li>{$interestedUser['fullname']}</li>";
              }
              echo "</sl>";
            } else {
              echo "X";
            }
            echo "</td>
                              </tr>
          
                              </table>
                            </div>
                            <div class='modal-footer'>
                              <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                        </div>
                    </td>
                    ";
                    }
                    echo "
                    <td class='text-center'>
                    <a class='btn btn-info btn-sm' href='event_info.php?eventid={$row[0]}'>
                    View
                </a>
                        <a class='btn btn-success btn-sm' href='alumnimeet.php?id={$row[0]}'>Edit</a>";
            if ($_SESSION['type'] == "admin") {
              echo "&nbsp;<a class='btn btn-danger btn-sm' href='manage_events.php?id={$row[0]}'>Delete</a>";
            }
            echo "</td>
                </tr>";
            $c++;
          }
          ?>
        </tbody>
      </table>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>



      <div class="modal fade" id="userStatusModal" tabindex="-1" role="dialog" aria-labelledby="userStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="userStatusModalLabel">User Event Interaction Name List</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table class="table table-striped">
                <tr>
                  <th>User Type</th>
                  <th>Going</th>
                  <th>Not Going</th>
                  <th>Interested</th>
                </tr>
                <tr>
                  <td>Student</td>
                  <td>Dummy</td>
                  <td>Dummy</td>
                  <td>Dummy</td>
                </tr>
                <tr>
                  <td>Alumni</td>
                  <td>Dummy</td>
                  <td>Dummy</td>
                  <td>Dummy</td>
                </tr>
                <tr>
                  <td>Staff</td>
                  <td>Dummy</td>
                  <td>Dummy</td>
                  <td>Dummy</td>
                </tr>
                <tr>
                  <td>Admin</td>
                  <td>Dummy</td>
                  <td>Dummy</td>
                  <td>Dummy</td>
                </tr>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

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