<?php
session_start();
?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">CMS Blog</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                $query = "SELECT * FROM categories";
                $fetch_data = mysqli_query($connection, $query);
                while ($Row = mysqli_fetch_assoc($fetch_data)) {
                    $cat_title = $Row['cat_title'];
                    $cat_id = $Row['cat_id'];
                    echo "<li><a href='category.php?category=$cat_id'>$cat_title</a></li>";
                }

                ?>
                <li><a href='admin'>Admin</a></li>
                <li><a href='registration.php'>Registration</a></li>
                <?php

                if (isset($_SESSION['role'])) {
                    if (isset($_GET['p_id'])) {
                        $the_post_id = $_GET['p_id'];
                        echo "<li><a href='admin/posts.php?source=edit_post&p_id=$the_post_id'>Edit Post</a></li>";
                    }
                }
                ?>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>