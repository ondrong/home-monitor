<?php

if ($_REQUEST["psw"] != "secret") { die("WRONG_NOAXX"); }

mysql_connect("localhost", "user", "password") or die(mysql_error());
mysql_select_db("database") or die(mysql_error());

foreach (array_keys($_REQUEST) as $key) {
 $$key = mysql_real_escape_string(addslashes($_REQUEST[$key]));
}

$temp01 = round(floatval($temp01)/1,1);
$temp02 = round(floatval($temp02)/1000,1);

$insert_query = "INSERT INTO banana (temp01,temp02) VALUES ($temp01,$temp02)";

$insertion_result = mysql_query($insert_query);

if(!$insertion_result) echo "BAD_NOTINSERTED";
else echo "OK_INSERTED";

?>
