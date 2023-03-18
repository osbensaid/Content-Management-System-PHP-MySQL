<?php
include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php";

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($email) && !empty($password)) {
        // Escape special characters in a string.
        $username = mysqli_real_escape_string($connection, $username);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);

        $query = "SELECT randSalt FROM users ORDER BY user_id DESC LIMIT 1";
        $select_randSalt = mysqli_query($connection, $query);

        if (!$select_randSalt) {
            die("Query Failed: " . mysqli_error($connection));
        }

        $Row = mysqli_fetch_assoc($select_randSalt);
        $salt = $Row['randSalt'];

        // Engrypt Password.
        $password = crypt($salt, $password);

        $query = "INSERT INTO users (user_name, user_email, user_password, user_role)";
        $query .= "VALUES('{$username}','{$email}', '{$password}', 'Subscriber' )";
        $register_user_query = mysqli_query($connection, $query);
        if (!$register_user_query) {
            die("QUERY FAILED " . mysqli_error($connection));
        }
        $message = "<p class='alert alert-success'>Your registration has been submitted.</p>";
    } else {
        $message = "<p class='alert alert-danger'>Fields connot be empty.</p>";
    }
} else {
    $message = "";
}
?>


<!-- Page Content -->
<div class="container">
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <h6 class="text-center"><?php echo $message ?></h6>
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>