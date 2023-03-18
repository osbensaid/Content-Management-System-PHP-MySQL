<?php
include "includes/header.php";
include "includes/navigation.php";
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome to Dashboard
                    <small><?php echo $_SESSION['username'] ?></small>
                </h1>
            </div>

        </div>


        <div class="row">
            <!-- Chart -->
            <div class="col-lg-5 col-md-6">
                <div id="myChart" style="max-width:700px; height:400px"></div>
            </div>
            <!-- Widgets Cards -->
            <div class="col-lg-7 col-md-6">
                <div class="col-lg-12" style="padding-top: 50px;">
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $query = "SELECT * FROM posts";
                                        $select_all_posts = mysqli_query($connection, $query);
                                        $posts_count = mysqli_num_rows($select_all_posts);

                                        ?>
                                        <div class='huge'><?php echo $posts_count; ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $query = "SELECT * FROM comments";
                                        $select_all_comments = mysqli_query($connection, $query);
                                        $comments_count = mysqli_num_rows($select_all_comments);
                                        ?>
                                        <div class='huge'><?php echo $comments_count; ?></div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
                <div class="col-lg-12">
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $query = "SELECT * FROM users";
                                        $select_all_users = mysqli_query($connection, $query);
                                        $users_count = mysqli_num_rows($select_all_users);
                                        ?>
                                        <div class='huge'><?php echo $users_count; ?></div>
                                        <div>Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $query = "SELECT * FROM categories";
                                        $select_all_categories = mysqli_query($connection, $query);
                                        $categories_count = mysqli_num_rows($select_all_categories);
                                        ?>
                                        <div class='huge'><?php echo $categories_count; ?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $query = "SELECT * FROM users WHERE user_role='Subscriber'";
        $select_all_subscribers = mysqli_query($connection, $query);
        $subscribers_count = mysqli_num_rows($select_all_subscribers);

        $query = "SELECT * FROM users WHERE user_role='Admin'";
        $select_all_admins = mysqli_query($connection, $query);
        $admins_count = mysqli_num_rows($select_all_admins);

        $query = "SELECT * FROM comments WHERE comment_status='Unapproved'";
        $select_pending_comments = mysqli_query($connection, $query);
        $comments_pending_count = mysqli_num_rows($select_pending_comments);

        $query = "SELECT * FROM posts WHERE post_status='Published'";
        $select_active_posts = mysqli_query($connection, $query);
        $active_posts_count = mysqli_num_rows($select_active_posts);

        $query = "SELECT * FROM posts WHERE post_status='Draft'";
        $select_draft_posts = mysqli_query($connection, $query);
        $draft_posts_count = mysqli_num_rows($select_draft_posts);
        ?>
        <script>
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Contry', 'Mhl'],
                    ['Posts', <?php echo $posts_count ?>],
                    ['Draft Posts', <?php echo $draft_posts_count ?>],
                    ['Active Posts', <?php echo $active_posts_count ?>],
                    ['Comments', <?php echo $comments_count ?>],
                    ['Pending Comments', <?php echo $comments_pending_count ?>],
                    ['Users', <?php echo $users_count ?>],
                    ['Admins', <?php echo $admins_count ?>],
                    ['Subcribers', <?php echo $subscribers_count ?>],
                    ['Categories', <?php echo $categories_count ?>],
                ]);

                var options = {
                    title: 'Summary'
                };

                var chart = new google.visualization.PieChart(document.getElementById('myChart'));
                chart.draw(data, options);
            }
        </script>

    </div>
</div>

<?php include "includes/footer.php" ?>