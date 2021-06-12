<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>IP Geolocation</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php # Script 10.3 - ip_geo.php

function show_ip_info($ip) {

    $url = 'http://ip-api.com/csv/' . $ip;

    $fp = fopen($url, 'r');

    //get data
    $read = fgetcsv($fp);

    // close the connection
    fclose($fp);

    // Print ip info
    echo "
<p>IP Address: $ip<br> 
Country: $read[2]<br> 
City, State: $read[5], $read[3]<br>
Latitude: $read[7]<br> 
Longitude: $read[8]</p>";
}

echo '<h2>We have the following information about you</h2>';
show_ip_info($_SERVER['REMOTE_ADDR']);

$url = 'www.entropy.ch';
echo '<h2>We know the following about the URL $url</h2>';
show_ip_info($url);

?>
</body>
</html>
