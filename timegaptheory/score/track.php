<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once dirname( __FILE__ ) . '/' . '../common/timegaptheorydatabase.php';
require_once dirname( __FILE__ ) . '/' . '../settings/delay.php'; 
require_once dirname( __FILE__ ) . '/' . '../common/common.php'; 

try {
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "CREATE TABLE IF NOT EXISTS `score`( `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, `signup` tinyint(1) NOT NULL, `login` tinyint(1) NOT NULL, `transfer` tinyint(1) NOT NULL , `mars` tinyint(1) NOT NULL , `ticket` tinyint(1) NOT NULL, `coupon` tinyint(1) NOT NULL, `ratings` tinyint(1) NOT NULL) ENGINE=InnoDB MAX_ROWS=1;INSERT INTO `score` (`id`, `signup`, `login`, `transfer`, `mars`, `ticket`, `coupon`, `ratings`) VALUES (1, 0, 0, 0, 0, 0, 0, 0);CREATE TABLE IF NOT EXISTS `mars`( `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, `eligible` int(11) NOT NULL, `rewarded` int(11) NOT NULL) ENGINE=InnoDB MAX_ROWS=1; INSERT INTO `mars` (`id`, `eligible`, `rewarded`) VALUES(1, 0, 0);";
    $connection->exec($sql);
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}


$score = array (
    'create' => 0,
    'login' => 0,
    'transfer' => 0,
    'mars' => 0,
    'ticket' => 0,
    'coupon' => 0,
    'ratings' => 0,
  );
  
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT * FROM score WHERE 1";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
    $score = array (
      'create' => $result[0]["signup"],
      'login' => $result[0]["login"],
      'transfer' => $result[0]["transfer"],
      'mars' => $result[0]["mars"],
      'ticket' => $result[0]["ticket"],
      'coupon' => $result[0]["coupon"],
      'ratings' => $result[0]["ratings"],
    );
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }


   //checking login 01
   if(!$score['login']){
        try {
            $connection = new PDO($dsn, $username, $password, $options);
        
            $sql = "SELECT *
            FROM users
                    WHERE loginattempts > 2";
                    $statement = $connection->prepare($sql);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    if ($result && $statement->rowCount() > 0){
                        update('login');
                    }
        } catch(PDOException $error) {
           // echo $sql . "<br>" . $error->getMessrewards();
        }
   }

//checking create user 02
if(!$score['create']){
    try {
        $connection = new PDO($dsn, $username, $password, $options);
    
        $sql = "SELECT `email` FROM `users` GROUP BY `email` HAVING COUNT(*) > 1";
                $statement = $connection->prepare($sql);
                $statement->execute();
                $result = $statement->fetchAll();
                if ($result && $statement->rowCount() > 0){
                    update('signup');
    
                }
    } catch(PDOException $error) {
       // echo $sql . "<br>" . $error->getMessrewards();
    }
}

//checking transfer 03
if(!$score['transfer']){
    try {
        $connection = new PDO($dsn, $username, $password, $options);
    
        $sql = "SELECT *
            FROM users
                WHERE rewards < 0";
                $statement = $connection->prepare($sql);
                $statement->execute();
                $result = $statement->fetchAll();
                if ($result && $statement->rowCount() > 0){
                    update('transfer');
    
                }
    } catch(PDOException $error) {
       // echo $sql . "<br>" . $error->getMessrewards();
    }
}
  
//checking ticket 04
if(!$score['ticket']){
    try {
        $connection = new PDO($dsn, $username, $password, $options);
    
        $sql = "SELECT *
            FROM tickets";
                $statement = $connection->prepare($sql);
                $statement->execute();
                $result = $statement->fetchAll();
                if ($result && $statement->rowCount() > 1){
                    update('ticket');;
    
                }
    } catch(PDOException $error) {
       // echo $sql . "<br>" . $error->getMessrewards();
    }
}
   
//checking coupon 05
if(!$score['coupon']){
    try {
        $connection = new PDO($dsn, $username, $password, $options);
    
        $sql = "SELECT *
        FROM users
                WHERE welcomegift > 1";
                $statement = $connection->prepare($sql);
                $statement->execute();
                $result = $statement->fetchAll();
                if ($result && $statement->rowCount() > 0){
                    update('coupon');
    
                }
    } catch(PDOException $error) {
       // echo $sql . "<br>" . $error->getMessrewards();
    }
}

//checking double 06
if(!$score['mars']){
    global $host;
    global $username;
    global $password;
    global $options;
    global $dbname;
    global $dsn;
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $sql = "SELECT * FROM mars WHERE id=1";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
      } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
      }

    if($result[0]["rewarded"] > $result[0]["eligible"]){
        update('mars');
    }
}

//checking 07 ratings
if(!$score['ratings']){
    try {
        $connection = new PDO($dsn, $username, $password, $options);
    
        $sql = "SELECT 
        email, 
        COUNT(email)
    FROM
        ratings
    GROUP BY email
    HAVING COUNT(email) > 1;";
                $statement = $connection->prepare($sql);
                $statement->execute();
                $result = $statement->fetchAll();
                if ($result && $statement->rowCount() > 0){
                    update('ratings');
                }
                //echo $result[0]['total'];
    } catch(PDOException $error) {
       // echo $sql . "<br>" . $error->getMessrewards();
    }
}


function update($challenge){
    global $host;
    global $username;
    global $password;
    global $options;
    global $dbname;
    global $dsn;
    try {
        $connection = new PDO("mysql:host=$host", $username, $password, $options);
        $sql = "use " . $dbname . ";UPDATE `score` SET `". $challenge . "`=1 WHERE `id`=1;";
        $connection->exec($sql);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
   
?>