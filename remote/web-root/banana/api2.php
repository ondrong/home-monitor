<?php

require("inc/mysql_conn.php");

$query = "SELECT * FROM banana ORDER BY id DESC LIMIT 1";

$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)){
setlocale(LC_TIME, 'lt_LT');
$updated=$row['data'];
$second_floor=str_replace(".",",",$row['temp01']);
$first_floor=str_replace(".",",",$row['temp02']);

}

print($updated . "|" . $first_floor . "|" . $second_floor);

?>
