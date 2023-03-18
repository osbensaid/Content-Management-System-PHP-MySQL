<?php
include "db.php";
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE user_name='$username'";
    $select_user_query = mysqli_query($connection, $query);
    if (!$select_user_query) {
        die("Query Failed: " . mysqli_error($connection));
    }


    if (empty($username) || empty($password)) {
        header("Location: ../index.php");
    } else {
        while ($Row = mysqli_fetch_array($select_user_query)) {
            $user_id = $Row['user_id'];
            $user_role = $Row['user_role'];
            $user_name = $Row['user_name'];
            $user_firstname = $Row['user_firstname'];
            $user_lastname = $Row['user_lastname'];
            $user_password = $Row['user_password'];

            // Engrypt Password.
            $password = crypt($user_password, $password);

            if ($username === $user_name || $password === $user_password) {
                $_SESSION['username'] = $user_name;
                $_SESSION['firstname'] = $user_firstname;
                $_SESSION['lastname'] = $user_lastname;
                $_SESSION['role'] = $user_role;
                header("Location: ../admin/index.php");
            } else {
                header("Location: ../index.php");
            }
        }
    }
}
