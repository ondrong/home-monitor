<?php
error_reporting(0);

header("Content-type: text/javascript");

if (!isset($_REQUEST["password"])) { die; }

if (isset($_REQUEST["newest"])) { $show_newest_only = true; }

if (!isset($_REQUEST["date"])) { $data = date("Ymd"); } else { $data = $_REQUEST["date"]; }
$kamera = (int) $_REQUEST["kamera"] + 0;
if ($kamera < 1) { $kamera = 1; }

$files[$i] = scandir('../timelapse/archive/'.$data);

foreach($files[$i] as $file ) {
 if (fnmatch("cam$kamera-*jpg", $file)) {
 $arr[] = $file;
 }
}

if ($show_newest_only) { echo json_encode(end((array_values($arr)))); }
else { echo json_encode($arr); }

?>
