<?php

if (isset($_POST['update_post'], $_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];

    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    $post_comemnt_id = 4;

    move_uploaded_file($post_image_temp, "../images/$post_image");

    // Update a Post.
    $query = "UPDATE posts SET ";
    $query .= "post_category_id='$post_category_id', ";
    $query .= "post_title='$post_title', ";
    $query .= "post_author='$post_author', ";
    $query .= "post_date='$post_date', ";
    $query .= !empty($post_image) ? "post_image='$post_image', " : null;
    $query .= "post_content='$post_content', ";
    $query .= "post_tags='$post_tags', ";
    $query .= "post_status='$post_status' ";
    $query .= "WHERE post_id=$the_post_id";

    $update_post_query = mysqli_query($connection, $query);
    if (!$update_post_query) {
        die("Query Failed: " . mysqli_error($connection));
    }

    echo "<p class='alert alert-success'>Post updated successfully. <a href='../post.php?p_id=$the_post_id'>View Post</a></p>";
}



?>


<?php
if (isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];
    $query = "SELECT * FROM posts WHERE post_id=$the_post_id";
    $fetch_data = mysqli_query($connection, $query);
    while ($Row = mysqli_fetch_assoc($fetch_data)) {
        $post_id = $Row['post_id'];
        $post_author = $Row['post_author'];
        $post_title = $Row['post_title'];
        $post_category_id = $Row['post_category_id'];
        $post_status = $Row['post_status'];
        $post_image = $Row['post_image'];
        $post_tags = $Row['post_tags'];
        $post_comment_count = $Row['post_comment_count'];
        $post_date = $Row['post_date'];
        $post_content = $Row['post_content'];
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Post Title</label>
                <input type="text" class="form-control" value="<?php echo $post_title; ?>" name="title">
            </div>

            <div class="form-group">
                <label for="post_category">Post Category ID</label>
                <select class="form-control" name="post_category" id="post_category">
                    <?php
                            $query = "SELECT * FROM categories";
                            $fetch_data = mysqli_query($connection, $query);
                            while ($Row = mysqli_fetch_assoc($fetch_data)) {
                                $cat_id = $Row["cat_id"];
                                $cat_title = $Row["cat_title"];
                                $selected = ($cat_id == $post_category_id) ? 'selected' : '';
                                if (isset($cat_title)) {
                                    echo "<option value='" . $cat_id . "' " . $selected . ">" . $cat_title . "</option>";
                                }
                            }
                            ?>
                </select>
            </div>

            <div class="form-group">
                <label for="title">Post Author</label>
                <input type="text" class="form-control" value='<?php echo $post_author; ?>' name="author">
            </div>

            <div class="form-group">
                <label for="post_status">Post Status</label>
                <select class="form-control" name="post_status" id="post_category">
                    <option value='<?php echo $post_status; ?>'><?php echo $post_status; ?></option>
                    <?php if ($post_status === "Published") { ?>
                        <option value='Draft'>Draft</option>
                    <?php } else { ?>
                        <option value='Published'>Published</option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <img src='../images/<?php echo $post_image ?>' alt='image' width='100px'>
                <input type="file" name="post_image">
            </div>

            <div class="form-group">
                <label for="post_tags">Post Tags</label>
                <input type="text" class="form-control" value='<?php echo $post_tags; ?>' name="post_tags">
            </div>

            <div class="form-group">
                <label for="post_content">Post Content</label>
                <textarea id="editor" name="post_content" class="form-control">
                    <?php echo $post_content; ?>
                </textarea>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="update_post" value="Update">
            </div>
        </form>
<?php }
}
?>