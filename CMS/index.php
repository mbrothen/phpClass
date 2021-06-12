<?php # index.php

// Need utilities file:
require('includes/utilities.inc.php');
// Include Header
$pageTitle = "Welcome to the Site";
include('includes/header.inc.php');

// Get 3 most recent pages:
try {
    $q = 'SELECT id, title, content, DATE_FORMAT(dateAdded, "%e %M %Y") AS dateAdded FROM pages ORDER BY dateAdded DESC LIMIT 3';
    $r = $pdo->query($q);

    // check if rows were returned
    if ($r && $r->rowCount() > 0) {
        // Set teh fetch mode
        $r->setFetchMode(PDO::FETCH_CLASS, 'Page');

        // Records will be fetched in the view;
        include('views/index.html');
    } else { //problem
        throw new Exception('No content is available at this time.');
        }
} catch (Exception $e) {
    include('views/error.html');
}

// Include the footer
include('includes/footer.inc.php');
?>
