<?php

// Error Vars
$fname = "";
$lname = "";
$email = "";
$email2 = "";
$password = "";
$password2 = "";
$date = "";
$error_array = array();


//Handle Reg Form
if(isset($_POST['register_button'])) {

//VALIDATION ------------------
    //First Name
    $fname = strip_tags($_POST['reg_fname']);
    $fname = str_replace(' ', '', $fname);  // Strip space
    $fname = ucfirst(strtolower($fname));    // Cap first letter only
    $_SESSION['reg_fname'] = $fname;
    //Last name
    $lname = strip_tags($_POST['reg_lname']);
    $lname = str_replace(' ', '', $lname);  // Strip space
    $lname = ucfirst(strtolower($lname));    // Cap first letter only
    $_SESSION['reg_lname'] = $lname;
    //Email
    $email = strip_tags($_POST['reg_email']);
    $email = str_replace(' ', '', $email);  // Strip space
    $email = ucfirst(strtolower($email));    // Cap first letter only
    $_SESSION['reg_email'] = $email;

    //Email 2
    $email2 = strip_tags($_POST['reg_email2']);
    $email2 = str_replace(' ', '', $email2);  // Strip space
    $email2 = ucfirst(strtolower($email2));    // Cap first letter only
    $_SESSION['reg_email2'] = $email2;

    //Passsword
    $password = strip_tags($_POST['reg_password']);

    //Password 2
    $password2 = strip_tags($_POST['reg_password2']);

    $date = date("Y-m-d");

    if($email == $email2) {
        //Check valid
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);

            // Check if email in use
            $query = "SELECT email FROM users WHERE email='$email'";
            $email_check = mysqli_query($conn, $query);
            echo mysqli_error($conn);
            $num_rows = mysqli_num_rows($email_check);

            if ($num_rows > 0) {
                array_push($error_array, "Email already in use<br>") ;
            }
        }else {
            array_push($error_array,  "Invalid Email<br>");
        }
    } else {
        array_push($error_array, "Emails don't match<br>");
    }

    // Validate first name
    if(strlen($fname > 60) || strlen($fname) < 2){
        array_push($error_array, "First name must be between 2 and 60 characters<br>");
    }

    // Validate last name
    if(strlen($lname > 60) || strlen($lname) < 2){
        array_push($error_array, "Last name must be between 2 and 60 characters<br>");
    }

    if($password != $password2){
        array_push($error_array, "Passwords do not match<br>");
    } else {
        if(preg_match('/[^A-Za-z0-9]/', $password)){

        }
    }
    if(strlen($password) > 30 || strlen($password) < 5){
        array_push($error_array, "Password must be between 5 and 30 characters<br>");
    }


// END VALIDATION ---------------------
    if(empty($erro_array)){
        $password = md5($password);
        $username = strtolower($fname . "_" . $lname);
        $check_username = mysqli_query($conn, "SELECT username FROM users WHERE username ='$username'");
        $i = 0;
        // If username exists add number
        while(mysqli_num_rows($check_username)!=0) {
            $i++;
            $username = $username . "_" . $i;
            $check_username = mysqli_query($conn, "SELECT username FROM users WHERE username ='$username'");
        }

        $profile_pic = "assets/profile_pictures/generic_profile_picture.png";

        $query = mysqli_query($conn, "INSERT INTO users VALUES (null, '$fname', '$lname', '$username', '$email', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");

        echo mysqli_error($conn);

        array_push($error_array, "<span>Registeration Successful <br> Please Login </span>");

        // Clear Form
        $_SESSION['reg_fname'] = "";
        $_SESSION['reg_lname'] = "";
        $_SESSION['reg_email'] = "";
        $_SESSION['reg_email2'] = "";
    }

}
?>