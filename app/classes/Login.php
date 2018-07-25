<?php
/**
 * Created by PhpStorm.
 * User: Web app - PHP
 * Date: 1/30/2018
 * Time: 8:56 PM
 */

namespace App\classes;

use App\classes\Database;


class Login
{
    public function adminLoginCheck($data){
        $password = md5($data['password']);
       $sql = "SELECT * FROM users WHERE email = '$data[email]' AND password = '$password'";

       if(mysqli_query(Database::dbConnection(), $sql)){
           $queryResult = mysqli_query(Database::dbConnection(), $sql);
           $user = mysqli_fetch_assoc($queryResult);
           if($user){
               session_start();
               $_SESSION['id'] = $user['id'];
               $_SESSION['name'] = $user['name'];

                header('Location: dashboard.php');
           }else{
               header('Location: index.php');
           }
       }else{

       }

    }

    public function adminLogout(){
        unset($_SESSION['id']);
        unset($_SESSION['name']);
        header('Location: index.php');
    }
}