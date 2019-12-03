<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once dirname( __FILE__ ) . '/' . '../common/timegaptheorydatabase.php';
require_once dirname( __FILE__ ) . '/' . '../common/config.php';


//checking double 06

    try {
        $connection = new PDO($dsn, $username, $password, $options);
    
        $sql = "SELECT *
        FROM users
                WHERE rewards >= 2000";
                $statement = $connection->prepare($sql);
                $statement->execute();
                $result = $statement->fetchAll();
                if ($statement->rowCount() > 0){
                    global $host;
                    global $username;
                    global $password;
                    global $options;
                    global $dbname;
                    global $dsn;
                    try {
                        $connection2 = new PDO($dsn, $username, $password, $options);
                        $sql2 = "UPDATE mars SET eligible= ". $statement->rowCount() ." WHERE id=1";
                        $connection2->exec($sql2);
                      } catch(PDOException $error) {
                        echo $sql2 . "<br>" . $error->getMessage();
                      }
                    
                }
                
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessrewards();
    }

   
?>