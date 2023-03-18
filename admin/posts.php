<?php
include "includes/header.php";
include "includes/navigation.php";

// Add new Category.
$error_message = "";
if (isset($_POST["submit"])) {
    $cat_title = $_POST['cat_title'];
    if (!empty($cat_title) || $cat_title != "") {
        $query = "INSERT INTO categories (cat_title) VALUES('$cat_title'); ";
        $create_query = mysqli_query($connection, $query);
        if (!$create_query) {
            die("Query Failed: " . mysqli_error($connection));
        }
    } else {
        $error_message = "Category field is required.";
    }
}

// Delete Category.
if (isset($_GET["delete"])) {
    $cat_id = $_GET['delete'];
    $query = "DELETE FROM categories WHERE cat_id=$cat_id";
    $delete_query = mysqli_query($connection, $query);
    header("Location: categories.php");
    if (!$delete_query) {
        die("Query Failed: " . mysqli_error($connection));
    }
}

// Update Category.
if (isset($_GET["edit"], $_POST["update_category"])) {
    $cat_id = $_GET['edit'];
    $cat_title = $_POST["cat_title"];
    $query = "UPDATE categories SET cat_title='$cat_title' WHERE cat_id=$cat_id";
    $update_query = mysqli_query($connection, $query);
    header("Location: categories.php");
    if (!$update_query) {
        die("Query Failed: " . mysqli_error($connection));
    }
}

?>

<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome to Admin
                    <small>author</small>
                </h1>
            </div>
            <div class="col-xs-12">
                <?php
                if (isset($_GET['source'])) {
                    $source = $_GET['source'];
                } else {
                    $source = "";
                }
                switch ($source) {
                    case 'add_post':
                        include "./includes/add_post.php";
                        break;
                    case 'edit_post':
                        include "./includes/edit_post.php";
                        break;
                    default:
                        include "./includes/view_all_posts.php";
                        break;
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php" ?>