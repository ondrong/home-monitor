<?php

error_reporting(0);

// the script can be called from .htaccess, i.e. via /image/15.png which points to image.php?id=15


// Our public Google Sheets spreadsheet
$image_url = "https://docs.google.com/spreadsheets/d/secret_change_this/pubchart?";

// Preventing the script from being called directly
if (!isset($_GET["id"])) {
    $image_url .= "oid=secret&format=image";
}

else {
$chart_type = (int) $_GET["id"];

// Generating image URL based on GET query string
switch ($chart_type) {
    case 1:
        $image_url .= "oid=secret&format=image";
        break;
    case 2:
        $image_url .= "oid=secret&format=image";
        break;
    case 3:
        $image_url .= "oid=secret&format=image";
        break;
    case 4:
        $image_url .= "oid=secret&format=image";
        break;
    default:
        $image_url .= "oid=secret&format=image";
        break;
}
}

// Outputting last known inside temperature
$response = file_get_contents("http://your.host.net/api2.php");
if (strlen($response)<10) { sleep(5); $response = file_get_contents("http://your.host.net/api2.php"); } // retrying
$data = explode("|",$response);
setlocale(LC_ALL, 'lt_LT');
$observed2 = strftime("%A, %H:%M",strtotime($data[0])); // Reformating time as readable from unixtime
$indoor_temp = round((floatval(str_replace(",",".",$data[2])) + floatval(str_replace(",",".",$data[2]))) / 2, 2); // Getting the average


// Let's parse gismeteo.lt and get some needed info by parsing the page
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'http://www.gismeteo.lt/city/daily/CHANGETHIS/');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl ,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
$result = curl_exec($curl);
curl_close($curl);

preg_match("/^.*value m_temp c.*$/m", $result,$temp);
$temp2 = preg_replace('/\s+/', '', strip_tags($temp[0]));
$outdoor_temp = str_replace("&deg;C", " C", $temp2);

preg_match("/^.*data-obs-time.*$/m", $result,$temp);
$temp2 = explode('"',$temp[0]);
setlocale(LC_ALL, 'lt_LT');
$observed = strftime("%A, %H:%M",strtotime($temp2[3]) + 3*60*60); // Gismeteo outputs UTC, so we add our timezone


/*
// Let's parse forecast.io
$url = "https://api.forecast.io/forecast/secret/coordinates";
$url .= "?units=si&exclude=minutely,hourly,daily,alerts,flags";
$response = json_decode(file_get_contents($url));
$outdoor_temp = $response->currently->temperature;
$updated = $response->currently->time;
$observed = strftime("%A, %H:%M",$updated); // Reformating time as readable from unixtime
*/

$curl_continue = true;
$counter = 0;

while ($curl_continue) { // trying to get the google chart

if ($counter > 4) { $curl_continue = false; exit; } // maximum number of retries

// Use curl to fetch and resend the image
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $image_url);     // Set the URL
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);   // Short timeout (local)
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   // Return the output
curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);   // Fetch the image as binary data

// Fetch the image
$image_string = curl_exec($ch);                // Even though it's binary it's still a "string"

curl_close($ch);                               // Close connection

if (strlen($image_string) < 1000) { $counter++; } else { $curl_continue = false; }

}


$image = imagecreatefromstring($image_string); // Create an image object


$image_cropped = imagecreatetruecolor(1240, 640); // Generating new image

imagecopy($image_cropped, $image, 0, 0, 20, 0, 1240, 640); // Cropping the original file

if ((float) $outdoor_temp>0) {
$outdoor_temp = "" . $outdoor_temp;
}

if ((float) $indoor_temp>0) {
$indoor_temp = "+" . $indoor_temp;
}



$text = "Outside " . $outdoor_temp . ""; // Our main text
$text2 = "Indoor " . $indoor_temp . " °C"; // Our secondary text
$font = 'lato.ttf'; // Choosing font
$font2 = 'arial.ttf'; // Choosing font
$black = imagecolorallocate($image_cropped, 0, 0, 0); // Creating black color for embedding text onto image
imagettftext($image_cropped, 10, 0, 1070, 620, $black, $font, date("Y-m-d | H:i")); // Chart generation timestamp
imagettftext($image_cropped, 22, 0, 15, 35, $black, $font, $text); // Adding outside temperature
imagettftext($image_cropped, 8, 0, 35, 55, $black, $font2, $observed); // Temperature obvservation time
imagettftext($image_cropped, 22, 0, 970, 35, $black, $font, $text2); // Adding inside temperature
imagettftext($image_cropped, 8, 0, 1060, 55, $black, $font2, $observed2); // Temperature obvservation time
header("Content-type: image/png");             // Set the content type (or you will get ascii)
imagepng($image_cropped);	               // Displaying the image
die();                                         // All done

?>
