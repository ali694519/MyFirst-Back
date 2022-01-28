<?php
// $server = "Localhost";
// $username = "root";
// $password= "";
// $database = "shop";
// $connect = mysqli_connect($server,$username,$password,$database);

// if(!$connect) {
//     die("Failed".mysqli_connect_error());
// }else {
//     // echo "Success Database Connected";
// }//end connect

$dsn = 'mysql:host=localhost;dbname=shop'; // Data Source Name
$user = 'root'; // The User To Connect
$pas = ""; // Password Of This User

$options = array( 
PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
);
try{
$connect = new PDO($dsn,$user,$pas,$options); // Statr A New Connection With PDO Class
$connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
// echo "You Are Connected";
}
catch(PDOException $e) {
    echo "Failed".$e->getMessage();
}
?>