<?php
	require_once('db_connect.php');
	$connect = mysqli_connect( HOST, USER, PASS, DB )
		or die("Can not connect");


	$results = mysqli_query( $connect, "SELECT * FROM apply" )
		or die("Can not execute query");

	echo "<h2>All Applications</h2>";

	echo "<table border> \n";
	echo "<th>Applied By</th> <th>Job ID by</th> <th>resume</th> <th>date</th> \n";

	while( $rows = mysqli_fetch_array( $results ) ) {
		extract( $rows );
		echo "<tr>";
		echo "<td> $applied_by </td>";
		echo "<td> $job_id </td>";
        echo "<td> $resume </td>";
        echo "<td> $date </td>";
		echo "<td> <a href = 'cancel.php?job_id=$job_id'> cancel </a> </td>";
		echo "</tr> \n";
	}

	echo "</table> \n";

	
?>
