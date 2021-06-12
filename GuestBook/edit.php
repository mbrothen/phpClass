<?php
session_start();
include_once "config.php";
$message = "Edit Your Post";
$displayForm = TRUE;

//Redirect user to login if not logged in
if(!isset($_SESSION['userName'])){
    $displayForm = FALSE;
    $message = "Unable to Edit.  Please <a href='login.php'>Login</>";
}

if(isset($_SESSION['userName'])) {  //Only display form if logged in
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        try {
            $query = "select * from " . TABLE . " where ID=" . $id;
            $result = $conn->query($query);

            if (!$result) {
                $message = " No post retrieved " . $conn->error;
                $conn->close();
                exit();
            } else {
                $currentPost = mysqli_fetch_array($result);
                $displayForm = TRUE;
            }
        } catch (Exception $e) {
            echo "Error " . $e;
        }

    }
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    try{
        // Set form values to vars
        $id =$_POST['id'];
        $name = $_POST["txtName"];
        $email = $_POST["txtEmail"];
        $comment = $_POST["txtComment"];
        $datetime = strtotime("now");

        //Update query
        $updateQuery = "UPDATE ". TABLE ." SET name='$name', email='$email', comment='$comment', Date_Time='$datetime'
               WHERE ID='$id'";

        $update = $conn->query($updateQuery);
        $message = "IN SUBMIT";

        if(!$update){
            $message = "NOT UPDATED";
            echo("Error Updating");
        }
        if($update){

            $message = "Record was updated!";
            // Hide the form
            $displayForm = FALSE;
        }
        else{
            throw new Exception("Something Went wrong");

        }
    }catch (Exception $e){
        $message = $e->getMessage();
    }


}

function showForm($currentPost){
    ?>
        <form name="guestBook" id="guest_book" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="hidden" name="id" id="id" value="<?= $currentPost['ID'] ?>">
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
    <header>
        <?= getHeader() ?>
        <?= getTopNav() ?>
    </header>
    <main>
        <h2><?=$message?></h2>

    <?php
    if($displayForm){showForm($currentPost);}
    ?>

    </main>
    <footer>
        <?= getFooter() ?>
    </footer>

</body>
</html>