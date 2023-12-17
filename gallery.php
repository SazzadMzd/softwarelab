<?php
include("sqlcon.php");
session_start();
error_reporting(0);
?>
<?php
include("header.php");
?>

<div class="content">
    <div class="gallery">
        <div class="container">
            <h2>Gallery</h2>

            <!--script-->
            <div class="port-grid">
                <!---->
                <!-- get images from  -->

                <div class="galley-1 animated wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="500ms">
    <div class='row' style="justify-content: center;"> <!-- Added inline style for centering -->
        <?php
        $c = 1;
        // Fetch all event names
        $qry = mysqli_query($con, "SELECT * FROM tblalumnimeet");
        while ($row = mysqli_fetch_array($qry)) {
        ?>
        <div class="col-md-4 galley-2">
            <div class="text-center"> <!-- Added text-center class for content centering -->
                <a class="b-link-stripe b-animate-go" href="gallery_info.php?eventid=<?php echo $row["eventid"]; ?>" rel="" title="<?php echo $row["event_name"]; ?>">
                    <img src="images/folder.png" class="img-responsive" style='height: 250px;width: 80%; display: block; margin: 0 auto;' /> <!-- Added display: block and margin for image centering -->
                    <span class="zoom-icon"> </span>
                </a>
                <h1 class="text-center"><?php echo $row["event_name"]; ?></h1>
            </div>
        </div>
        <?php
            if ($c % 3 == 0) {
                echo "</div>";
                echo "<div class='row' style='justify-content: center;'>";
            }
            $c++;
        }
        ?>
        <div class="clearfix"></div>
    </div>
</div>



                <!---->

            </div>
            <!-- //Gallery -->

        </div>
        <!--//content-slide-->
    </div>

</div>

<?php
include("footer.php");
?>