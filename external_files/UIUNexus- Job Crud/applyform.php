<h1>Apply for Job</h1>

<?php
$id = $_GET["id"];
$created_by = $_GET["created_by"];
$date = $_GET["date"];
$details = $_GET["details"];
echo "Job id: $id <br>";
echo "Posted by: $created_by <br>";
echo "Date: $date <br>";
echo "Details: $details <br>";
?>
<h2>Give your information</h2>

<form method=get action=apply.php>

	<p>

	Candidate Name: <input type=text name=applied_by> <br>

	<p>
    
    date: <input type=date name=date> <br>

	<p>

    Resume: <input type=file name=resume> <br>

	<p>

    <input type="hidden" name="id" value="<?php echo $id; ?>">


	<input type=submit value=Insert>

</form>