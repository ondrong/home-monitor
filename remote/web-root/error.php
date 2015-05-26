<?php

// userio ip ir kreipimosi adresas bei data
$ip = $_SERVER['REMOTE_ADDR'];
$page = $_SERVER['REQUEST_URI'];
$date = getdate();
$when = date('Y-m-d H:i:s',$date["0"]);

// gaunam klaidos koda
$status = (isset($_SERVER['REDIRECT_STATUS'])) ? $_SERVER['REDIRECT_STATUS'] : $_SERVER['REDIRECT_REDIRECT_STATUS'];

// kreipiantis tiesiai, permetam i googla
if ($status < 400){
  @header("Location: http://www.google.lt",1,302);
  die();
}

// suformuojam pranesima apie neleistina kreipimasi
print("This attempt has been logged and your IP has just been reported. Have a nice day.<br><br>");
print("Requested page: " . $page . "<br>");
print("When: " . $when . "<br>From: " . $ip);

// prisijungiam prie DB ir uzloginam informacija i lentele
@mysql_connect("localhost", "MYSQL_USER", "MYSQL_USER_PASSWORD") or die(mysql_error());
@mysql_select_db("database") or die(mysql_error());
$sql = "INSERT INTO banana_403 (`data`, `ip`, `page`) VALUES ('$when', '$ip', '$page')";
@mysql_query($sql);
@mysql_close();

?>

