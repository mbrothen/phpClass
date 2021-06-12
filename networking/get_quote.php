<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Get Stock Quotes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php #get_quote.php
if (isset($_GET['symbol']) && !empty($_GET['symbol'])) {
    $token = 'pk_0b4aa3265e3c42af999fd86d53c668cd';
    $url = sprintf('https://cloud.iexapis.com/v1/stock/%s/batch?types=quote&token=%s', $_GET['symbol'], $token);
    $read = json_decode(file_get_contents($url));  //convert JSON to Array of objects
    echo '<div>The latest value for 
        <span class="quote">' .  $read->quote->symbol .
        ' (' . $_GET['symbol'] . ') is $' . $read->quote->iexRealtimePrice . '.';
    #echo var_dump($read->quote->close);  close is reading null on all stocks, switched to real time price
} else {
    echo '<div class="error">Invalid Symbol!</div>';
}

?>
<form action="get_quote.php" method="get">
    <fieldset>
        <legend>Enter a NYSE stock symbol to get the latest price:</legend>
        <p><Label for="symbol">Symbol</Label>: <input type="text" name="symbol" size="5" maxlength="5"></p>
        <p><input type="submit" name="submit" value="Fetch the Quote!" /></p>
    </fieldset>
</form>
</body>
</html>