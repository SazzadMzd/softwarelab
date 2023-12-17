<?php
include("sqlcon.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eventId'])) {
    $eventId = $_POST['eventId'];

    // Fetch user status details based on user type
    $goingUsersQuery = "SELECT * FROM tblalumnimeet
                    JOIN user_event_interaction ON tblalumnimeet.eventid = user_event_interaction.event_id
                    JOIN tbluser ON user_event_interaction.user_id = tbluser.uniqueID
                    WHERE tblalumnimeet.eventid = '$eventId'";

    $goingUsersResult = mysqli_query($con, $goingUsersQuery);

    $notGoingUsersQuery = "SELECT * FROM tblalumnimeet WHERE eventid = '$eventId' AND not_going = 1";
    $notGoingUsersResult = mysqli_query($con, $notGoingUsersQuery);

    $interestedUsersQuery = "SELECT * FROM tblalumnimeet WHERE eventid = '$eventId' AND interested = 1";
    $interestedUsersResult = mysqli_query($con, $interestedUsersQuery);

    $goingUsers = '';
    while ($goingUser = mysqli_fetch_assoc($goingUsersResult)) {
        $goingUsers .= '<p>' . $goingUser['user_type'] . ': ' . $goingUser['name'] . '</p>';
    }

    $notGoingUsers = '';
    while ($notGoingUser = mysqli_fetch_assoc($notGoingUsersResult)) {
        $notGoingUsers .= '<p>' . $notGoingUser['user_type'] . ': ' . $notGoingUser['user_id'] . '</p>';
    }

    $interestedUsers = '';
    while ($interestedUser = mysqli_fetch_assoc($interestedUsersResult)) {
        $interestedUsers .= '<p>' . $interestedUser['user_type'] . ': ' . $interestedUser['user_id'] . '</p>';
    }

    // Return user status details as JSON
    echo json_encode([
        'goingUsers' => $goingUsers,
        'notGoingUsers' => $notGoingUsers,
        'interestedUsers' => $interestedUsers,
    ]);
}
?>
