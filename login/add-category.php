<?php include_once 'includes/menu.php'; ?>
<?php
//    require_once '../vendor/autoload.php';
    use App\classes\Category;

    $message = '';
    if(isset($_POST['btn'])){
        $category = new Category();
        $message = $category->saveCategoryInfo($_POST);
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
                                <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Category Name">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Category Description</label>
                                <textarea class="form-control" name="category_description" id="" cols="30" rows="10" placeholder="Enter Category Description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Publication Status</label>
                                <input type="radio" name="publication_status" value="1"> Published
                                <input type="radio" name="publication_status" value="0"> Unpublished
                            </div>


                            <button type="submit" name="btn" class="btn btn-primary">Save Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once 'includes/footer.php'; ?>