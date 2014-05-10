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
						<li>
							<a href="check_request.php">Check Request Status</a>
						</li>
						<br>
						<br>
						<li>
							<b><h4>&nbsp;&nbsp;Administrative Pages<h4></b>
						</li>
						<li class="active">
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

						<h1>Process Requests</h1>
						<br><h5><i>Filter Requests</i></h5>
						
						<form>
						  Code and Number: <input type="text" name="cnum" value="None"><br>
						  Status: <input type="radio" name="status" value="Accepted"> Accepted
						          <input type="radio" name="status" value="Declined"> Declined
							  <input type="radio" name="status" value="Pending"> Pending
						  <br><input type="submit" value="Filter">
						</form>
						<div class="bs-example">
							<form class="form-horizontal" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
							<table class="table table-striped">
								<thead>
									<tr>
										<th><a href="process_requests.php?sort=uniqueId">UniqueID</a></th>
										<th><a href="process_requests.php?sort=requestedCRN">Code</a></th>
										<th><a href="process_requests.php?sort=requestedCRN">CRN</a></th>
										<th><a href="process_requests.php?sort=dateEntered">Date Entered</a></th>
										<th><a href="process_requests.php?sort=description">Description</a></th>
										<th><a href="process_requests.php?sort=status">Status</a></th>
										<th><a href="process_requests.php?sort=beenEmailed">Emailed?</a></th>
									</tr>
								</thead>
								<tbody>

									<?php
$link = @mysql_connect("localhost", "courserequest", "WhqcTVG8bjHXqDC4");		// Set-up MySQL connection
if(!$link){
echo( "<p>Unable to connect to the database server at this time.</p>");
}

$db_selected = mysql_select_db('courserequest', $link);							// Select DB to look at
if (!$db_selected) {
echo('Can\'t use courserequest : ' . mysql_error());
}

/////////////// FOR SORTING ////////////
$sort = array("uniqueId", "requestedCRN", "dateEntered", "description", "status", "beenEmailed");
$value = 'requestedCRN';
if (isset($_GET['sort']) && in_array($_GET['sort'], $sort)){
     $value = $_GET['sort'];
}
$sort_addition = "";

if(isset($_GET['cnum']) && $_GET['cnum'] != "None"){											// FILTER functionality
		$sub = substr($_GET['cnum'], 0,3);
		$num = intval(substr($_GET['cnum'], -3));
		$crnQ = "SELECT crn FROM Class WHERE subject = '". $sub . "' AND courseNum = ". $num;
		$crnQresult = mysql_query($crnQ);
		// GET all crn based on subject & number
		$crnList = array();
		while( $crnRow = mysql_fetch_array($crnQresult) ){
			$crnList[] = $crnRow["crn"];			
		}
		if (count($crnList) < 1){
			echo "<p> Class not found <b>OR</b> invalid subject & class number. Proper is 'CSE174'</p>";
		} else{																	// MAKE query
			$sort_addition = " WHERE (";
			foreach($crnList as $crn){
				$sort_addition.=" requestedCRN = ". $crn. " OR ";
			}
			$sort_addition = substr($sort_addition, 0, -4);
			$sort_addition.=")";
		}
	if(isset($_GET['status'])){													// Add status if set
             $sort_addition= $sort_addition." AND status ='".$_GET['status']."'";
        }
} else{ /////// If not wanting to sort & have FILTER!
      if(isset($_GET['status']) && $_GET['status'] != "None"){
	  $sort_addition=" WHERE status ='".$_GET['status']."'";
      }
}

$result = mysql_query("SELECT * FROM Request".$sort_addition." ORDER BY ".$value);	// Get ALL requests from DB
if(!$result){
echo("<p>Error performing query: " . mysql_error()."</p>");
}

