<?php
include_once "config.php";
include "includes/header.php";
include "includes/classes/User.php";
include "includes/classes/Post.php";

if(isset($_GET['username'])){
    $username = $_GET['username'];
    $user_details_query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    $user_array = mysqli_fetch_array($user_details_query);
    $num_friends = substr_count($user_array['friend_array'], ",") -1;
}
?>

<div class="profile_left">
    <img src="<?php echo $user_array['profile_pic'];?>">
    <div class="profile_info">
        <p><?php echo "Posts: " . $user_array['num_posts'];?></p>
        <p><?php echo "Likes: " . $user_array['num_likes'];?></p>
        <p><?php echo "Friends: " . $num_friends;?></p>

    </div>
</div>

<div class="main_column column">

        <?php
        if($username) {
            $post = new Post($conn, $username);
            $post->loadUserPosts($username);
        }
        ?>

    </div>
