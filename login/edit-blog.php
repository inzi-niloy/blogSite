<?php include_once 'includes/menu.php'; ?>
<?php

use App\classes\Category;
use App\classes\Blog;

$category = new Category();
$blog = new Blog();

$queryResult = $category->getAllPublishedCategory();


$queryResult1 = $blog->getBlogInfoById($_GET['id']);
$data = mysqli_fetch_assoc($queryResult1);


$message = '';
if(isset($_POST['btn'])){
    $message = $blog->updateBlogInfo($_POST);
}

?>

    <h3 style="text-align: center; margin-top: 50px;"><?php echo $message; ?></h3>
    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data" name="editBlogForm">
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
                                <input type="text" value="<?php echo $data['blog_title']; ?>" name="blog_title" class="form-control" placeholder="Enter Blog Title"/>
                                <input type="hidden" value="<?php echo $data['id']; ?>" name="blog_id" class="form-control" placeholder="Enter Blog Title"/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Short Description</label>
                                <textarea class="form-control" name="short_description" cols="30" rows="10" placeholder="Enter Short Description"><?php echo $data['short_description']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Long Description</label>
                                <textarea class="form-control" name="long_description" cols="30" rows="10" placeholder="Enter Long Description"><?php echo $data['long_description']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Blog Image</label>
                                <input type="file" name="blog_image" class="form-control">
                                <br/>
                                <img src="<?php echo $data['blog_image']; ?>" alt="" height="80" width="90"/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Publication Status</label>
                                <input type="radio" <?php echo $data['publication_status'] == 1 ? 'checked' : '' ; ?>  name="publication_status" value="1"> Published
                                <input type="radio" <?php echo $data['publication_status'] == 0 ? 'checked' : '' ; ?> name="publication_status" value="0"> Unpublished
                            </div>


                            <button type="submit" name="btn" class="btn btn-primary">Update Blog</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.forms['editBlogForm'].elements['category_id'].value = '<?php echo $data['category_id']?>';
    </script>

<?php include_once 'includes/footer.php'; ?>