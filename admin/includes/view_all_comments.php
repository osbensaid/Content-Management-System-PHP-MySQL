<?php
// Delete Comment.
if (isset($_GET["delete"])) {
    $comment_id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id=$comment_id";
    $delete_query = mysqli_query($connection, $query);
    header("Location: comments.php");
    if (!$delete_query) {
        die("Query Failed: " . mysqli_error($connection));
    }
}

// Approve a Comment.
if (isset($_GET["unapproved"])) {
    $comment_id = $_GET['unapproved'];
    $query = "UPDATE comments SET comment_status='Approved' WHERE comment_id=$comment_id";
    $update_query = mysqli_query($connection, $query);
    header("Location: comments.php");
    if (!$delete_query) {
        die("Query Failed: " . mysqli_error($connection));
    }
}

// Unapprove a Comment.
if (isset($_GET["approved"])) {
    $comment_id = $_GET['approved'];
    $query = "UPDATE comments SET comment_status='Unapproved' WHERE comment_id=$comment_id";
    $update_query = mysqli_query($connection, $query);
    header("Location: comments.php");
    if (!$delete_query) {
        die("Query Failed: " . mysqli_error($connection));
    }
}

?>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM comments ORDER BY comment_id DESC";
        $fetch_posts_data = mysqli_query($connection, $query);
        while ($Row = mysqli_fetch_assoc($fetch_posts_data)) {
            echo "<tr>
            <td>{$Row['comment_id']}</td>
            <td>{$Row['comment_author']}</td>
            <td>{$Row['comment_content']}</td>
            <td>{$Row['comment_email']}</td>
            <td>{$Row['comment_status']}</td>";

            $post_id = $Row['comment_post_id'];
            $query = "SELECT * FROM posts WHERE post_id=$post_id";
            $fetch_cat_data = mysqli_query($connection, $query);
            while ($Post = mysqli_fetch_assoc($fetch_cat_data)) {
                $post_title = $Post["post_title"];
                if (isset($post_title)) {
                    echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                }
            }

            echo "
                    <td>{$Row['comment_date']}</td>
                    <td><a href='comments.php?unapproved={$Row['comment_id']}'>Approve</a></td>
                    <td><a href='comments.php?approved={$Row['comment_id']}'>Unapprove</a></td>
                    <td> <a href='comments.php?delete={$Row['comment_id']}'>Delete</a>
                    </td>
                </tr>";
        }
        ?>
    </tbody>
</table>