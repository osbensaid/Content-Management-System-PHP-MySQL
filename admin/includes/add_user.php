<?php
if (isset($_POST['add_user'])) {
    $user_firstname = $_POST['firstname'];
    $user_lastname = $_POST['lastname'];
    $user_role = $_POST['role'];
    $user_name = $_POST['username'];
    $user_password = $_POST['password'];
    $user_email = $_POST['email'];

    // Add new user.
    $query = "INSERT INTO users(user_firstname, user_lastname, user_role, user_name, user_password, user_email) ";
    $query .= "VALUES('{$user_firstname}', '{$user_lastname}', '{$user_role}', '{$user_name}', '{$user_password}', '{$user_email}')";

    $create_user_query = mysqli_query($connection, $query);
    if (!$create_user_query) {
        die("Query Failed: " . mysqli_error($connection));
    }

    echo "User Created " . "<a href='users.php'>View Users</a>";
}

?>

<form action="" method="post">

    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input type="text" class="form-control" name="firstname">
    </div>

    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input type="text" class="form-control" name="lastname">
    </div>


    <div class="form-group">
        <label for="role">Role</label>
        <select class="form-control" name="role" id="post_category">
            <option value='subscriber'>Select Options</option>
            <option value='admin'>Admin</option>
            <option value='subscriber'>Subscriber</option>
        </select>
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email">
    </div>


    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="add_user" value="Add User">
    </div>
</form>