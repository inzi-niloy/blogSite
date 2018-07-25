<?php include_once 'includes/menu.php' ?>
<?php

//require_once '../vendor/autoload.php';
use App\classes\Category;
use App\classes\Blog;

$category = new Category();
$blog = new Blog();

if(isset($_GET['delete'])) {
    $id = $_GET['id'];
    $blog->deleteBlogInfo($id);
}

$message = '';
if(isset($_GET['unpublished'])) {
    $id = $_GET['id'];
    $message = $blog->unpublishedBlogById($id);
}

if(isset($_GET['published'])) {
    $id = $_GET['id'];
    $message = $blog->publishedBlogById($id);
}



$queryResult = $blog->getAllBlogInfo();



?>
    <!--    <h3 style="text-align: center; margin-top: 50px;">--><?php //echo $message; ?><!--</h3>-->
    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-11 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <?php echo $message; ?>
                        <table class="table table-bordered">
                            <tr>
                                <th>Blog ID</th>
                                <th>Blog Title</th>
                                <th>Category Name</th>
                                <th>Blog Image</th>
                                <th>Publication Status</th>
                                <th>Action</th>
                            </tr>
                            <?php  while($row = mysqli_fetch_assoc($queryResult)){ ?>
                                <tr>
                                    <td><?php echo $row['id'] ?></td>
                                    <td><?php echo $row['blog_title'] ?></td>
                                    <td><?php echo $row['category_name'] ?></td>
                                    <td>
                                        <img src="<?php echo $row['blog_image'] ?>" alt="" height="80" width="80"/>
                                    </td>
                                    <td><?php echo $row['publication_status'] == 1 ? 'Published' : 'Unpublished' ?></td>
                                    <td>

                                        <?php if($row['publication_status'] == 1) { ?>
                                        <a href="?unpublished=true&id=<?php echo $row['id']; ?>" class="btn btn-info">Published</a>
                                        <?php } else {  ?>
                                        <a href="?published=true&id=<?php echo $row['id']; ?>" class="btn btn-warning">Unpublished</a>
                                        <?php } ?>

                                        <a href="view-blog.php?id=<?php echo $row['id']; ?>" class="btn btn-success">View</a>
                                        <a href="edit-blog.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Edit</a>
                                        <a href="?delete=true&id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this !!'); ">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once 'includes/footer.php' ?>