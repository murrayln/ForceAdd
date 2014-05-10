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
						<li>
							<a href="new_request.php">New Force-Add Request</a>
						</li>
						<li class="active">
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

						<h1>Check Request Status</h1>

						<p>
							<b> Here are your current Force-Add Request(s).</b>
							<br>
							Instructions: </br>
							<br>
							1)
							You MUST check back here to see if a request has been ACCEPTED or DENIED.</br>
							<br>
							2)
							IMPORTANT: If you change your mind about a <b>pending </b>request, Please delete your request below.</br>
						</p>

						<div class="bs-example">
							<form class="form-horizontal" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Delete?</th>
										<th><a href="check_request.php?sort=uniqueId">UniqueID</a></th>
										<th><a href="check_request.php?sort=requestedCRN">Code</a></th>
										<th><a href="check_request.php?sort=requestedCRN">CRN</a></th>
										<th><a href="check_request.php?sort=dateEntered">Date Entered</a></th>
										<th><a href="check_request.php?sort=description">Description</a></th>
										<th><a href="check_request.php?sort=status">Status</a></th>
									</tr>
								</thead>
								<tbody>
									<?php
include 'db.php';																			// Set up DB

$sort = array("uniqueId", "requestedCRN", "dateEntered", "description", "status");
$value = 'uniqueId';

// SORTING
if (isset($_GET['sort']) && in_array($_GET['sort'], $sort)){
	$value = $_GET['sort'];
}


$result = mysql_query("SELECT * FROM Request WHERE uniqueId = 'accepted' ORDER BY ".$value); //TODO put in correct username

if(!$result){
	echo("<p>Error performing query: " . mysql_error()."<p>");
}



// Set up HTMl for list
while( $row = mysql_fetch_array($result) ){													// Create Table for user
	echo("<tr>");
	if ($row["status"] == "Pending"){	// Put in check box to delete
		echo("<td><input type=\"checkbox\" name=\"delete[]\" value = \"". $row["requestNum"]."\"></input></td>");
	}
	else {
		echo("<td></td>");
	}
	echo("<td>" . $row["uniqueId"]."</td>");
	
	// Get course information 
	$crnQ = mysql_query("SELECT subject, courseNum, section FROM Class WHERE crn = ". $row["requestedCRN"]); 
	if(!$crnQ){
		echo("<td>Error performing query: " . mysql_error()."</td>");
	}else{
		if ($crow = mysql_fetch_array($crnQ)){
			echo("<td>" . $crow["subject"] . $crow["courseNum"] . " " . $crow["section"]."</td>");
		}else{
			echo("<td>No class data found</td>");
		}
	}
	
	echo("<td>" . $row["requestedCRN"]."</td>");
	echo("<td>" . $row["dateEntered"]."</td>");
	echo("<td>" . $row["description"]."</td>");
	echo("<td>" . $row["status"]."</td>");
	echo("</tr>");
}


									?>

									<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>

									</tr>
								</tbody>
							</table>
							<input  type = "submit" name="submit" value = "Delete Requests" class="btn btn-primary">
			<?php 
			  if(isset($_POST["submit"]) && isset($_POST['delete']) && !empty($_POST['delete'])) { // If they plan to delete something
				$whereClause = "requestNum = ";
				  for($i =0; $i<count($_POST['delete']); ++$i){						// Create clause to delete
					if ($i==0)
						$whereClause.=$_POST['delete'][$i];
					else
						$whereClause.= " OR requestNum = ".$_POST['delete'][$i];
					}
				$whereClause.=";";
				
				$query = "DELETE FROM Request WHERE ".$whereClause;
				mysql_query($query);												// Delete selected Requests
				
				mysql_close($link);
				}
			?>
			</form>
						</div>
						<p>
							<br>

							<b>Status Descriptions</b></br>

							<br>
							ACCEPTED: You are officially enrolled in the course and can attend the section listed under "Your New Section". Please Note: Any section of the course you have previously regisitered for has been DROPPED
							from you schedule and replaced with this new section!

							</br>
							<br>
							DENIED: Your request has been denied. You can continue to try to add the course through Bannerweb.

							</br>
							<br>
							PENDING: Your request is still being considered by the CSE Department. Check back here for updates.

							</br>

					</div>
				</div>

				<!--// end content here !-->

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
