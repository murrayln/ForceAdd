<?php
echo("<h1>hello</h1>");

$db = new SQLite3('/home/smaydarp/public_html/db/test.db');

$results = $db->query('SELECT crn FROM Class');
while ($row = $results->fetchArray()) {
    var_dump($row);
}
?>