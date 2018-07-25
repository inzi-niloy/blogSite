<?php include_once 'includes/menu.php'; ?>
<?php

use App\classes\Category;
use App\classes\Blog;

$category = new Category();
$blog = new Blog();

$queryResult = $category->getAllPublishedCategory();



$message = '';
if(isset($_POST['btn'])){
    $message = $blog->saveBlogInfo($_POST);
}

?>

    <h3 style="text-align: center; margin-top: 50px;"><?php echo $message; ?></h3>
    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category Name</label>
                                <select name="category_id" class="form-control">
                                    <option>---Select Category Name---</option>
                                    <?php while($row = mysqli_fetch_assoc($queryResult)) { ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option>
                                    <?php } ?>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Blog Title</label>
                                <input type="text" name="blog_title" class="form-control" placeholder="Enter Blog Title">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Short Description</label>
                                <textarea class="form-control" name="short_description" cols="30" rows="10" placeholder="Enter Short Description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Long Description</label>
                                <textarea class="form-control" name="long_description" cols="30" rows="10" placeholder="Enter Long Description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Blog Image</label>
                                <input type="file" name="blog_image" class="form-control">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Publication Status</label>
                                <input type="radio" name="publication_status" value="1"> Published
                                <input type="radio" name="publication_status" value="0"> Unpublished
                            </div>


                            <button type="submit" name="btn" class="btn btn-primary">Save Blog</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once 'includes/footer.php'; ?>