<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once dirname( __FILE__ ) . '/' . '../common/timegaptheorydatabase.php';
   session_start();

   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
      die();
   }

   $user_check = $_SESSION['login_user'];
   try  {
     $connection = new PDO($dsn, $username, $password, $options);

     $sql = "SELECT firstname
             FROM users
             WHERE email = :email";


     $statement = $connection->prepare($sql);
     $statement->bindParam(':email', $user_check, PDO::PARAM_STR);
     $statement->execute();

     $result = $statement->fetchAll();
   } catch(PDOException $error) {
       //echo $sql . "<br>" . $error->getMessrewards();
   }

   if ($result && $statement->rowCount() > 0) {
     $login_session = $result[0]["firstname"];

   }
