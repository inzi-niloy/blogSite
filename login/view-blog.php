<?php include_once 'includes/menu.php' ?>
<?php

//require_once '../vendor/autoload.php';
use App\classes\Category;
use App\classes\Blog;

$category = new Category();
$blog = new Blog();

if(isset($_GET['delete'])){
    $id = $_GET['id'];
    $category->deleteCategoryInfo($id);
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



$queryResult = $blog->getBlogInfoById($_GET['id']);
$data = mysqli_fetch_assoc($queryResult);

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
                                <td><?php echo $data['id']; ?></td>
                            </tr>
                            <tr>
                                <th>Category ID</th>
                                <td><?php echo $data['category_id']; ?></td>
                            </tr>
                            <tr>
                                <th>Blog Title</th>
                                <td><?php echo $data['blog_title']; ?></td>
                            </tr>
                            <tr>
                                <th>Short Description</th>
                                <td><?php echo $data['short_description']; ?></td>
                            </tr>
                            <tr>
                                <th>Long Description</th>
                                <td><?php echo $data['long_description']; ?></td>
                            </tr>
                            <tr>
                                <th>Blog Image</th>
                                <td><img src="<?php echo $data['blog_image']; ?>" height="250" width="250"></td>
                            </tr>
                            <tr>
                                <th>Publication Status</th>
                                <td><?php echo $data['publication_status'] == 1 ? 'Published' : 'Unpublished'; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once 'includes/footer.php' ?>