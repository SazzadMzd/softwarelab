<?php
include("sqlcon.php");
if (!isset($_SESSION["type"]) || $_SESSION["type"] != "admin") {
  echo "<script>window.location='index.php'</script>";
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the image path from the database based on the provided ID
    $query = "SELECT photo FROM tblgallery WHERE gid = $id";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $imagePath = $row['photo'];   

        // Delete the image file from the server
        if (unlink($imagePath)) {
            // Remove the image entry from the database
            $deleteQuery = "DELETE FROM tblgallery WHERE gid = $id";
            if (mysqli_query($con, $deleteQuery)) {
		        echo "<script>alert('Image deleted successfully...!!');window.location='manage_gallery.php';</script>";
            } else {
		        echo "<script>alert('Failed to delete image from the database.');window.location='manage_gallery.php';</script>";

            }
        } else {
		    echo "<script>alert('Failed to delete the image file from the server.');window.location='manage_gallery.php';</script>";

        }
    } else {
        echo "<script>alert('Image not found in the database.');window.location='manage_gallery.php';</script>";

    }
}
?>

<?php
include("header.php")
  ?>

 
<div class="container">
	<div class="page">
   <h3 align='center'>Manage Gallery</h3>
   <p>&nbsp;</p>
  <div class="bs-example" data-example-id="contextual-table" style="border: 1px solid #eee">
    <table class="table" id="dataTables-example">
    <thead>
  <tr>
    <th>#</th>
	  <th>Image</th>
    <th>Event Name</th>
     <th>Action</th>
   </tr>
    <thead>
    <tbody>
    <?php
    $i = 1;
    $res = mysqli_query($con, "select * from tblgallery,tblalumnimeet where tblgallery.eventid=tblalumnimeet.eventid");
    while ($row = mysqli_fetch_array($res)) {
      echo "<tr>";
      echo "<td>$i</td>";
      echo "<td><img src='$row[2]' width='100px' height='100px'/></td>";
      echo "<td>$row[4]</td>";
      echo "<td><a href='?id=$row[0]'>Delete</a></td>"; // Delete link with parameter   
      echo "</tr>";
      $i++;
    }
    ?>

</tbody>
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