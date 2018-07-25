<?php

namespace App\classes;

use App\classes\Database;


class Blog
{
    public function saveBlogInfo($data){
        $imageName = $_FILES['blog_image']['name'];
        $directory = '../assets/blog-images/';
        $imageUrl = $directory . $imageName;
        $fileType = pathinfo($imageName, PATHINFO_EXTENSION);

        $imageSize = $_FILES['blog_image']['size'];

        $check = getimagesize($_FILES['blog_image']['tmp_name']);

        if ($check) {
            if(file_exists($imageUrl)){
                die('This file already exists. Please try another one.');
            }else{
                if ($fileType == 'jpg' || $fileType == 'JPG' || $fileType == 'png' || $fileType == 'PNG') {
                    if ($imageSize <= 2097152) {
                        move_uploaded_file($_FILES['blog_image']['tmp_name'],$imageUrl);

                        $sql = "INSERT INTO blogs (category_id, blog_title, short_description, long_description, blog_image, publication_status) VALUES ('$data[category_id]', '$data[blog_title]', '$data[short_description]', '$data[long_description]', '$imageUrl', '$data[publication_status]')";
                        if(mysqli_query(Database::dbConnection(), $sql)){
                            $message = 'Blog info saved successfully.';
                            return $message;
                        }
                    } else {
                        die('File size is too large.');
                    }
                } else {
                    die('The file is not of supported type.');
                }
                }
            } else {
                die('The file you selected is not an image. Please select an image file.');
            }
        }
    public function getAllBlogInfo() {
        $sql = "SELECT b.*, c.category_name FROM blogs as b, categories as c WHERE b.category_id = c.id";
        if(mysqli_query(Database::dbConnection(), $sql)) {
            $queryResult = mysqli_query(Database::dbConnection(), $sql);
            return $queryResult;
        } else {
            die('Query problem'.mysqli_error(Database::dbConnection()));
        }
    }

    public function unpublishedBlogById($id) {
        $sql = "UPDATE blogs SET publication_status = 0 WHERE id = '$id' ";
        if(mysqli_query(Database::dbConnection(), $sql)) {
            $message = 'Blog info unpublished successfully';
            return $message;
        } else {
            die('Query problem'.mysqli_error(Database::dbConnection()));
        }
    }

    public function publishedBlogById($id) {
        $sql = "UPDATE blogs SET publication_status = 1 WHERE id = '$id' ";
        if(mysqli_query(Database::dbConnection(), $sql)) {
            $message = 'Blog info published successfully';
            return $message;
        } else {
            die('Query problem'.mysqli_error(Database::dbConnection()));
        }
    }



    public function getBlogInfoById($id) {
        $sql = "SELECT * FROM blogs WHERE id = '$id' ";
        if(mysqli_query(Database::dbConnection(), $sql)) {
            $queryResult = mysqli_query(Database::dbConnection(), $sql);
            return $queryResult;
        } else {
            die('Query problem'.mysqli_error(Database::dbConnection()));
        }
    }

    public function updateBlogInfo($data) {
        $imageName = $_FILES['blog_image']['name'];
        $obj_data = (object)$data;
        if ($imageName) {
            $sql = "SELECT * FROM blogs WHERE id = '$obj_data->blog_id' ";
            $queryResult = mysqli_query(Database::dbConnection(), $sql);
            $blogInfo = mysqli_fetch_assoc($queryResult);
            unlink($blogInfo['blog_image']);



            $directory = '../assets/blog-images/';
            $imageUrl = $directory . $imageName;
            $fileType = pathinfo($imageName, PATHINFO_EXTENSION);
            $imageSize = $_FILES['blog_image']['size'];
            $check = getimagesize($_FILES['blog_image']['tmp_name']);
            if ($check) {
                if(file_exists($imageUrl)){
                    die('This file already exists. Please try another one.');
                }else{
                    if ($fileType == 'jpg' || $fileType == 'JPG' || $fileType == 'png' || $fileType == 'PNG') {
                        if ($imageSize <= 2097152) {
                            move_uploaded_file($_FILES['blog_image']['tmp_name'],$imageUrl);
                            $sql = "UPDATE blogs SET category_id='$obj_data->category_id', blog_title='$obj_data->blog_title', short_description = '$obj_data->short_description', long_description = '$obj_data->long_description', blog_image='$imageUrl', publication_status = '$obj_data->publication_status' WHERE id='$obj_data->blog_id' ";
                            if(mysqli_query(Database::dbConnection(), $sql)){
                                header('Location: manage-blog.php');
                            }
                        } else {
                            die('File size is too large.');
                        }
                    } else {
                        die('The file is not of supported type.');
                    }
                }
            } else {
                die('The file you selected is not an image. Please select an image file.');
            }
        } else {
            $sql = "UPDATE blogs SET category_id='$obj_data->category_id', blog_title='$obj_data->blog_title', short_description = '$obj_data->short_description', long_description = '$obj_data->long_description', publication_status = '$obj_data->publication_status' WHERE id='$obj_data->blog_id' ";
            if(mysqli_query(Database::dbConnection(), $sql)) {
                header('Location: manage-blog.php');
            } else {
                die('Query problem'.mysqli_error(Database::dbConnection()));
            }
        }

    }

    public function deleteBlogInfo($id) {
        $sql = "SELECT * FROM blogs WHERE id = '$id' ";
        $queryResult = mysqli_query(Database::dbConnection(), $sql);
        $blogInfo = mysqli_fetch_assoc($queryResult);
        unlink($blogInfo['blog_image']);


       $sql = "DELETE FROM blogs WHERE id = '$id' ";
        if(mysqli_query(Database::dbConnection(), $sql)) {
            header('Location: manage-blog.php');
        } else {
            die('Query problem'.mysqli_error(Database::dbConnection()));
        }


    }





}