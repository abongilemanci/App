<?php
// Start session
session_start();

//Include database connection and functions scripts
include_once "./scripts/db.php";
// include_once "./scripts/functions.php";

// If register is set
if (isset($_POST["sign"])) {

    //Get data from input contols
    $mail = trim(mysqli_real_escape_string($con, $_POST['email']));
    $pass = trim(mysqli_real_escape_string($con,$_POST['password']));

    
    //Insert query string
    
    // $query = "INSERT INTO 
    //         `users` (`email`, `username`, `password`, `otp`, `code`, `user_type`, `active`, `confirmed`) 
    //         VALUES (".$mail.", ".$user.", ".md5($pass).", ".$otp.", ".$code.", '3', '1', '0')";
    $query = "SELECT * FROM `users` WHERE email = '$mail' AND password = '$pass'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_data'] = $row;
        header("Location:index.php?success=".$row);
    } else {
        header("Location:login.php?err=" . urlencode("Invalid login credentials"));
    }

    mysqli_close($con);
    
}

function user_session($r){

}



?>