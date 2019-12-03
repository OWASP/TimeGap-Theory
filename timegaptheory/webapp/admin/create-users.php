<?php

/**
 * Open a connection via PDO to create a
 * new database and table with structure.
 *
 */

require_once dirname( __FILE__ ) . '/' . '../../common/timegaptheorydatabase.php';
require_once dirname( __FILE__ ) . '/' . '../../common/config.php';
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create Users</title>
  <link rel="icon" type="image/png" href="../../common/timegaptheory.png">
  <link rel="stylesheet" href="../../common/bulma.css" id="light" title="Light">
  <link rel="stylesheet" href="../../common/bulmadark.css"  id="dark"  title="Dark" disabled>
</head>
<body>
  <div class="container">
  <div class="columns">
  <div class="column">
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="../"><img src="../../common/owasp.png" height="28" width="28"></a>
            <a class="navbar-item" href="../"><img src="../../common/timegaptheory.png" height="28" width="28"></a>
            <a class="navbar-item" href="../"><img src="../../common/lab.png" height="28px" width="28px"></a>
            <a class="navbar-item" href=""><img src="../../common/webapp.png" height="28px" width="28px"></a>
          </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
        <a class="navbar-item" href="">
            OWASP TimeGap Theory WebApp
        </a>
    </div>
    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
            <a class="button is-warning" href="../index.php">
              Admin
            </a>
          <a class="button is-warning" href="../sign-up.php">
            Sign Up
          </a>
          <a class="button is-primary" href="../login.php">
            Login
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>
  </div></div>

  <div class="columns">
      <div class="column">
          <nav class="breadcrumb" aria-label="breadcrumbs">
              <ul>
                <li><a href="../../">OWASP TimeGap Theory</a></li>
                <li><a href="../">WebApp</a></li>
                <li><a href="index.php">Administration Panel</a></li>
                <li class="is-active"><a href="#" aria-current="page">Create users</a></li>
              </ul>
            </nav>
            <div class="container">

<?php
try {
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "DROP TABLE IF EXISTS users; DROP TABLE IF EXISTS tickets; DROP TABLE IF EXISTS ratings; CREATE TABLE users( id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, firstname VARCHAR(30) NOT NULL, password VARCHAR(30) NOT NULL, email VARCHAR(50) NOT NULL, rewards decimal(8,0), loginattempts INT(8) UNSIGNED, welcomegift TINYINT(1), date TIMESTAMP); CREATE TABLE tickets ( id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, count INT(8) UNSIGNED, email VARCHAR(50) NOT NULL ); CREATE TABLE ratings ( id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, email VARCHAR(50) NOT NULL ); ";
    $connection->exec($sql);
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

try {
    $connection = new PDO("mysql:host=$host", $username, $password, $options);
    $sql = "use " . $dbname . ";INSERT INTO `users` (`firstname`, `password`, `email`, `rewards`, `loginattempts`, `welcomegift`, `date`) VALUES
    ('tom', 'tom', 'tom@timegaptheory.com', '100', 0, 0, NULL),
    ('jerry', 'jerry', 'jerry@timegaptheory.com', '900', 0, 0, NULL),
    ('spike', 'spike', 'spike@timegaptheory.com', '1000', 0, 0, NULL),
    ('tyke', 'tyke', 'tyke@timegaptheory.com', '2000', 0, 0, NULL);";
    $connection->exec($sql);
    echo "Cleared the database. <br>Created users.";
} catch(PDOException $error) {
    //echo $sql . "<br>" . $error->getMessage();
}
?>

</div>
      
</div>
  </div><br>





  <?php require_once dirname( __FILE__ ) . '/' . '../../common/footer.php'; ?></div>
</body>
</html>

