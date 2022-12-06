<?php

session_start();

//Include database connection and functions scripts
include_once "./../scripts/db.php";

if (isset($_POST["getUser"])) {
    $query = "SELECT * FROM `users`";
    $result = mysqli_query($con, $query);

    $out = '<tbody>';
    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_array($result)) {
            $out .= '<tr class="">
                <td scope="row">' . $row['username'] . '</td>
                <td>' . $row['email'] . '</td>
                <td>' . $row['user_type'] . '</td>
                <td>
                    <a class="btn btn-danger btn-sm btnDelete" type="button" href="#" data-id="' . $row["id"] . '">
                        <i class="fa-solid fa-trash fa-fw"></i> DELETE
                    </a>
                </td>
            </tr>';
        }
    } else {
        echo "<tr><td>No record Found int the database.</td></tr>";
    }

    $out .= '</tbody>';
    echo $out;
}

if (isset($_POST["searchUser"])) {
    $key = $_POST['key'];
    $query = "SELECT * FROM `users` WHERE `email` LIKE '%".$_POST['key']."%'";
    $result = mysqli_query($con, $query);

    $out = '<tbody>';
    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_array($result)) {
            $out .= '<tr class="">
                <td scope="row">' . $row['username'] . '</td>
                <td>' . $row['email'] . '</td>
                <td>' . $row['user_type'] . '</td>
                <td>
                    <a class="btn btn-danger btn-sm" type="button" href="#" data-id="' . $row["user_type"] . '">
                        <i class="fa-solid fa-trash fa-fw"></i> DELETE
                    </a>
                </td>
            </tr>';
        }
    } else {
        echo "<tr><td>No record matches <kbd>".$_POST['key']."</kbd> Found int the database.</td></tr>";
    }

    $out .= '</tbody>';

    echo $out;
}

if (isset($_POST["deleteUser"])) {
    $query = "DELETE FROM `users` WHERE `users`.`id` = ".$_POST['id'];
    $result = mysqli_query($con, $query);

    if ($result = mysqli_query($con, $query)) {
        echo 'User information was successfully removed from database';
    } else {
        echo "Oooops!, Something went wrong while removing";
    }


}
