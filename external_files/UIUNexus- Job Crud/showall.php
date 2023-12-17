<?php
	require_once('db_connect.php');
	$connect = mysqli_connect( HOST, USER, PASS, DB )
		or die("Can not connect");


	$results = mysqli_query( $connect, "SELECT * FROM job" )
		or die("Can not execute query");

	echo "<h2>Job Opennings</h2>";
	echo "<p><a href=post.php>Post A Job</a>";

	echo "<table border> \n";
	echo "<th>id</th> <th>created by</th> <th>date</th> <th>details</th> \n";

	while( $rows = mysqli_fetch_array( $results ) ) {
		extract( $rows );
		echo "<tr>";
		echo "<td> $id </td>";
		echo "<td> $created_by </td>";
        echo "<td> $date </td>";
        echo "<td> $details </td>";
		echo "<td> <a href = 'applyform.php?id=$id&created_by=$created_by&date=$date&details=$details'> apply </a> </td>";
		echo "<td> <a href = 'delete.php?id=$id&created_by=$created_by&date=$date&details=$details'> Delete </a> </td>";
		echo "</tr> \n";
	}

	echo "</table> \n";

	
?>
