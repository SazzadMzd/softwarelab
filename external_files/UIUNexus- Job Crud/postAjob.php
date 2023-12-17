<?php
    $created_by = $_GET["created_by"];
    $date = $_GET["date"];
    $details = $_GET["details"];



	require_once('db_connect.php');

	$connect = mysqli_connect( HOST, USER, PASS, DB )

		or die("Can not connect");



	mysqli_query( $connect, "INSERT INTO job VALUES ( '', '$created_by', '$date', '$details')" )

		or die("Can not execute query");



	echo "Record inserted by :<br> $created_by";



	echo "<p><a href=showall.php>Job Opennings</a>";

?>