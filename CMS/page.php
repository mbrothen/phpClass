<?php
require('includes/utilities.inc.php');
try {
    // Validate Page ID
    if (!isset($_GET['id'])  || !filter_var($_GET['id'], FILTER_VALIDATE_INT, array ('min_range'=> 1))){
        throw new Exception('An invalid page ID was provided.');
    }
    $q = 'SELECT id, title, content, DATE_FORMAT(dateAdded, "%e %M %Y") AS dateAdded FROM pages WHERE id=:id';
    $stmt = $pdo->prepare($q);
    $r = $stmt->execute(array(':id' => $_GET['id']));

    // If query complete, fetch the record into onbject.
    if ($r) {
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Page');
        $page = $stmt->fetch();

        // Confirm page object exists
        if ($page) {
            //  Set the browser title to the page title.
            $pageTitle = $page->getTitle();

            // Create the page:
            include('includes/header.inc.php');
            include('views/page.html');
        } else {
            throw new Exception('An invalid page ID was provided');
        }
    } else {
        throw new Exception('An invalid page ID was provided to this page');
    }


} catch (Exception $e) { // Generic exceptions
    $pageTitle = 'Error!';
    include('includes/header.inc.php');
    include('views/error.html');
}

//Include the footer
include('includes/footer.inc.php');