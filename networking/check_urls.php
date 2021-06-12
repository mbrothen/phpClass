<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Validate Urls</title>

</head>
<body>

<?php # check_urls.php
    function check_url($url) {
        // Break URL Down
        $url_pieces = parse_url($url);

        // Set the path and port
        $path = (isset($url_pieces['path'])) ? $url_pieces['path'] : '/';
        $port = (isset($url_pieces['port'])) ? $url_pieces['port'] : 80;

        // Connect with fsockopen
        if ($fp = fsockopen ($url_pieces['host'], $port, $errno, $errstr, 30)) {
            $send = "HEAD $path HTTP/1.1\r\n";
            $send .= "HOST: {$url_pieces['host']}\r\n";
            $send .= "CONNECTION: Close\r\n\r\n";
            fwrite($fp, $send);

            // Read the response
            $data = fgets($fp, 128);

            // Close connection
            fclose($fp);

            // Return response code
            list($response, $code) = explode(' ', $data);
            if ($code == 200) {
                return array($code, 'good');
            } else {
                return array($code, 'bad');
            }
        } else {
            return array($errstr, 'bad');
        }
    }
$urls = array(
    'http://www.larryullman.com/',
    'http://www.larryullman.com/wp-admin/',
    'http://www.yiiframework.com/tutorials/',
    'http://video.google.com/videoplay?docid=-5137581991288263801&q=loose+change'
);

// Print header:
echo '<h2>Validating URLS</h2>';

// Kill the php time limit
set_time_limit(0);

// Validate URLS

foreach ($urls as $url) {
    list($code, $class) = check_url($url);
    echo "<p><a href=\"$url\" target\"_new\">$url</a> (<span class=\"$class\">$code</span>)</p>\n";
}

?>

</body>
</html>