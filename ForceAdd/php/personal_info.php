<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

  <title>Miami University - CSE Force Add Website</title>

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
                                                <li><a href="#">Dashboard</a></li>
                                                <li><a href="#">Settings</a></li>
                                                <li><a href="index.html">Profile</a></li>
                                                <li><a href="help.html">Help</a></li>
                                              </ul>
                                              <form class="navbar-form navbar-right">
                                                <input type="text" class="form-control" placeholder="Search...">
                                              </form>
                                            </div>
                                          </div>
                                        </div>

                                        <div class="container-fluid">
                                          <div class="row">
                                            <div class="col-sm-3 col-md-2 sidebar">
                                              <ul class="nav nav-sidebar">
                                                <li><a href="index.html">Student Overview</a></li>
                                                <li class="active"><a href="personal_info.html">Personal Information</a></li>
                                                <li><a href="new_request.html">New Force-Add Request</a></li>
                                                <li><a href="check_request.html">Check Request Status</a></li>
                                              </ul>
                                              <ul class="nav nav-sidebar">
                                                <li><a href="">Logout</a></li>
                                              </ul>

                                            </div>


                                            // content goes here !
                                            <div class="container">

                                              <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                                                <h1 class="page-header">Personal Information</h1>

                                                <h4>Major / Minor </h4>

                                                <form action="">
                                                  <select name="Majors">
                                                    <option value="Computer Science">Computer Science</option>
                                                    <option value="Electrical Engineering">Electrical Engineering</option>
                                                    <option value="Computer Engineering">Computer Engineering</option>
                                                    <option value="Software Engineering">Software Engineering</option>
                                                  </select>
                                                </form>

                                                <h5>Please specify whether this is your major or minor:</h5>
                                                <form role="form">

                                                  <div class="checkbox">
                                                    <label>
                                                      <input type="radio" name="group1" value="Major" checked> Major
                                                      <input type="radio" name="group1" value="Minor"> Minor
                                                    </label>
                                                  </div>

                                                  <form action="">
                                                    <select name="Majors">
                                                      <option value="Computer Science">Computer Science</option>
                                                      <option value="Electrical Engineering">Electrical Engineering</option>
                                                      <option value="Computer Engineering">Computer Engineering</option>
                                                      <option value="Software Engineering">Software Engineering</option>
                                                    </select>
                                                  </form>

                                                  <h5>Please specify whether this is your major or minor:</h5>
                                                  <form role="form">

                                                    <div class="checkbox">
                                                      <label>
                                                        <input type="radio" name="group1" value="Major"> Major
                                                        <input type="radio" name="group1" value="Minor" checked> Minor
                                                      </label>
                                                    </div>

                                                    <hr>
                                                    <h4>When do you plan to graduate?</h4>
                                                    <h5>Season:</h5>
                                                    <form action="">
                                                      <select name="Seasons">
                                                        <option value="Fall">Fall</option>
                                                        <option value="Winter">Winter</option>
                                                        <option value="Spring">Spring</option>
                                                        <option value="Summer">Summer</option>
                                                      </select>
                                                    </form>

						    
                                                    <h5>Year:</h5>
                                                    <form action="">
                                                      <select name="Years">
                                                        

                                                     </select>
                                                   </form>
                                                   <hr>

                                                   <button type="submit" class="btn btn-default">Submit</button>


                                                 </form>





                                               </div>
                                             </div>

                                             // end content goes here !


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
