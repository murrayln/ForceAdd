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
		
		
		<script> 
		$(function() {
		
		    $('h3').click(function() {
		        $(this).next('div').toggle();
		    });
		
		});
		</script>
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
<script>$(document).ready(function() {</script>
			<div class="container">
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<h1 class="page-header">Help!</h1>
<div>
			Below contains a trouble-shooting guide, please choose the category that applies to you, either student or administrator! If you have any further questions please contact the CSE Force &ndash; Add administrator which is currently Norm Krumpe (<a href="mailto:krumpej@miamioh.edu?subject=CSE%20Force-Add%20Request%3A%20Help&amp;body=Hey%20Mr.%20Krumpe%2C%0A%0AI%20have%20been%20having%20issues...%0A%0ASincerely%2C%0Axxx">krumpenj@miamioh.edu</a>).
			</div>
		<h3 style="color:#2B6599">
			Student: </h3>
			<div id="student" > 
		<h4 style="color:#428BCA" >
			How to register/update your information (graduation year, major, etc.) </h4>
		<div id="help0" >
			Before you are able to submit a request you <strong>must </strong>tell us more about yourself. 
			<ol>
				<li>
					 Select &lsquo;Personal Information&rsquo; </li>
				<li>
					 Fill out the questions concerning your studies and graduation year </li>
				<li>
					 Click &lsquo;Submit&rsquo; </li>
			</ol>
		</div>
		 <h4 style="color:#428BCA">
			 How to submit a request </h4>
		<div id="help1" >
			 <strong>PREREQUISITE </strong>&ndash; you <strong>must </strong>submit your personal information (see above) to submit a request 
		<ol>
			<li>
				 Select &lsquo;New Force-Add Request&rsquo; </li>
			<li>
				 Select the type of request you are making </li>
			<li>
				 Choose the class you are looking for </li>
			<li>
				 Choose the section you are looking for </li>
			<li>
				 Then enter why you need/want the class </li>
			<li>
				 Click &lsquo;Submit&rsquo; </li>
		</ol>
		</div>
		 <h4 style="color:#428BCA">
			 How to check on your submitted request </h4>
		<div id="help2" >
			 <strong>PREREQUISITE </strong>&ndash; you <strong>must </strong>have already submitted a request 
		<ol>
			<li>
				 Select &lsquo;Check Request Status&rsquo; </li>
		</ol>
		</div>
		 <h4 style="color:#428BCA">
			 How to delete a request you already submitted </h4>
		<div id="help3" >
			 <strong>PREREQUISITE </strong>&ndash; you <strong>must </strong>have already submitted a request 
		<ol>
			<li>
				 Select &lsquo;Check Request Status&rsquo; </li>
			<li>
				 Select the Pending requests </li>
			<li>
				 Click &lsquo;Delete Requests&rsquo; </li>
		</ol>
		</div>
		 <h4 style="color:#428BCA">
			 How to log-out </h4>
		<div id="help4" >
		<ol>
			<li>
				 From any page just simply click &lsquo;Logout&rsquo; </li>
		</ol>
		</div>
		</div>
		<h3 style="color:#2B6599">
			 Administrator: </h3>
		<div id="admin" >
		 <h4 style="color:#428BCA">
			 How to set a term for the Force &ndash; Add request </h4>
			 <div id="help5" >
		<ol>
			<li>
				 Select &lsquo;Email Students&rsquo; </li>
			<li>
				 Enter the 6 digit term code </li>
			<li>
				 Click &lsquo;Change&rsquo; </li>
		</ol>
		</div>
		 <h4 style="color:#428BCA">
			 How to process a student submitted request </h4>
			 <div id="help6" >
		<ol>
			<li>
				 Select &lsquo;Process Request&rsquo; </li>
			<li>
				 When you first arrive to the page it will display all current requests. 
				<ul>
					<li>
						 If you want a subset, please enter the CRN and/or the status (Accepted, Pending, Denied) </li>
					<li>
						 Click &lsquo;Filter&rsquo; </li>
				</ul>
			</li>
			<li>
				 Please select the checkboxes you wish to change </li>
			<li>
				 Select the status you want to change the selected request to </li>
			<li>
				 Click &lsquo;Change&rsquo; </li>
		</ol>
		</div>
		 <h4 style="color:#428BCA">
			 How to email a single student </h4>
		<div id="help7" >
			<ol>
				<li>
					 Select &lsquo;Process Request&rsquo; </li>
				<li>
					 When you first arrive to the page it will display all current requests. 
					<ul>
						<li>
							 If you want a subset, please enter the CRN and/or the status (Accepted, Pending, Denied) </li>
						<li>
							 Click &lsquo;Filter&#39; </li>
					</ul>
				</li>
				<li>
					 Please select the checkboxes you wish to email </li>
				<li>
					 Click &lsquo;Email&rsquo; </li>
			</ol>
		</div>
		 <h4 style="color:#428BCA">
			 How to email a group of students </h4>
		<div id="help8" >
		<ol>
			<li>
				 Select &lsquo;Email Students&rsquo; </li>
			<li>
				 Enter the e-mail information </li>
			<li>
				 Click &lsquo;Send&rsquo; </li>
		</ol>
		</div>
		 <h4 style="color:#428BCA">
			 How to log-out </h4>
			 <div id="help9" >
		<ol>
			<li>
				 From any page just simply click &lsquo;Logout&rsquo; </li>
		</ol>	
		</div>	
		</div>			
				</div>
			</div>

<script>});</script>

		</div>
		</div>
		</div>

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="../dist/js/bootstrap.min.js"></script>
		<script src="../dist/js/docs.min.js"></script>
	</body>
</html>
</html>
