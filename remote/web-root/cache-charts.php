<?

ini_set('max_execution_time', 300);

$ch = curl_init('http://your.host.net/image/1.png');
$fp = fopen('./grafikas-diena.png', 'wb');
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
fclose($fp);

$ch = curl_init('http://your.host.net/image/2.png');
$fp = fopen('./grafikas-savaite.png', 'wb');
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
fclose($fp);

$ch = curl_init('http://your.host.net/image/3.png');
$fp = fopen('./grafikas-menuo.png', 'wb');
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
fclose($fp);

$ch = curl_init('http://your.host.net/image/4.png');
$fp = fopen('./grafikas-metai.png', 'wb');
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
fclose($fp);

?>