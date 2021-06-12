<?php


class Post
{
    private $user_obj;
    private $conn;
    public function __construct($conn, $user) {
        $this->conn = $conn;
        $this->user_obj = new User($conn, $user);
        $user_details_query = mysqli_query($conn, "SELECT * FROM users WHERE username='$user'");
        $this->user = mysqli_fetch_array($user_details_query);

    }
public function submitPost($body, $user_to) {
        $body = strip_tags($body);
        $body = mysqli_real_escape_string($this->conn, $body);
        $body = nl2br($body);
        $body = str_replace('\r\n', '\n', $body);
        $check_empty = preg_replace('/\s+/', '', $body);

        if($check_empty !="") {
            $date_added = date("Y-m-d H:i:s");
            $added_by = $this->user_obj->getUsername();

            if($user_to == $added_by){
                $user_to = "none";
            }

            //insert post
            $query = mysqli_query($this->conn, "INSERT INTO posts VALUES (null, '$body', '$added_by', '$user_to', '$date_added', 'no', 'no', '0')");
            $returned_id = mysqli_insert_id($this->conn);
            echo mysqli_error($this->conn);
            //Update post count
            $num_posts = $this->user_obj->getNumPosts();
            $num_posts++;
            $update_query = mysqli_query($this->conn, "UPDATE users SET num_posts='$num_posts' WHERE username='$added_by'");

        }
}

public function loadPostsFriends() {
        $str = "";
        $data = mysqli_query($this->conn, "SELECT * FROM posts WHERE deleted ='no' ORDER BY id DESC");

        while($row = mysqli_fetch_array($data)){
            echo mysqli_error($this->conn);
            $username = $_SESSION['username'];
            $id = $row['id'];
            $body = $row['body'];
            $added_by = $row['added_by'];
            $date_time = $row['date_added'];

            if($row['user_to'] == 'none'){

                $user_to = '';
            } else {
                $user_to_obj = new User($conn, $row['user_to']);
                $user_to_name = $user_to_obj->getFirstAndLastName();
                $user_to = "to <a href='".$row['user_to'] . "'>" . $user_to_name . "</a>";

            }

            $added_by_obj = new User($this->conn, $row['added_by']);
            if($added_by_obj->isClosed()) {
                continue;
            }
            $user_details_query = mysqli_query($this->conn, "SELECT first_name, last_name, profile_pic FROM users WHERE username='$added_by'");
            $user_row = mysqli_fetch_array($user_details_query);
            echo mysqli_error($this->conn);
            $first_name = $user_row['first_name'];
            $last_name = $user_row['last_name'];
            $profile_pic = $user_row['profile_pic'];

            $date_time_now = date("Y-m-d H:i:s");
            $start_date = new DateTime($date_time);
            $end_date = new DateTime($date_time_now);
            $interval = $start_date->diff($end_date);

            // Find age of post
            if($interval->y >=1) {
                if($interval == 1)
                    $time_message = $interval->y . " a year ago";
                else
                    $time_message = $interval->y . " years ago";
            } else if ($interval->m >= 1) {
                if($interval->d == 0) {
                    $days = " ago";
                } else if ($interval->d == 1) {
                    $days = $interval->d . " day ago";
                } else {
                    $days = $interval->d . " days ago";
                }

                if($interval-> m == 1) {
                    $time_message = $interval->m . " month" . $days;
                } else {
                    $time_message = $interval->m . " months". $days;
                }
            }  else if ($interval->d >= 1) {
                if ($interval->d == 1) {
                    $time_message = "Yesterday";
                } else {
                    $time_message = $interval->d . " days ago";
                }
            } else if ($interval->h >= 1) {
                if ($interval->d == 1) {
                    $time_message = $interval->h . " hour ago";
                } else {
                    $time_message = $interval->h . " hours ago";
                }
            }else if ($interval->i >= 1) {
                if ($interval->i == 1) {
                    $time_message = $interval->i . " minute ago";
                } else {
                    $time_message = $interval->i . " minutes ago";
                }
            } else if ($interval->s >= 1) {
                if ($interval->s < 30) {
                    $time_message = "Just now";
                } else {
                    $time_message = $interval->s . " seconds ago";
                }
            } else {
                $time_message = "Just now";
            }
        $str .= "<div class='status_post'>
                    <div class ='post_profile_pic'>
                        <img src='$profile_pic' width ='50'>
                        </div>
                        <div class='posted_by' style='color:#ACACAC;'>
                            <a href='profile.php?username=$added_by'>$first_name $last_name</a> $user_to &nbsp;&nbsp;&nbsp;&nbsp;$time_message
                        </div>
                        <div id='post_body'>
                            $body
                            <br>
                        </div>";
            if($username == $added_by) {
                $str .= "
                <a href='edit.php?postid=". $id . "'>Edit Post</a>
                <a href='delete.php?postid=". $id . "'>Delete Post</a>";
            }
            $str.= "                        
                    </div>
                    
                    <hr>
                    ";

        }
        echo $str;
}

