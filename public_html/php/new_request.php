<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="Logan Gabriel, ">
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
						<li>
							<a href="personal_info.php">Personal Information</a>
						</li>
						<li class="active">
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

				<div class="container">
					<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

						
							<h2 class="form-signin-heading">New Force-Add Request</h2>
							<h4>What type of force-add request are you making?</h4>

						
							<form method="post" action="new_request_handler.php" onSubmit='return validate( this );'>

							<div class="radio">
								<label>
									<input type="radio" name="optionsRadios" id="addingClass" value="add" checked>
									Adding a new course </label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="optionsRadios" id="switchingClass" value="switch">
									Switching to a different section </label>
							</div>
						

							<br>
							<h4>What course do you wish to force-add?</h4>

							
							<select class="form-control" id="course" name="course">
							  <option>Select a class:</option>
								<?php
								   
								   // set up DB connection
								   include 'db.php';
								   
								   // ensures course list is up to date
								   include 'updateDB.php';

								   $result = mysql_query("SELECT DISTINCT subject, courseNum, creditHours FROM Class ORDER BY courseNum ASC");

								   if(!$result){
								   echo("<p>Error performing query: " . mysql_error()."</p>");
								   }

								   while( $row = mysql_fetch_array($result) ){
								   echo("<option>" . $row['subject']." ".$row['courseNum']."; Credit Hours: ".$row['creditHours']."</option>");
								   }

								?>
							</select>
							

							<br>
							<h4>Specify the section of this course you would like to add:</h4>
						
							<select class="form-control" name="section" id="section">
							  <option>Choose a section...</option>

							</select>
							
							<br>

							<h4>Why do you need this course? (Please put in <b>any</b> other sections that fit your schedule here!)</h4>
							
							<textarea class="form-control" rows="5" name="text" id="text"></textarea>
						
							<hr>
							<button class="btn btn-primary btn-lg" type="submit">
								Submit
							</button>
						</form>
							<br>
							<div id="formAlert" class="alert alert-danger fade in hide">
							  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">got it!</button>
							  <h4>Come on now...</h4>
							  <p>You need to specify a reason for wanting this particular class and section. Inspire us!</p>
							  </div>


					</div>
				</div>


			</div>
		</div>
		</div>

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
		<script src="../dist/js/bootstrap.min.js"></script>
		<script src="../dist/js/docs.min.js"></script>
		<script src="../js/new_request.js"></script>

	</body>
</html>
