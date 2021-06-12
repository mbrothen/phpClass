<?php
include_once "config.php";
include "includes/header.php";
include "includes/classes/User.php";
include "includes/classes/Post.php";

if(isset($_POST['submit_post'])){
    $post = new Post($conn, $userLoggedIn);
    $post->submitPost($_POST['post_text'], 'none');
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
        <textarea name="post_text" id="post_text" placeholder="Chirp It"></textarea>
        <input type="submit" name="submit_post" value="Post">
    </form>

    <?php
    $post = new Post($conn, $userLoggedIn);
    $post->loadPostsFriends();
    ?>

</div>

</div>
</body>
</html>