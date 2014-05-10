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
						<li >
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
						<li class="active">
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
			<?php
			// SET up DB
			$link = @mysql_connect("localhost", "courserequest", "WhqcTVG8bjHXqDC4");
				if(!$link){
					echo( "<p>Unable to connect to the database server at this time.</p>");
				}

				$db_selected = mysql_select_db('courserequest', $link);
				if (!$db_selected) {
					echo('Can\'t use courserequest : ' . mysql_error());
				}
				
			// display form if user has not clicked submit
			if (!isset($_POST["submit"]))
			  {
			  ?>
			<form class="form-horizontal" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
			<fieldset>

			<!-- Form Name -->
			<legend>Email</legend>
			
			<!-- Multiple Checkboxes (inline) -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="to">To</label>
			  <div class="col-md-4">
				<label class="checkbox-inline" for="to-0">
				  <input type="checkbox" name="to[]" id="to-0" value="Accepted">
				  Accepted
				</label>
				<label class="checkbox-inline" for="to-1">
				  <input type="checkbox" name="to[]" id="to-1" value="Pending">
				  Pending
				</label>
				<label class="checkbox-inline" for="to-2">
				  <input type="checkbox" name="to[]" id="to-2" value="Declined">
				  Declined
				</label>
			  </div>
			</div>
			
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
			<!-- Button -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="submit"></label>
			  <div class="col-md-4">
				<input  type = "submit" name="submit" value = "Send" class="btn btn-primary">
			  </div>
			</div>


			</fieldset>
			</form>
			<?php 
			  }
			else{
			  // the user has submitted the form
			  if(isset($_POST['to']) && !empty($_POST['to']) && isset($_POST["submit"])) 
			  {
			  	require_once('class.phpmailer.php');	
			  	// Get all students that match the 'Status'
				$whereClause = "Status = ";
				  for($i =0; $i<count($_POST['to']); ++$i){
					if ($i==0)
						$whereClause.="\"".$_POST['to'][$i]."\"";
					else
						$whereClause.= " OR Status = \"".$_POST['to'][$i]."\"";
					}
				$whereClause.=";";
				$query = "SELECT requestNum, uniqueId FROM Request WHERE ".$whereClause;
				$result = mysql_query($query);												// Get all students that match the status
				if(!$result){
					echo("<p>Error performing query: " . mysql_error()."</p>");
				}
				
				$toList = "";

				$first = 0;
				$updateQuery = "UPDATE Request SET beenEmailed='Y' WHERE";				// Update the request's beenEmailed field
				
				$mail = new PHPMailer();												// Mailer
				$mail->IsSMTP();
				$mail->Host       = "mailfwd.muohio.edu";
				#$mail->SMTPDebug  = 2; 
				
				while( $row = mysql_fetch_array($result) ){
					$mail->AddAddress($row["uniqueId"]."@miamioh.edu");
					if ($first == 0){
						$updateQuery.=" requestNum = " .$row["requestNum"];
						$first+=1;
					}else{
						$updateQuery.=" OR requestNum = ".$row["requestNum"];
					}
				}
				
				$updateQuery.=";";
				
				mysql_query($updateQuery);												// Update the beenEmailed field in DB

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
}
			}
			?>
			
			<form class="form-horizontal" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" onsubmit="return confirm('Do you really want to change the semester & delete current records?');">
				<p>Please enter the term code you wish to have Force Add Requests for. <br /><b>NOTE!!</b> This is get rid of all current requests and set the classes to the specified semester.</p>
				<input id="termCode" name="termCode" type="text" placeholder="YYYY??" class="input-xlarge">
				<input  type = "submit" id = "change" name="change" value = "Change" class="btn btn-primary">
			</form>
			
						<?php 
			  // the user has submitted the form
			  if(isset($_POST["change"])) { // 
			  	if (strlen($_POST['termCode']) == 6){ // 
					$query = "UPDATE Admin SET lastUpdate = \"2014-01-01\", termCode = ".$_POST['termCode'];
					mysql_query($query);
					$dropRequest = "DELETE FROM Request";
					mysql_query($dropRequest);
					$dropClass = "DELETE FROM Class";
					mysql_query($dropClass);
					echo "<p>Success!</p>";
					mysql_close($link);
				}
				else {
					echo "<p> Inncorrect length of termCode</p>";
				}
			  }
			?>
			
			</div>
			</div>
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