    public function loadUserPosts($username) {
        $str = "";
        $data = mysqli_query($this->conn, "SELECT * FROM posts WHERE (deleted ='no') AND (added_by = '$username') ORDER BY id DESC");

        while($row = mysqli_fetch_array($data)){
            echo mysqli_error($this->conn);
            $username = $_SESSION['username'];
            $id = $row['id'];
            $body = $row['body'];
            $added_by = $row['added_by'];
            $date_time = $row['date_added'];

            if($row['user_to'] == 'none'){

                $user_to = '';
            } else {
                $user_to_obj = new User($conn, $row['user_to']);
                $user_to_name = $user_to_obj->getFirstAndLastName();
                $user_to = "to <a href='".$row['user_to'] . "'>" . $user_to_name . "</a>";

            }

            $added_by_obj = new User($this->conn, $row['added_by']);
            if($added_by_obj->isClosed()) {
                continue;
            }
            $user_details_query = mysqli_query($this->conn, "SELECT first_name, last_name, profile_pic FROM users WHERE username='$added_by'");
            $user_row = mysqli_fetch_array($user_details_query);
            echo mysqli_error($this->conn);
            $first_name = $user_row['first_name'];
            $last_name = $user_row['last_name'];
            $profile_pic = $user_row['profile_pic'];
            $date_time_now = date("Y-m-d H:i:s");
            $start_date = new DateTime($date_time);
            $end_date = new DateTime($date_time_now);
            $interval = $start_date->diff($end_date);

            // Find age of post
            if($interval->y >=1) {
                if($interval == 1)
                    $time_message = $interval->y . " a year ago";
                else
                    $time_message = $interval->y . " years ago";
            } else if ($interval->m >= 1) {
                if($interval->d == 0) {
                    $days = " ago";
                } else if ($interval->d == 1) {
                    $days = $interval->d . " day ago";
                } else {
                    $days = $interval->d . " days ago";
                }

                if($interval-> m == 1) {
                    $time_message = $interval->m . " month" . $days;
                } else {
                    $time_message = $interval->m . " months". $days;
                }
            }  else if ($interval->d >= 1) {
                if ($interval->d == 1) {
                    $time_message = "Yesterday";
                } else {
                    $time_message = $interval->d . " days ago";
                }
            } else if ($interval->h >= 1) {
                if ($interval->d == 1) {
                    $time_message = $interval->h . " hour ago";
                } else {
                    $time_message = $interval->h . " hours ago";
                }
            }else if ($interval->i >= 1) {
                if ($interval->i == 1) {
                    $time_message = $interval->i . " minute ago";
                } else {
                    $time_message = $interval->i . " minutes ago";
                }
            } else if ($interval->s >= 1) {
                if ($interval->s < 30) {
                    $time_message = "Just now";
                } else {
                    $time_message = $interval->s . " seconds ago";
                }
            } else {
                $time_message = "Just now";
            }
            $str .= "<div class='status_post'>
                    <div class ='post_profile_pic'>
                        <img src='$profile_pic' width ='50'>
                        </div>
                        <div class='posted_by' style='color:#ACACAC;'>
                            <a href='profile.php?username=$added_by'>$first_name $last_name</a> $user_to &nbsp;&nbsp;&nbsp;&nbsp;$time_message
                        </div>
                        <div id='post_body'>
                            $body
                            <br>
                        </div>";
            if($username == $added_by) {
                $str .= "
                <a href='edit.php?postid=". $id . "'>Edit Post</a>
                <a href='delete.php?postid=". $id . "'>Delete Post</a>";
            }
            $str.= "                        
                    </div>
                    
                    <hr>
                    ";

        }
        echo $str;
    }

    public function deletePost($post){
        $delete_query = mysqli_query($this->conn, "DELETE FROM posts WHERE id='$post'");
        if($delete_query){
            return true;
        }
        return false;

    }

    public function getPost($post){
        $get_post_query = mysqli_query($this->conn, "SELECT * FROM posts WHERE id='$post'");
        while($row = mysqli_fetch_array($get_post_query)){
            return $row['body'];
        }
        return false;
    }

    public function updatePost($body, $postid) {$body = strip_tags($body);
        $body = mysqli_real_escape_string($this->conn, $body);
        $body = nl2br($body);
        $body = str_replace('\r\n', '\n', $body);
        $check_empty = preg_replace('/\s+/', '', $body);


            $update_post_query = mysqli_query($this->conn, "UPDATE posts SET body='$body' WHERE id='$postid'");
            echo mysqli_error($this->conn);

            if ($update_post_query) {
                echo mysqli_error($this->conn);
                return true;
            }
            return false;

        return false;
    }
}