///////// FILL TABLE in HTML
while( $row = mysql_fetch_array($result) ){
echo("<tr>");
echo("<td><input type=\"checkbox\" name=\"change[]\" value = \"". $row["requestNum"]."\">". $row["uniqueId"]."</input></td>");

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
echo("<td>" . $row["beenEmailed"]."</td>");
echo("</tr>");
}

									?>

								</tbody>
							</table>
							<label class="radio-inline" for="from-0">
							  <input type="radio" name="todo" id="todo-0" value="Accepted" checked="checked">
							  Accept
							</label> 
							<label class="radio-inline" for="from-1">
							  <input type="radio" name="todo" id="todo-1" value="Pending">
							  Pending
							</label>
							<label class="radio-inline" for="from-1">
							  <input type="radio" name="todo" id="todo-2" value="Declined">
							  Declined
							</label>
							</br>
							</br>
							<input  type = "submit" name="submit" value = "Change" class="btn btn-primary">
										<!-- Multiple Radios (inline) -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="from">From</label>
			  <div class="col-md-4"> 
				<label class="radio-inline" for="from-0">
				  <input type="radio" name="from" id="from-0" value="krumpenj" checked="checked">
				  Norm
				</label> 
				<label class="radio-inline" for="from-1">
				  <input type="radio" name="from" id="from-1" value="fosterdw">
				  Drew
				</label>
			  </div>
			</div>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="subject">Subject</label>  
			  <div class="col-md-5">
			  <input id="subject" name="subject" type="text" value="CSE Force Add Request" class="form-control input-md" required="">
				
			  </div>
			</div>

			<!-- Textarea -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="message">Message</label>
			  <div class="col-md-4">                     
				<textarea class="form-control" id="message" name="message" rows="10">Hey,

Thank you for using the CSE Force Add Website.

Sincerely,
Norm Krumpe</textarea>
			  </div>
			</div>
							<input  type = "submit" name="email" value = "E-Mail" class="btn btn-primary">
							</form>
							
		<?php 
		 if(isset($_POST["email"]) && isset($_POST['change']) && !empty($_POST['change'])) { // If people are selected and the email has bee pushed
				require_once('class.phpmailer.php');									// Needed to mail in SMTP
				$whereClause = "requestNum = ";											// Setting up clause to get the requests selected
				  for($i =0; $i<count($_POST['change']); ++$i){
					if ($i==0)
						$whereClause.=$_POST['change'][$i];
					else
						$whereClause.= " OR requestNum = ".$_POST['change'][$i];
					}
				$whereClause.=";";	
				// Update their emailed status
				$query = "UPDATE Request SET beenEmailed='Y' WHERE ".$whereClause;
				mysql_query($query);													// Set all of the request to have been emailed
				// Get their unique Id's
				$query = "SELECT uniqueId FROM Request WHERE ".$whereClause;			// Get the requests UniqueId to set up their e-mails
				$result = mysql_query($query);
				if(!$result){
					echo("<p>Error performing query: " . mysql_error()."</p>");
				}
				
				$mail = new PHPMailer();												// Mailer
				$mail->IsSMTP();
				$mail->Host       = "mailfwd.muohio.edu";
				#$mail->SMTPDebug  = 2; 
				
				while( $row = mysql_fetch_array($result) ){
					$mail->AddAddress($row["uniqueId"]."@miamioh.edu");
				}
				### TODO set to correct miamioh address
				  $from = $_POST["from"]."@miamioh.edu"; // sender
				  $subject = $_POST["subject"];
				  $message = $_POST["message"];
				  $message = str_replace("\n", "<br/>", $message);						// Make the message HTML friendly
				  // send mail
				
				$mail->SetFrom($from);
				$mail->AddReplyTo($from);
				
				$mail->Subject  = $subject;
				$mail->MsgHTML($message);

				 
				if(!$mail->Send()) {													// SEND!!
				  echo "<p>Mailer Error: " . $mail->ErrorInfo . "</p>";
				} else {
				  echo "<p>Message sent!</p>";
				}
				mysql_close($link);
				echo "<p>Success! Please <b>refresh</b> page to change/email another request</p>";
				}
		
		
	elseif(isset($_POST["submit"]) && isset($_POST['change']) && !empty($_POST['change'])) { // If students are selected and submit is clicked
				$whereClause = "requestNum = ";													// Set-up where clause to update the requests
				  for($i =0; $i<count($_POST['change']); ++$i){
					if ($i==0)
						$whereClause.=$_POST['change'][$i];
					else
						$whereClause.= " OR requestNum = ".$_POST['change'][$i];
					}
				$whereClause.=";";
				
				$query = "UPDATE Request SET status='".$_POST['todo']."' WHERE ".$whereClause;
				mysql_query($query);															// Update the requests
				mysql_close($link);
				echo "<p>Success! Please <b>refresh</b> page to change/email another request</p>";
				}


																				// Close DB connection
			?>

						</div>
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
