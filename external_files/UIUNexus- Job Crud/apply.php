<?php

    $applied_by = $_GET["applied_by"];
    $date = $_GET["date"];
    $id = $_GET["id"];
    $resume = $_GET["resume"];



	require_once('db_connect.php');

	$connect = mysqli_connect( HOST, USER, PASS, DB )

		or die("Can not connect");



	mysqli_query( $connect, "INSERT INTO apply VALUES ( '$applied_by', '$id', '$resume', '$date')" )

		or die("Can not execute query");



	echo "Record inserted by :<br> $applied_by";



	echo "<p><a href=showallapp.php>All Application</a>";

?>