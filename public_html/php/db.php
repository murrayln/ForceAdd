<?php

$link = @mysql_connect("localhost", "courserequest", "WhqcTVG8bjHXqDC4");
if(!$link){
echo( "<p>Unable to connect to the database server at this time.</p>");
}

$db_selected = mysql_select_db('courserequest', $link);
if (!$db_selected) {
echo('Can\'t use courserequest : ' . mysql_error());
}

?>