<?php
# add_page

// Include utilities
require('includes/utilities.inc.php');

// Redirect if not authorized
if (!$user->canCreatePage()) {
    header("Location:index.php");
    exit;
}

// Create a new form
#set_include_path(get_include_path() . PATH_SEPARATOR . '')
#set_include_path(get_include_path() . PATH_SEPERATOR . '/usr/local/pear/share/pear');
require('HTML/QuickForm2.php');
include('HTML/QuickForm2.php');
$form = new HTML_QuickForm2('addPageForm');

// Add the title field
$title = $form->addElement('text', 'title');
$title->setLabel('Page Title');
$title->addFilter('strip_tags');
$title->addRule('required', 'Please enter a page title');

// Add the content field
$content = $form->addElement('textArea', 'content');
$content->setLabel('Page Content');
$content->addFilter('trim');
$content->addRule('required', 'Please enter the page content');

// Add the submit button
$submit = $form->addElement('submit', 'submit', array('value'=>'Add This Page'));

// Check for a form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate the form data
    if ($form->validate()) {
        // Insert into database
        $q = 'INSERT INTO pages (creatorId, title, content, dateAdded) VALUES (:creatorId, :title, :content, NOW())';
        $stmt = $pdo->prepare($q);
        $r = $stmt->execute(array(':creatorId' => $user->getId(), ':title' => $title->getValue(), ':content' =>
            $content->getValue()));

        // Freeze the form if success
        if ($r) {
            $form->toggleFrozen(true);
            $form->removeChild($submit);
        }
    }
}

// Show the page
$pageTitle = 'Add a Page';
include('includes/header.inc.php');
include('views/add_page.html');
include('includes/footer.inc.php');