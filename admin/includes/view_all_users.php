<?php
// Delete User.
if (isset($_GET["delete"])) {
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == "Admin") {
            $user_id = mysqli_real_escape_string($connection, $_GET['delete']);
            $query = "DELETE FROM users WHERE user_id=$user_id";
            $delete_query = mysqli_query($connection, $query);
            header("Location: users.php");
            if (!$delete_query) {
                die("Query Failed: " . mysqli_error($connection));
            }
        }
    }
}

// Change user to Admin.
if (isset($_GET["change_to_admin"])) {
    $user_id = $_GET['change_to_admin'];
    $query = "UPDATE users SET user_role='Admin' WHERE user_id=$user_id";
    $update_query = mysqli_query($connection, $query);
    header("Location: users.php");
    if (!$update_query) {
        die("Query Failed: " . mysqli_error($connection));
    }
}

// Change user to Subscriber.
if (isset($_GET["change_to_subscriber"])) {
    $user_id = $_GET['change_to_subscriber'];
    $query = "UPDATE users SET user_role='Subscriber' WHERE user_id=$user_id";
    $update_query = mysqli_query($connection, $query);
    header("Location: users.php");
    if (!$update_query) {
        die("Query Failed: " . mysqli_error($connection));
    }
}

?>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM users";
        $fetch_posts_data = mysqli_query($connection, $query);
        while ($Row = mysqli_fetch_assoc($fetch_posts_data)) {

            $user_id = $Row['user_id'];
            $user_name = $Row['user_name'];
            $user_firstname = $Row['user_firstname'];
            $user_lastname = $Row['user_lastname'];
            $user_email = $Row['user_email'];
            $user_role = $Row['user_role'];
            $user_date = date('Y-m-d');;

            echo "<tr>
                    <td>$user_id</td>
                    <td>$user_name</td>
                    <td>$user_firstname</td>
                    <td>$user_lastname</td>
                    <td>$user_email</td>
                    <td>$user_role</td>
                    <td>$user_date</td>
                    <td><a href='users.php?change_to_admin=$user_id'>Admin</a></td>
                    <td><a href='users.php?change_to_subscriber=$user_id'>Subscriber</a></td>
                    <td><a href='users.php?source=edit_user&user_id=$user_id'>Edit</a></td>
                    <td><a onClick=\"javascript: return confirm('Are you sure you want to delete'); \" href='users.php?delete=$user_id'>Delete</a></td>
                </tr>";
        }
        ?>
    </tbody>
</table>