<?php
include("sqlcon.php");
if(!isset($_SESSION['type']))
{
	//echo "<script>window.location='index.php';</script>";
}
if(isset($_GET['id'])) {
    // Get the ID from the URL parameter
    $studentId = $_GET['id'];

    // Create the unique ID by combining "student" with the retrieved ID
    $uniqueID = "student" . $studentId;

    // Update the record with the unique ID
    $qry = "UPDATE student SET status='Active', uniqueID='$uniqueID' WHERE studentid=" . $studentId;
    $rs = mysqli_query($con, $qry);

    if ($rs) {
        echo "<script>alert('Record updated successfully...!!');window.location='verify_student.php';</script>";
    }
}

if(isset($_GET['did']))
{
	$rs = mysqli_query($con,"update student set status='Disapproved' where studentid=".$_GET['did']);
	if($rs)
	{
		echo "<script>alert('Record updated successfully...!!');window.location='verify_student.php';</script>";
	}
}
include("header.php")
?>
<div class="container">
	<div class="page">
   <h3 align='center'>Verify Student</h3>
   <p>&nbsp;</p>
  <div class="bs-example" data-example-id="contextual-table" style="border: 1px solid #eee">
    <table class="table table-bordered" id="dataTables-example">
  <tr>
    <th>#</th>
	  <th>Photo</th>
		<th>Full Name</th>
	  <th>Course</th>
	  <th>Semester</th>
    <th>Gender</th>
    <th>Date of Birth</th>
    <th>Email ID</th>
     <th>Address</th>
    <th>Contact No</th>    
      <th>Verify</th>
   </tr>
<?php
	$sqlprofile = "Select * from student where status='Inactive'";
  $res = mysqli_query($con, $sqlprofile);
  $c = 1;
  if(mysqli_num_rows($res) > 0)
  {
	  while($row = mysqli_fetch_array($res))
	  {
		  $sqlcourse = "SELECT * FROM tblcourse WHERE courseid='$row[courseid]'";
		  $qsqlcourse = mysqli_query($con,$sqlcourse);
		  $rscourse = mysqli_fetch_array($qsqlcourse);		  
		echo "<tr>
		<td>".$c++."</td>
		<td>";
		if($row['profile_imge'] == "")
		{
		echo "<img src='images/821no-user-image.png' width='100px' height='100px' alt='$row[1]'/>";
		}
		else if(file_exists($row['profile_imge']))
		{
		echo "<img src='".$row['profile_imge']."' width='100px' height='100px' alt='$row[1]'/>";
		}
		else
		{
		echo "<img src='images/821no-user-image.png' width='100px' height='100px' alt='$row[1]'/>";
		}
		echo "</td>
		<td>".$row['name']."</td>
		<td>".$rscourse['coursename'] ."</td>
		<td>".$row['semester']."</td>
		<td>".$row['gender']."</td>
		<td>".date("d-M-Y",strtotime($row['dob']))."</td>
		<td>".$row['emailid']."</td>
		<td>".$row['address']."</td>
		<td>".$row['phone']."</td>
	   
		<td><a href='verify_student.php?id=$row[0]' >Approve</a>&nbsp;/&nbsp;<a href='verify_student.php?did=$row[0]'>Deny</a></td>
	  </tr>";
	  }
   }
  else	  
	  {
		  echo "<tr><td colspan='10' style='text-align:center;'>Sorry!! No Records</td></tr>";
	  }
?>
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
        $(document).ready(function () {
            $('#dataTables-example').dataTable({
		dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: [
            'pageLength',
			'pdfHtml5'
        ]
	} );
        });
    </script>
 <?php
include("footer.php");
  ?>