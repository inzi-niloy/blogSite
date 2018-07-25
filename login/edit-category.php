<?php include_once 'includes/menu.php' ?>
<?php

//require_once '../vendor/autoload.php';

use App\classes\Category;

$category = new Category();
$id = $_GET['id'];
$queryResult = $category->getCategoryInfoById($id);
$data = (object)mysqli_fetch_assoc($queryResult);

$message = '';
if (isset($_POST['btn'])) {
    $message = $category->updateCategoryInfo($_POST);
}

?>
    <h3 style="text-align: center; margin-top: 50px;"><?php echo $message; ?></h3>
    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category Name</label>
                                <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $data->category_name; ?>">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Category Description</label>
                                <textarea class="form-control" name="category_description" id="" cols="30" rows="10"><?php echo $data->category_description; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Publication Status</label>
                                <input type="radio" name="publication_status" value="1" <?php echo $data->publication_status == 1 ? 'checked' : ''?> /> Published
                                <input type="radio" name="publication_status" value="0" <?php echo $data->publication_status == 0 ? 'checked' : ''?>> Unpublished
                            </div>


                            <button type="submit" name="btn" class="btn btn-primary">Save Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once 'includes/footer.php' ?>