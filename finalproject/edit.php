<?php
session_start();
include_once "config.php";
$message = "Edit Your Post";
$displayForm = TRUE;
$table = "guestbook";
//Redirect user to login if not logged in

$lfn->isAllowed();

if(isset($_SESSION['userName'])) {  //Only display form if logged in
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        try {
            $result = $db_handle->getOneRecord($id, $table);

            if ($result) {
                $currentPost = mysqli_fetch_array($result);
                $displayForm = TRUE;
            } else {
                $message = "Unable to retrieve post";
            }
        } catch (Exception $e) {
            echo "Error " . $e;
        }

    }
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    try{

        if($db_handle->updateOneRecord($_POST, $table)){
            $displayForm = FALSE;
            $message= "Post Updated";
        }
    }catch (Exception $e){
        $message = $e->getMessage();
    }


}

function showForm($currentPost){
    ?>
        <form name="guestBook" id="guest_book" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="hidden" name="id" id="id" value="<?= $currentPost['id'] ?>">
        <div>
            <label for="txtName">Name:</label>
            <input name="txtName" id="txtName" value="<?= $currentPost['Name']
            ?>">
        </div>
        <div>
            <label for="txtEmail">Email:</label>
            <input name="txtEmail" id = "txtEmail" value="<?= $currentPost['Email']
            ?>">
        </div>
        <div>
            <label for="txtComment">Comment:</label>
            <textarea name="txtComment" id="txtComment"><?= $currentPost['Comment']
                ?></textarea>
        </div>
        <div>
            <input type="submit" name="submit">
        </div>
        </form>
<?php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guestbook is Bestbook</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
        <?= $lfn->getHeader() ?>
        <?= $lfn->getTopNav() ?>
    <main>
        <h2><?=$message?></h2>

    <?php
    if($displayForm){showForm($currentPost);}
    ?>

    </main>
    <footer>
        <?= $lfn->getFooter() ?>
    </footer>

</body>
</html>