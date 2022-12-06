<?php

session_start();

//Include database connection and functions scripts
include_once "./scripts/db.php";
include_once "./scripts/functs.php";

//1. Register function
if (isset($_POST["registration"])) {
    //Get data from input contols, clear spaces 
    $mail = mysqli_real_escape_string($con, trim($_POST['email']));
    $user = mysqli_real_escape_string($con, trim($_POST['user']));
    $pass = mysqli_real_escape_string($con, trim($_POST['password']));

    $valid = is_valid_data([$mail, $user, $pass]);

    if ($valid != "true") {
        // $row = mysqli_query($con, "SELECT * FROM `users` WHERE email = '$mail' LIMIT 1");
        // // print_r($row);exit(); 
        // if (mysqli_num_rows($row) > 0) {
        //     header("Location:signup.php?err=" . urlencode("Email address is already in use"));
        //     exit();
        // }
        header("Location:signup.php?err=" . urlencode($valid));
        exit();
    } else {
        $otp  = generate_otp();
        $code = generate_link();
        $link = "http://localhost/app/confirm.php?usr=$user&tkn=$code";


        $query = "INSERT INTO users (email,username,`password`, `otp`, `code`) VALUES ('" . $mail . "','" . $user . "','" . $pass . "', '" . $otp . "', '" . $code . "')";
        if (mysqli_query($con, $query)) {
            mysqli_close($con);
            $mc = [
                'subject' => "Email confirmation",
                'body' => "<h1>Hello, <strong>$user</strong></h1>
                    <p>Thank you for registering to MyApplication, Your confirmation code is: <strong>$otp</strong><br>
                    Copy the confirmation code and click on the link below to proceed:<br></p>
                    <a href='$link'> Click to confirm account </a>
                    ",
                'mail' => $mail,
                'user' => $user,
            ];

            if (mail_notify($mc)) {
                header('location:signin.php?msg="' . urlencode("Account was successfully registered, check your email for confirmation"));
            }
        } else {
            header("Location:signup.php?err=" . urlencode("ERROR: Could not able to execute $query" . mysqli_error($con)));
        }
    }
}

//2. Confirm function
if (isset($_POST['confirm'])) {
    //Get data from input contols, clear spaces
    $otp = mysqli_real_escape_string($con, trim($_POST['otp']));
    $user = mysqli_real_escape_string($con, trim($_POST['user']));
    $token = mysqli_real_escape_string($con, trim($_POST['token']));

    // $valid = is_valid_data([$mail,$user,$pass]);
    $query = "SELECT * FROM `users` WHERE username = '$user' AND code = '$token' LIMIT 1";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $row = mysqli_fetch_assoc($result);
        $db_code = $row['otp'];
        $id = $row['id'];
        if ($db_code !== $otp) {
            header("Location:confirm.php?usr=$user&tkn=$token&err=" . urlencode("Invalid token code"));
        } else {
            if ($row['confirmed'] == 0) {
                $sql = "UPDATE users SET confirmed = 1 WHERE (id = '$id'AND otp = '$otp'AND code = '$token')";
                $run =  mysqli_query($con, $sql);
                if ($run) {
                    header('location:signin.php?msg="' . urlencode("Your account was successfully confirmed, signin"));
                } else {
                    header("Location:confirm.php?err=" . urlencode("ERROR: Could not able to execute $query" . mysqli_error($con)));
                }
            } else {
                header('location:signin.php');
            }
        }
    } else {
        header("Location:confirm.php?err=" . urlencode("Please enter a valid token code"));
    }
}

// Login function
if (isset($_POST["auth"])) {
    //Get data from input contols, clear spaces
    $mail = mysqli_real_escape_string($con, trim($_POST['email']));
    $pass = mysqli_real_escape_string($con, trim($_POST['password']));
    $query = "SELECT * FROM `users` WHERE email = '$mail' AND password =" . $pass;
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $row = mysqli_fetch_assoc($result);
        
        if($row['user_type'] == 'user') {
            $_SESSION['user_data'] = $row;
            header("Location:dashboard.php");
        }
        else{
            $_SESSION['user_data'] = $row;
            header("Location:admin.php");
        }
    } else {
        header("Location:signin.php?err=" . urlencode("Invalid login credentials"));
    }
}

// Recover function
if (isset($_POST["recovery"])) {
    //Get data from input contols, clear spaces
    $mail = mysqli_real_escape_string($con, trim($_POST['email']));
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        header("Location:recover.php?err=" . urlencode("Invalid email address"));
    } else {
        $query = "SELECT * FROM `users` WHERE email = '$mail'LIMIT 1";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $row = mysqli_fetch_assoc($result);
            $link = "http://localhost/app/reset.php?mail=".$row['email']."&code=".$row['code'];
            $mc = [
                'subject' => "Reset account",
                'body' => "<h1>Good day, <strong>".$row['username']."</strong></h1>
                    <p>Click the link below to reset your account login cridentials</p>
                    <a href='$link'> Recover account </a>
                    ",
                'mail' => $row['email'],
                'user' => $row['user'],
            ];

            if (mail_notify($mc)) {
                header('location:recover.php?msg="' . urlencode("Recovery link was sent to ".$row['email']));
            }
        } else {
            header("Location:recover.php?err=" . urlencode("This email address does not exist"));
        }
    }
}
