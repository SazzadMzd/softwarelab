<?php
$id = $_GET['id'];
include("sqlcon.php");

$res = mysqli_query($con, "Delete From tbljob Where jobid=$id");

// Redirect the user back to the previous page.
header('location: ' . $_SERVER['HTTP_REFERER']);

?>