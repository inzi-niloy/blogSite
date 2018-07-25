<?php include_once 'includes/menu.php' ?>
<?php

//require_once '../vendor/autoload.php';
use App\classes\Category;

$category = new Category();

if(isset($_GET['delete'])){
    $id = $_GET['id'];
    $category->deleteCategoryInfo($id);
}

$queryResult = $category->getAllCategoryInfo();

?>
<!--    <h3 style="text-align: center; margin-top: 50px;">--><?php //echo $message; ?><!--</h3>-->
    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-11 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Category ID</th>
                                <th>Category Name</th>
                                <th>Category Description</th>
                                <th>Publication Status</th>
                                <th>Action</th>
                            </tr>
                            <?php  while($ctg = mysqli_fetch_assoc($queryResult)){ ?>
                            <tr>
                                <td><?php echo $ctg['id'] ?></td>
                                <td><?php echo $ctg['category_name'] ?></td>
                                <td><?php echo $ctg['category_description'] ?></td>
                                <td><?php echo $ctg['publication_status'] ?></td>
                                <td>
                                    <a href="edit-category.php?id=<?php echo $ctg['id']; ?>" class="btn btn-success">Edit</a>
                                    <a href="?delete=true&id=<?php echo $ctg['id']; ?>" class="btn btn-danger">Delete</a>
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