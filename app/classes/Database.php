<?php
/**
 * Created by PhpStorm.
 * User: Web app - PHP
 * Date: 2/4/2018
 * Time: 6:13 PM
 */

namespace App\classes;


class Database
{
    public function dbConnection(){
        $hostName = 'localhost';
        $userName = 'root';
        $password = '';
        $dbName = 'blog';
        $link = mysqli_connect($hostName,$userName,$password,$dbName);
        return $link;
    }
}