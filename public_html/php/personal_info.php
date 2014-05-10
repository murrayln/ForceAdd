
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="../images/ico/favicon.ico">

		<title>CSE Force-Add</title>

		<!-- Bootstrap core CSS -->
		<link href="../dist/css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="../css/dashboard.css" rel="stylesheet">

		<!-- Just for debugging purposes. Don't actually copy this line! -->
		<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>

		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">CSE Force Add</a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li>
							<a href="help.php">Help</a>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-3 col-md-2 sidebar">
					<ul class="nav nav-sidebar">
						<li>
							<b><h4>&nbsp;&nbsp;Student Pages<h4></b>
						</li>
						<li>
							<a href="../index.php">Student Overview</a>
						</li>
						<li class ="active">
							<a href="personal_info.php">Personal Information</a>
						</li>
						<li>
							<a href="new_request.php">New Force-Add Request</a>
						</li>
						<li>
							<a href="check_request.php">Check Request Status</a>
						</li>
						<br>
						<br>
						<li>
							<b><h4>&nbsp;&nbsp;Administrative Pages<h4></b>
						</li>
						<li>
							<a href="process_requests.php">Process Requests</a>
						</li>
						<li>
							<a href="email_students.php">Email Students</a>
						</li>

					</ul>
					<ul class="nav nav-sidebar">
						<li>
							<a href="">Logout</a>
						</li>
					</ul>

				</div>
			</div>


<!-- content here !-->
				<div class="container">

					<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
						<h1 class="page-header">Personal Information</h1>
						<?php
						if(!isset($_POST["submit"])){
							?>
						<h4>Major / Minor </h4>

						<form class="form-horizontal" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
							<select name="Majors1">

								<option value="Computer Science">Computer Science</option>
								<option value="Electrical Engineering">Electrical Engineering</option>
								<option value="Computer Engineering">Computer Engineering</option>
								<option value="Software Engineering">Software Engineering</option>
								<option value="Other">Other</option>
							</select>

						<h5>Please specify whether this is your major or minor:</h5>

							<div class="checkbox">
								<label>
									<input type="radio" name="group1" value="Major" checked>
									Major
									<input type="radio" name="group1" value="Minor">
									Minor </label>
							</div>
							<br />
								<select name="Majors2">
									<option value="Computer Science">Computer Science</option>
									<option value="Electrical Engineering">Electrical Engineering</option>
									<option value="Computer Engineering">Computer Engineering</option>
									<option value="Software Engineering">Software Engineering</option>
									<option value="None">None</option>
								</select>

							<h5>Please specify whether this is your major or minor:</h5>
								<div class="checkbox">
									<label>
										<input type="radio" name="group2" value="Major">
										Major
										<input type="radio" name="group2" value="Minor" checked>
										Minor </label>
								</div>

								<hr>
								<h4>When do you plan to graduate?</h4>
								<h5>Season:</h5>
									<select name="Season">
										<option value="Fall">Fall</option>
										<option value="Winter">Winter</option>
										<option value="Spring">Spring</option>
										<option value="Summer">Summer</option>
									</select>
								<h5>Year:</h5>
									<select name="Year">

										<?php
										// Set up year drop down make it 5 years out from now
										$start_year = date('Y');
										$end_year = $start_year + 5;

										for ($i = $start_year; $i <= $end_year; $i++) {
											echo '<option value = '. $i .'>' . $i . '</option>';
										}
										?>
									</select>
								<hr>
								<input type="submit" name="submit" value = "Submit" class="btn btn-default">
						</form>
						
						<?php
						}
						else{
							// set up DB connection
							include 'db.php';
							
							$uniqueId = "tester";
							$major = "";
							$minor = "";
							// Get all info from student
							if ($_POST['group1'] == "Major"){
								$major = $_POST['Majors1'];
							} else{
								$minor = $_POST['Majors1'];
							}
							if ($_POST['group2'] == "Major"){
								if (strlen($major) >1){
									$major = $major." / ";
								}
								$major = $major.$_POST['Majors2'];
							} else{
								if (strlen($minor) >1){
									$minor = $minor." / ";
								}
								$minor = $minor.$_POST['Majors2'];
							}
							
							$gradSeason = $_POST['Season'];
							$gradYear =  $_POST['Year'];
							
							// Insert/Update our student table
							$query = "INSERT INTO Student VALUES ('". $uniqueId."', '". $major."', '". $minor."',  ". $gradYear.", '". $gradSeason."')
										ON DUPLICATE KEY
										UPDATE major = '". $major."', minor = '". $minor."', gradSeason = '". $gradSeason."', gradYear = ". $gradYear;
							$result = mysql_query($query);
							if(!$result){
								echo("<p>Error performing query: " . mysql_error()."</p>");
							} else {
								echo("<p><b>Success!!</b> Please proceed to adding a new force-add request! </p>");
							}
						}
						
						?>

					</div>
				</div>

				<!--// end content goes here !-->

			</div>
		</div>
		</div>

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script type="text/javascript" src="http://twitter.github.com/bootstrap/assets/js/bootstrap-dropdown.js"></script>
		<script src="../dist/js/bootstrap.min.js"></script>
		<script src="../dist/js/docs.min.js"></script>
	</body>
</html>
