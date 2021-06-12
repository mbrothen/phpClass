
<?php
session_start();
include_once "include\config.php";

$tasks = $db->getAllRecords(TABLE_TASKS);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Maintenance Master</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div>
    <?= $lfn->getHeader() ?>
    <?= $lfn->getTopNav() ?>
    <?= $lfn->getAdminNav() ?>
    <main>
        <h1>Admin Panel</h1>
        <?php
        if(!isset($_SESSION['userName']) || ($_SESSION['user_role'] != 'admin')){
            // Redirect people not logged in or an admin
            header("Location: index.php");
            //$lfn->loginRegPrompt();
        } else {


        while($rs = $tasks->fetch_array()) { $data[] = $rs; }

        $intCnt = count($data);
        ?>
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
        foreach($rs['room'] as $room) {
            ?><th><?php echo $room; ?></th> <?php
            for ($iRow=0; $iRow<$intCnt; $iRow++) { ?>
                <tr>
                    <td><?php echo $data[$iRow]['task_room'];?></td>
                    <td><?php echo $data[$iRow]['task_name'];?></td>
                    <td><?php echo $data[$iRow]['task_description'];?></td>
                    <td><?php echo $data[$iRow]['task_type'];?></td>
                    <td><?php echo $data[$iRow]['task_schedule'];?></td>
                    // Make this its own table and pull where id =?
                    // Add a second loop and make them a list in the table?
                    //  This is to modify the tasks, add a link to edit tasks and then post?

                    <td><?php echo $data[$iRow]['task_links'];?></td>
                </tr>
            <?php }
        }
        }
/*
        for($iRow=0;$iRow<$intCnt;$iRow++) { ?>
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
        <?php */ ?>
        </tbody>
        </table>


        }
        ?>
    </main>
    <footer>
        <?= $lfn->getFooter() ?>
    </footer>
</div>
</body>
</html>