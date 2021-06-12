<?php
include "config.php";
include "includes/classes/User.php";
include "includes/classes/Post.php";

if(isset($_GET['postid'])){
    $username = $_SESSION['username'];
    $postid = $_GET['postid'];
    $post = new Post($conn,$username);

    if($post->deletePost($postid)){
        $_SESSION['statusMSG'] = "Post Deleted";
    } else {
        $_SESSION['statusMSG'] = "Unable to delete post";
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}