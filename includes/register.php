<?php
// Start session
session_start();

//Include database connection and functions scripts
include_once "./scripts/db.php";
include_once "./scripts/functs.php";

// If register is set
if (isset($_POST["register"])) {

    //Get data from input contols, clear spaces and strip slashes
    $mail = stripslashes(trim(mysqli_real_escape_string($con, $_POST['email'])));
    $user = stripslashes(trim(mysqli_real_escape_string($con,$_POST['user'])));
    $pass = stripslashes(trim(mysqli_real_escape_string($con,$_POST['password'])));

    $otp  = generate_otp();
    $code = generate_link();
    $link = "confirm.php?email=$mail&code=$code";

    // Check validity of an email, and lenght of password and password fields
    if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
        header("Location:signup.php?err=" . urlencode("Please enter a valid email address"));
        exit();
    }elseif(strlen($user)<2){
        header("Location:signup.php?err=" . urlencode("Username must be at least 2 characters"));
        exit();
    }elseif(strlen($pass)<6){
        header("Location:signup.php?err=" . urlencode("Password must be at least 6 characters"));
        exit();
    }
    else{
        //Insert query string
        
        $query = "INSERT INTO users (email,username,`password`, `otp`, `code`) VALUES ('".$mail."','".$user."','".md5($pass)."', '".$otp."', '".$code."')";
        if(mysqli_query($con, $query)){
            mysqli_close($con);
            // echo send_mail();
            header('location:'.$link."&success='Your account was successfully created and one time pin(OTP) token was sent to $mail'");
        } else{
            header("Location:register.php?err=" . urlencode("ERROR: Could not able to execute $query".mysqli_error($con)));
        }
    }
}
?>