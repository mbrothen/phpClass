<?php
/*
 *
 * This is not used in the project.  This is only for relearning mysqli connections and kept as reference
 *
 *
 */
define("HOST", "apollo.gtc.edu");
define("USER", "brothenm2");
define("PASS", "password");
define("DB", "brothenm2_guestbook");

$conn = mysqli_connect(HOST, USER, PASS);

if (mysqli_connect_errno()) {
    echo "<p>Connection Error: " . mysqli_connect_error() . "</p>\n";
} else {
    if (@mysqli_select_db(DB, $conn) === FALSE) {
        echo "Error! " . mysqli_connect_error();
        echo "<p>Could not select the \" DB\" " . "database: " . myqli_error($conn) . "</p>\n";
        // Initialize database
        $sql = "CREATE DATABASE " . DB;
        if ($conn->query($sql) === TRUE) {
            echo "Database created successfully";
        } else {
            echo "Error creating database: " . $conn->error;
        }
    }
    else
    {
        echo "Connected";
    }
}
mysqli_close($conn);
$conn = FALSE;

