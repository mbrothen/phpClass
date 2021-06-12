<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Using cURL</title>
</head>
<body>
<h2>cURL Results:</h2>
<?php # Script 10.4 - curl.php

$url = "http://apollo.gtc.edu/~mbrothen/PHP2/networking/service.php";


// Start the process
$curl = curl_init($url);

// fail if an error occur
curl_setopt($curl, CURLOPT_FAILONERROR, 1);

// Allow for redirects
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);

// Assign the returned data to var
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

// Set timeout
curl_setopt($curl, CURLOPT_TIMEOUT, 5);

// Use POST
curl_setopt($curl, CURLOPT_POST, 1);

// Set POST data
curl_setopt($curl, CURLOPT_POSTFIELDS, 'name=foo&pass=bar&format=csv');

// Execute transaction
$r = curl_exec($curl);

// Close connection
curl_close($curl);

// Print the results:
print_r($r);

?>

</body>
</html>
