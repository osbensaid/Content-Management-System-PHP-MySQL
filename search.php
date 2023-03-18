<?php
include "includes/db.php";
/* Page Header and navigation */
include "includes/header.php";
include "includes/navigation.php";
?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php
            if (isset($_POST['submit'])) {
                $search =  $_POST['search'];
                $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
                $fetch_data = mysqli_query($connection, $query);
                if (!$fetch_data) {
                    die("QUERY FAILED " . mysqli_error($connection));
                }

                $count = mysqli_num_rows($fetch_data);

                if ($count == 0) {
                    echo "<h2>No Content Found</h2>";
                } else {
                    while ($Row = mysqli_fetch_assoc($fetch_data)) {
                        $post_title = $Row['post_title'];
                        $post_author = $Row['post_author'];
                        $post_date = $Row['post_date'];
                        $post_image = $Row['post_image'];
                        $post_content = $Row['post_content'];

                        ?>
                        <!-- Blog Post -->
                        <h2>
                            <a href="#"><?php echo $post_title ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="<?php echo $post_title ?>">
                        <hr>
                        <p><?php echo $post_content ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                        <hr>

            <?php  }
                }
            } ?>

        </div>


        <?php
        include "includes/sidebar.php"
        ?>
    </div>
    <!-- /.row -->

    <hr>
    <?php
    /* Page Footer */
    include "includes/footer.php"
    ?>