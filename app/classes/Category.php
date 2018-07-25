<?php
/**
 * Created by PhpStorm.
 * User: Web app - PHP
 * Date: 2/1/2018
 * Time: 8:27 PM
 */

namespace App\classes;

use App\classes\Database;

class Category
{
    public function saveCategoryInfo($data){
        $sql = "INSERT INTO categories (category_name, category_description, publication_status) VALUES ('$data[category_name]','$data[category_description]','$data[publication_status]')";
        if(mysqli_query(Database::dbConnection(), $sql)){
            $message = 'Data saved successfully.';
            return $message;
        } else {
            die('Query problem'.mysqli_error(Database::dbConnection()));
        }
    }

    public function getAllCategoryInfo(){
        $sql = "SELECT * FROM categories";

        if(mysqli_query(Database::dbConnection(), $sql)){
            $queryResult = mysqli_query(Database::dbConnection(), $sql);
            return $queryResult;
        } else {
            die('Query problem'.mysqli_error(Database::dbConnection()));
        }
    }

    public function deleteCategoryInfo($id){
        $sql = "DELETE FROM categories WHERE id = '$id'";

        if(mysqli_query(Database::dbConnection(), $sql)){
            header('Location: manage-category.php');
        } else {
            die('Query problem'.mysqli_error(Database::dbConnection()));
        }
    }

    public function getCategoryInfoById($id){
        $sql = "SELECT * FROM categories WHERE id = '$id'";

        if(mysqli_query(Database::dbConnection(), $sql)){
            $queryResult = mysqli_query(Database::dbConnection(), $sql);
            return $queryResult;
        } else {
            die('Query problem'.mysqli_error(Database::dbConnection()));
        }
    }

    public function updateCategoryInfo($data){
        $ctg = (object) $data;
        $sql = "UPDATE categories SET category_name = '$ctg->category_name', category_description = '$ctg->category_description' WHERE id = '$ctg->id'";

        if(mysqli_query(Database::dbConnection(), $sql)){
            header('Location: manage-category.php');
        } else {
            die('Query problem'.mysqli_error(Database::dbConnection()));
        }
    }

    public function getAllPublishedCategory() {
        $sql = "SELECT * FROM categories WHERE publication_status = 1";
        if(mysqli_query(Database::dbConnection(), $sql)){
            $queryResult = mysqli_query(Database::dbConnection(), $sql);
            return $queryResult;
        } else {
            die('Query problem'.mysqli_error(Database::dbConnection()));
        }
    }

}