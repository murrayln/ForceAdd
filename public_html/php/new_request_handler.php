<?php

$course = $_POST["course"];
$section = $_POST["section"];
$text = $_POST["text"];
$dateEntered = date("Y-m-d H:i:s");

// parse strings and extract only useful information
$course_string = explode(" ", $course);
$section_string = explode(" ", $section);
$course = substr($course_string[1], 0, -1);
$section = substr($section_string[1], 0, -1);

// this will need to change based on authentication
$uniqueId = "accepted";

include 'db.php';

$query = "SELECT crn FROM Class WHERE courseNum = '$course' and section = '$section'"; 
$result = mysql_query($query);

if(!$result){
echo("<p>Error performing query: " . mysql_error()."<p>");
}

while( $row = mysql_fetch_array($result) ){
$crn = $row['crn'];
}

$strSQL = "INSERT INTO Request (";
$strSQL = $strSQL . "requestedCRN, ";
$strSQL = $strSQL . "uniqueId, ";
$strSQL = $strSQL . "dateEntered, ";
$strSQL = $strSQL . "description) ";

$strSQL = $strSQL . "VALUES (";

$strSQL = $strSQL . $crn . ", ";
$strSQL = $strSQL ."\"". $uniqueId."\", ";
$strSQL = $strSQL ."\"". $dateEntered. "\", ";
$strSQL = $strSQL ."\"". $text."\")";


mysql_query($strSQL) or die (mysql_error());

mysql_close();

header('Location: new_request.php');
exit;

?>