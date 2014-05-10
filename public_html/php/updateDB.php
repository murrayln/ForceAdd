<?php

include 'db.php';

$result = mysql_query("SELECT lastUpdate, termCode FROM Admin");
$row = mysql_fetch_array($result);
$lastUpdate = $row['lastUpdate'];
$today = date("Y-m-d");
$termCode =  $row['termCode'];

// Should we update?
if ($lastUpdate<$today){
	$query = "UPDATE Admin SET lastUpdate=\"".$today."\" WHERE termCode=" . $termCode;
	mysql_query($query);
}

$url = "http://ws.miamioh.edu/courseSectionV2/" . $termCode . ".xml?courseSubjectCode=CSE&campusCode=O";
if (($response_xml_data = file_get_contents($url))===false){
    echo "<p>Error fetching XML\n</p>";
} else {
   libxml_use_internal_errors(true);
   $data = simplexml_load_string($response_xml_data);
   if (!$data) {
       echo "Error loading XML\n";
       foreach(libxml_get_errors() as $error) {
           echo "\t", $error->message;
       }
   } else {
   		for($i = 0; $i<count($data->courseSection); ++$i){
			// Reset Variables
			$termDesc = "N/A";
			$campusCode = "O";
			$crn = -1;
			$subject = "N/A";
			$courseNum = -1;
			$section = "N/A";
			$courseTitle = "N/A";
			$creditHours = -1;
			$instructorUniqueId = "N/A";
			$meetingDaysTimes = "N/A";
			// Start Query
   			$query="INSERT INTO `Class` (`termCode`, `termDesc`, `campusCode`, `crn`, `subject`,"."
   			 `courseNum`, `section`, `courseTitle`, `creditHours`, `instructorUniqueId`, `meetingDaysTimes`) VALUES(";
   			foreach ($data->courseSection[$i]->children() as $name=>$val){
   				switch ($name){
					case "courseId":
						$crn = $val;
						break;
					case "courseTitle":
						$courseTitle = $val;
						break;
					case "creditHoursHigh":
						$creditHours = $val;
						break;
					case "courseSubjectCode":
						$subject = $val;
						break;
					case "courseNumber":
						$courseNum = $val;
						break;
					case "courseSectionCode":
						$section = $val;
						break;
					case "partOfTermStartDate":
						$termDesc=" Starts on: " . $val;
						break;
					case "partOfTermEndDate":
						$termDesc.=" Ends on: " . $val;
						break;
					case "courseSchedules":
						if (strlen($data->courseSection[$i]->courseSchedules->courseSchedule->days)<=0){
							break;
						}
						$meetingDaysTimes =
						$data->courseSection[$i]->courseSchedules->courseSchedule->days . 
						" at " . 
						$data->courseSection[$i]->courseSchedules->courseSchedule->startTime . " - " . 
						$data->courseSection[$i]->courseSchedules->courseSchedule->endTime . 
						"; In: " . 
						$data->courseSection[$i]->courseSchedules->courseSchedule->buildingCode . " " . 
						$data->courseSection[$i]->courseSchedules->courseSchedule->room;
						break;
					case "instructors":
						if (strlen($data->courseSection[$i]->instructors->instructor->username)<=0){
							break;
						}
						$instructorUniqueId = strtolower($data->courseSection[$i]->instructors->instructor->username);
						break;
					default:
						break;
   				}
				
   			}
			$query.= "". $termCode . ", \"" . $termDesc . "\", \"" . $campusCode . "\", " . $crn . ", \"" . $subject .
			 "\", \"" . $courseNum . "\", \"" . $section . "\", \"" . $courseTitle . "\", " . $creditHours . ", \"" . $instructorUniqueId . "\", \"" . $meetingDaysTimes .
			 "\") ON DUPLICATE KEY UPDATE `termDesc` = \"" . $termDesc . "\", `campusCode` = \"" . $campusCode . "\", `courseNum` = \"" . $courseNum . "\", `section` = \"" . $section . 
			"\", `courseTitle` = \"" . $courseTitle . "\", `creditHours` = " . $creditHours . ", `instructorUniqueId` = \"" . $instructorUniqueId . "\", `meetingDaysTimes` = \"" . $meetingDaysTimes . "\"";
			
			mysql_query($query);
   		}
   		
   }
}

?>