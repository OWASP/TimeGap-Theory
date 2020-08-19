<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once dirname( __FILE__ ) . '/' . '../common/timegaptheorydatabase.php';
require_once dirname( __FILE__ ) . '/' . '../settings/delay.php'; 
require_once dirname( __FILE__ ) . '/' . '../common/common.php'; 

try {
  $connection = new PDO($dsn, $username, $password, $options);
  $sql = "CREATE TABLE IF NOT EXISTS `settings`( `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, `wait` tinyint(1) NOT NULL, `marswait` tinyint(1) NOT NULL, `maximumloginattempt` tinyint(1) NOT NULL) ENGINE=InnoDB MAX_ROWS=1;INSERT INTO `settings` (`id`, `wait`, `marswait`, `maximumloginattempt`) VALUES (1, 0, 0, 2);";
  $connection->exec($sql);
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}

try {
  $connection = new PDO($dsn, $username, $password, $options);
  $sql = "SELECT * FROM settings WHERE `id`=1;";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $result = $statement->fetchAll();
  global $settings;
  $settings = array (
    'wait' => $result[0]["wait"],
    'marswait' => $result[0]["marswait"],
    'maximumloginattempt' => $result[0]["maximumloginattempt"],
  );
  global $config;
  $config['wait'] = $settings['wait'];
  $config['marswait'] = $settings['marswait'];
  $config['maximumloginattempt'] = $settings['maximumloginattempt'];
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}

?>