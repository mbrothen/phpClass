<?php
session_start();
require_once("config.php");

$data = array();
$table = 'guestbook';
$result = $db_handle->getAllRecords($table);


//Print guestbook

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guestbook is Bestbook</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div>
        <?= $lfn->getHeader() ?>
        <?= $lfn->getTopNav() ?>

<main>
<table> <!--cellpadding="10" cellspacing="0"-->
    <thead>
        <th>Number</th>
        <th>Name</th>
        <th>Email</th>
        <th>Comment</th>
        <th>Time</th>
        <th>Edit/Delete</th>
    </thead>
    <tbody>
    <?php
    while($rs = $result->fetch_array()) { $data[] = $rs; }

    $intCnt = count($data);
    ?>
    <?php for($iRow=0;$iRow<$intCnt;$iRow++) { ?>
    <tr>
        <td><?php echo $data[$iRow]["id"];?></td>
        <td><?php echo $data[$iRow]["Name"];?></td>
        <td> <?php echo $data[$iRow]["Email"];?></td>
        <td> <?php echo $data[$iRow]["Comment"];?></td>
        <td> <?php echo date("m-d-y H:i",$data[$iRow]["Date_Time"]);?></td>
        <td>
            <ul>
                <li><a href="edit.php?id=<?php echo $data[$iRow]["id"];?>">Edit</a></li>
                <li><a href="delete.php?id=<?php echo $data[$iRow]["id"];?>">Delete</a></li>
            </ul>
        </td>
    </tr>
    <?php } ?>
    </tbody>
</table>
    </main>
    <footer>
        <?= $lfn->getFooter() ?>
    </footer>
</div>
</body>
</html>
<?php
?>
