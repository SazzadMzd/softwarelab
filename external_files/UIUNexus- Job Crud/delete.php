<?php

	$id = $_GET["id"];



	require_once('db_connect.php');

	$connect = mysqli_connect( HOST, USER, PASS, DB )

		or die("Can not connect");



	mysqli_query( $connect, "DELETE FROM job WHERE id=$id" )

		or die("Can not execute query");



	echo "Job deleted<br>";



	echo "<p><a href=showall.php>Job Opennings</a>";

?>