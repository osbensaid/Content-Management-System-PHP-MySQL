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

            <!-- <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1> -->
            <?php
            if (isset($_GET["category"])) {
                $category_id = $_GET["category"];
            }
            $query = "SELECT * FROM posts WHERE post_category_id = $category_id";
            $fetch_data = mysqli_query($connection, $query);

            while ($Row = mysqli_fetch_assoc($fetch_data)) {
                $post_id = $Row['post_id'];
                $post_title = $Row['post_title'];
                $post_author = $Row['post_author'];
                $post_date = $Row['post_date'];
                $post_image = $Row['post_image'];
                $post_content = substr($Row['post_content'], 0, 270) . "...";

                ?>
                <!-- Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>

            <?php  } ?>

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