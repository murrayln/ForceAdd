<?php

// sets up database connection
include 'db.php';

// grabs the string sent by ajax
$id = $_POST['id'];


// query to get sections only applicable to that course
$query = "SELECT DISTINCT section, meetingDaysTimes FROM Class WHERE courseNum = '$id' ORDER BY section";
$result = mysql_query($query);

if(!$result){
echo("<p>Error performing query: " . mysql_error()."<p>");
}

// echo out all the sections
while( $row = mysql_fetch_array($result) ){
echo("<option>Section: " . $row['section'].": ".$row['meetingDaysTimes']."</option>");
}


mysql_close($link)

?>