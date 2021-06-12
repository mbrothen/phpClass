<?php
include_once "Config.php";
session_start();
$message = 'Hello';
$class_title = '';
$class_descr = '';
$class_cost = '';
$class_instr = '';
$class_start = '';
//Check to see if session retry is "admit."

if (isset($_SESSION["retry"]) && $_SESSION["retry"] == "admit") {
//If so, continue.
    $name = $_SESSION["name"];
} else {
    header("Location: adminAuthen.php");
}

// Create connection
$connection = mysqli_connect(HOST, USER, PASS, DATABASE);
if (!$connection) {
    echo "Cannot connect to MySQL. " . mysqli_connect_error();
    exit();
}



if (isset($_GET["delete_class"])) {
    $query = "DELETE FROM class where class_id = " . $_GET["delete_class"];
    $deleteResult = $connection->query($query);
    echo "Record Deleted";
}
if(isset($_POST['updateClass'])){ //check if form was submitted

    $class_id = $_POST['class_id'];
    $class_title = $_POST['class_title'];
    $class_start = $_POST['class_start'];
    $class_descr = $_POST['class_descr'];
    $class_cost = $_POST['class_cost'];
    $class_instr = $_POST['class_instr'];

    $query = "update class set class_title = '". $class_title. "',  class_start = '" .$class_start ."', class_descr = '"
        .$class_descr."', class_cost=".$class_cost.", class_instr = '".$class_instr."' where class_id = "
        .$class_id ;
    $result = $connection->query($query);
    if ($result) {
        echo "RECORD UPDATED";
    } else {
        echo $query;
    }
}
// Get class list
$listQuery = "select * from class order by class_id desc";
$listResult = $connection->query($listQuery);

// get the class ID from the $_GET, retrieve record from database
if (isset($_GET['class_id'])) {

    $class_id = $_GET['class_id'];
    $query = "SELECT * FROM class WHERE class_id = " . $class_id;
    $result = mysqli_query($connection, $query);
    if (!$result) {
        $message = "ERROR LOADING CLASS DATA";
        echo "FAILED TO LOAD";
    } else {
        $row = mysqli_fetch_object($result);
        $class_title = $row->class_title;
        $class_descr = $row->class_descr;
        $class_cost = $row->class_cost;
        $class_instr = $row->class_instr;
        $class_start = $row->class_start;
        $class_id = $row->class_id;
        //$message = var_dump($row);
    }

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Administrator Registration Page</title>
    <link rel="stylesheet" type="text/css" href="../css/registration.css"/>
    <script language="JavaScript" type="text/javascript"></script>
</head> <!-- Put cursor in the first field -->
<body onload="document.form1.admin_name.focus();"> <!-- From template -->
<div id="wrapper">
    <div id="header"><img src="../images/gatewaylogo.jpg" width="150"/>
        <h1 id="title">Class Selection and Registration</h1>
    </div> <!-- id="header" -->
    <div id="hnav">
        <table width="400" border="0" cellspacing="2" cellpadding="2">
            <tr>
                <td><a href="#">Home</a></td>
                <td><a href="#">About</a></td>
                <td><a href="#">Support </a></td>
                <td><a href="adminAuthen.php"> Maintain</a></td>
            </tr>
        </table>
    </div> <!-- id="hnav" -->


    <div id="vnav">
        <table width="120" border="0" cellspacing="2" cellpadding="2">
            <tr>
                <td id="vhead">Go To:</td>
            </tr>
            <tr>
                <td><a href="classentry.php">Enter New Classes</a></td>
            </tr>
            <tr>
                <td><a href="classUpdate.php">Update & Delete Classes</a>
                </td>
            </tr>
        </table>
    </div> <!-- id="vnav" -->
    <div id="main">
        <h1 id="maintitle">Update or Delete Class</h1> <br/>
        <h1 id="error"><?php $message ?> </h1>
        <div id="classList">
            <h2>Classes</h2>
            <table>
                <thead>
                    <th>Class Title</th>
                    <th>Class Start</th>
                    <th>Class Description</th>
                    <th>Class Cost</th>
                    <th>Class Instructor</th>
                    <th>Edit / Delete</th>
                </thead>
                <tbody>
                <?php
                    while($rs = $listResult->fetch_array()) {$data[] = $rs; }
                    $intCnt = count($data);
                ?>
                <?php for ($iRow=0;$iRow<$intCnt;$iRow++) { ?>
                <tr>
                    <td><?php echo $data[$iRow]["class_title"];?></td>
                    <td><?php echo $data[$iRow]["class_start"];?></td>
                    <td><?php echo $data[$iRow]["class_descr"];?></td>
                    <td><?php echo $data[$iRow]["class_cost"];?></td>
                    <td><?php echo $data[$iRow]["class_instr"];?></td>
                    <td>
                        <a href="classUpdate.php?class_id=<?php echo $data[$iRow]["class_id"];?>">Edit</a>
                        <a href="classUpdate.php?delete_class=<?php echo $data[$iRow]["class_id"];?>">Delete</a>
                    </td>
                </tr>

                <?php } ?>
                </tbody>

            </table>
        </div>


        <div id="form">
            <!-- Display the class create form. -->
            <h2>Update Class</h2>
            <form action="" method="post" id="createClassForm">
                <table width="200" border="0" cellspacing="3" cellpadding="5">
                    <input type="hidden" id="class_id" name="class_id" value="<?php echo $class_id; ?>">
                    <tr>
                        <th width="60">Class Title:</th>
                        <td width="120">
                            <input type="text" name="class_title" value="<?php echo $class_title; ?>" size="60"/></td>
                    </tr>
                    <tr>
                        <th>Class Start:</th>
                        <td><input type="date" name="class_start" value="<?php echo $class_start; ?>" size="20"
                            /></td>
                    </tr>
                    <tr>
                        <th>Class Description:</th>
                        <td><textarea name="class_descr" value="" cols="56"
                                      rows="6"><?php echo $class_descr; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>Class Cost:</th>
                        <td><input type="number" min="0.01" step="0.01" max="999999.99" name="class_cost"
                                   size="10" value="<?php echo $class_cost; ?>"/></td>
                    </tr>
                    <tr>
                        <th>Class Instructor:</th>
                        <td><input type="text" name="class_instr" value="<?php echo $class_instr; ?>" size="20" /> </td>
                    </tr>
                </table>
                <input type="submit" name="updateClass" value="Update Class"/>
            </form>
        </div> <!-- id="main" -->

        <div id="footer">
            <p id="copyright">Copyright &copy
                <?php
                date_default_timezone_set('America/Chicago');
                echo date('Y');
                ?>

        </div> <!-- id="footer" -->
    </div> <!-- id="wrapper" --> </body>
</html>