			<nav class="navbar">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a class="nav-in" href="index.php"><span data-letters="Home">Home</span></a> </li>
						<?php
						if (!isset($_SESSION["type"])) {
						?>
							<li><a class="nav-in" href="login.php"><span data-letters="Login">Login</span></a></li>
							<li><a class="nav-in" href="reg.php"><span data-letters="New Alumni">New Alumni</span></a></li>
							<li><a class="nav-in" href="staffreg.php"><span data-letters="New Staff">New Staff</span></a></li>
							<li><a class="nav-in" href="studentreg.php"><span data-letters="New Student">New Student </span></a></li>
						<?php
						} else if (isset($_SESSION["type"]) && $_SESSION['type'] == 'admin') {
						?>
							<li><a class="nav-in" href="addadmin.php"><span data-letters="New Admin">New Admin</span></a></li>
							<li><a class="nav-in" href="managecourse.php"><span data-letters="Manage Course">Manage Course</span></a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Verify<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="verify_reg.php" style='color:black'><span data-letters="Alumni">Alumni</span></a></li>
									<li><a href="verify_staff.php" style='color:black'><span data-letters="Staff">Staff</span></a></li>
									<li><a href="verify_student.php" style='color:black'><span data-letters="Student">Student</span></a></li>
								</ul>
							</li>
							
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Office Bearers<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="region.php" style='color:black'><span data-letters="Add Region">Add Region</span></a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="changepass.php" style='color:black'><span data-letters="Change Password">Change Password</span></a></li>
									<li><a href="logout.php" style='color:black'><span data-letters="Logout">Logout</span></a></li>
								</ul>
							</li>

						<?php
						} else if (isset($_SESSION["type"]) && $_SESSION['type'] == 'alumni') {
						?>
							<li><a class="nav-in" href="job.php"><span data-letters="Jobs">Jobs</span></a></li>
							<li><a class="nav-in" href="mypost.php"><span data-letters="My Posts">My Posts</span></a></li>
							<li><a class="nav-in" href="appliedJobs.php"><span data-letters="Applied Jobs">Applied Jobs</span></a></li>
							
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="alumniprofile.php" style='color:black'><span data-letters="Update Profile">Update Profile</span></a></li>
									<li><a href="changepass.php" style='color:black'><span data-letters="Change Password">Change Password</span></a></li>
									<li><a href="logout.php" style='color:black'><span data-letters="Logout">Logout</span></a></li>
								</ul>
							</li>
						<?php
						} else if (isset($_SESSION["type"]) && $_SESSION['type'] == 'student') {
						?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="studentprofile.php" style='color:black'><span data-letters="Update Profile">Update Profile</span></a></li>
									<li><a href="changepass.php" style='color:black'><span data-letters="Change Password">Change Password</span></a></li>
									<li><a href="logout.php" style='color:black'><span data-letters="Logout">Logout</span></a></li>
								</ul>
							</li>
						<?php
						} else if (isset($_SESSION["type"]) && $_SESSION['type'] == 'staff') {
						?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="staffprofile.php" style='color:black'><span data-letters="Update Profile">Update Profile</span></a></li>
									<li><a href="changepass.php" style='color:black'><span data-letters="Change Password">Change Password</span></a></li>
									<li><a href="logout.php" style='color:black'><span data-letters="Logout">Logout</span></a></li>
								</ul>
							</li>
						<?php
						}
						?>

					</ul>
				</div><!-- /.navbar-collapse -->

			</nav>