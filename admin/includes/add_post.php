<?php
if (isset($_POST['create_post'])) {
    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    $post_comemnt_id = 0;

    move_uploaded_file($post_image_temp, "../images/$post_image");

    // Add new Post.
    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
    $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', '{$post_date}', '{$post_image}', '{$post_content}', '{$post_tags}', {$post_comemnt_id}, '{$post_status}')";
    $create_post_query = mysqli_query($connection, $query);
    $the_post_id = mysqli_insert_id($connection);
    if (!$create_post_query) {
        die("Query Failed: " . mysqli_error($connection));
    }

    echo "<p class='alert alert-success'>Post added successfully. <a href='../post.php?p_id=$the_post_id'>View Post</a></p>";
}

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="post_category">Post Category</label>
        <select class="form-control" name="post_category" id="post_category">
            <?php
            $query = "SELECT * FROM categories";
            $fetch_data = mysqli_query($connection, $query);
            while ($Row = mysqli_fetch_assoc($fetch_data)) {
                $cat_id = $Row["cat_id"];
                $cat_title = $Row["cat_title"];
                if (isset($cat_title)) {
                    ?>
                    <option value='<?php echo $cat_id; ?>'><?php echo $cat_title; ?></option>
            <?php
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="title">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select class="form-control" name="post_status" id="post_category">
            <option value='Draft'>Select Option</option>
            <option value='Published'>Published</option>
            <option value='Draft'>Draft</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label id="my-ckeditor" for="post_content">Post Content</label>
        <textarea id="editor" name="post_content" class="form-control">
        This is some sample content.
        </textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish">
    </div>
</form>