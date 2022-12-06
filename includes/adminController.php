<?php

session_start();

//Include database connection and functions scripts
include_once "./../scripts/db.php";

if(isset($_POST["getUser"])){
    $query = "SELECT * FROM `users`";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $out ='';
        // while ($row = mysqli_fetch_array($result))
        // {
        //     $out .= '<tr class="">
        //     <td scope="row">'.$row['username'].'</td>
        //     <td>'.$row['email'].'</td>
        //     <td>'.$row['user_type'].'</td>
        //     <td>'.$row['user_type'].'</td>
        // </tr>';
        // }
        echo "<tr><td>User </td></tr><br/><tr><td></td></tr><br/><tr><td>List</td></tr>";
        // echo $row['email'];
        // echo '<tr class="">
        //         <td scope="row">'.$row['username'].'</td>
        //         <td>'.$row['email'].'</td>
        //         <td>'.$row['user_type'].'</td>
        //         <td>'.$row['user_type'].'</td>
        //     </tr>';
    }
    else {
    echo 0;
}

}

if(isset($_POST["searchUser"])){
    $key = $_POST['key'];
    $query = "SELECT * FROM `users` WHERE `email` =".$key;
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo $row['email'];
    }
    else{
        echo 0;
    }

}
?>