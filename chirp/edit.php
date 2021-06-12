<?php
include_once "config.php";
include "includes/header.php";
include "includes/classes/User.php";
include "includes/classes/Post.php";

if(isset($_GET['postid'])){
    $username = $_SESSION['username'];
    $postid = $_GET['postid'];
    $_SESSION['postid'] = $postid;
    $post = new Post($conn,$username);

    if($editPost = $post->getPost($postid)){

        $editText = $editPost;
    } else {
        $_SESSION['statusMSG'] = "Unable to edit post";
    }

    //header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if(isset($_POST['edit_post'])){
    $post = new Post($conn, $userLoggedIn);
    if(isset($_SESSION['postid'])) {
        $postid = $_SESSION['postid'];
        if($post->updatePost($_POST['post_text'], $postid)){
            $_SESSION['statusMSG'] = "Post Updated";
        } else {
            $_SESSION['statusMSG'] = "Unable to update post";
        }
    }
    else {
        $_SESSION['statusMSG'] = "Unable to edit post";
    }
    #header("Location: index.php");
}

?>
<div class ="user_details column">
    <a href="#"><img src="<?php echo $user['profile_pic']; ?>"</a>
    <div class="user_details_right">
        <a href="#">
            <?php
            echo $user['first_name'] . ' ' . $user['last_name'];
            ?></a><br>
        <a href="#">
            <?php
            echo 'Posts: ' . $user['num_posts'];
            ?></a><br>
        <a href="#">
            <?php
            echo 'Likes: ' . $user['num_likes'];
            ?></a><br>
    </div>
</div>
<div class="main_column column">
    <form class="post_form" action="index.php" method="post">
        <textarea name="post_text" id="post_text"><?php echo $editText; ?></textarea>
        <input type="submit" name="edit_post" value="Update">
    </form>

</div>

</div>
</body>
</html>