<?php

if(count(get_included_files()) == 1) exit("Not permitted. Forbidden. Go away!");

mysql_connect("localhost", "MYSQL_USER", "MYSQL_PASSWORD") or die(mysql_error());
mysql_select_db("database") or die(mysql_error());

?>

