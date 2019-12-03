<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once dirname( __FILE__ ) . '/' . '../common/common.php';
require_once dirname( __FILE__ ) . '/' . '../common/timegaptheorydatabase.php';
if (isset($_POST['clear'])) {
  global $host;
  global $username;
  global $password;
  global $options;
  global $dbname;
  global $dsn;

  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "DROP TABLE IF EXISTS score;
			DROP TABLE IF EXISTS mars;
			CREATE TABLE IF NOT EXISTS `score`( `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, `signup` tinyint(1) NOT NULL, `login` tinyint(1) NOT NULL, `transfer` tinyint(1) NOT NULL , `mars` tinyint(1) NOT NULL , `ticket` tinyint(1) NOT NULL, `coupon` tinyint(1) NOT NULL, `ratings` tinyint(1) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci MAX_ROWS=1;
			INSERT INTO `score` (`signup`, `login`, `transfer`, `mars`, `ticket`, `coupon`, `ratings`) VALUES (0, 0, 0, 0, 0, 0, 0) WHERE `id`=1;
			CREATE TABLE IF NOT EXISTS `mars`( `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, `eligible` int(11) NOT NULL, `rewarded` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci MAX_ROWS=1; INSERT INTO `mars` (`eligible`, `rewarded`) VALUES(0, 0) WHERE `id`=1;;";
    $connection->exec($sql);
	header("Refresh:0");
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

}

if (isset($_GET)) {
global $score;
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
  $sql = "SELECT * FROM score WHERE `id`=1;";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $result = $statement->fetchAll();
  global $score;
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

  echo "here we are";
}

}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Score</title>
  <link rel="icon" type="image/png" href="../common/lab.png">
  <link rel="stylesheet" href="../common/bulma.css" id="light" title="Light">
  <link rel="stylesheet" href="../common/bulmadark.css"  id="dark"  title="Dark" disabled>
</head>
<body>
  <div class="container">
  <div class="columns">
  <div class="column">
    <nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="../"><img src="../common/owasp.png" height="28" width="28"></a>
    <a class="navbar-item" href="../"><img src="../common/timegaptheory.png" height="28" width="28"></a>
    <a class="navbar-item" href=""><img src="../common/lab.png" height="28px" width="28px"></a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item" href="">
        Score | OWASP TimeGap Theory Labs
      </a>
    </div>
    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-primary" href="../webapp/">
            Webapp
          </a>
          <a class="button is-warning" href="../settings/">
            Settings
          </a>
          <a class="button is-info" href="../score/">
              Score
            </a>
        </div>
      </div>
    </div>
  </div>
</nav>
  </div></div>

  <div class="columns">
      <div class="column"><nav class="breadcrumb" aria-label="breadcrumbs">
              <ul>
                <li><a href="../">OWASP TimeGap Theory</a></li>
                <li class="is-active"><a href="#" aria-current="page">Score</a></li>
              </ul>
            </nav>
          <div class="content">
            <div>
              <?php 
                $totalpoints = 0;
                $totalpoints = $totalpoints + ($score['create'] ? 100 : 0);
                $totalpoints = $totalpoints + ($score['login'] ? 100 : 0);
                $totalpoints = $totalpoints + ($score['transfer'] ? 300 : 0);
                $totalpoints = $totalpoints + ($score['mars'] ? 200 : 0);
                $totalpoints = $totalpoints + ($score['ticket'] ? 100 : 0);
                $totalpoints = $totalpoints + ($score['coupon'] ? 100 : 0);
                $totalpoints = $totalpoints + ($score['ratings'] ? 100 : 0);
                echo "You have earned " . escape($totalpoints) . " out of 1000.<br><br>";
              ?>
</div>
          <table class="table">
  <thead>
    <tr> 
      <th>Number</th>
      <th>Title</th>
      <th>Challenge</th>
      <th>Points</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <tr>     
      <td>01</td>
      <td>Sign Up</td>
      <td>Create two users with the same email address</td>
      <td>+ 100</td>
      <td><?php echo ($score['create'] ? '<span style="color:green;">Completed</span>' : '<span style="color:gray;">To be completed</span>'); ?></td>
    </tr>
    <tr>     
      <td>02</td>
      <td>Login</td>
      <td>Bruteforce login page</td>
      <td>+ 100</td>
      <td><?php echo ($score['login'] ? '<span style="color:green;">Completed</span>' : '<span style="color:gray;">To be completed</span>'); ?></td>
    </tr>
    <tr>     
      <td>03</td>
      <td>Transfer</td>
      <td>Transfer more rewards than what you have</td>
      <td>+ 300</td>
      <td><?php echo ($score['transfer'] ? '<span style="color:green;">Completed</span>' : '<span style="color:gray;">To be completed</span>'); ?></td>
    </tr>
    <tr>     
      <td>04</td>
      <td>Mars</td>
      <td>Get tickets to Mars for two people or more while only one person is eligible</td>
      <td>+ 200</td>
      <td><?php echo ($score['mars'] ? '<span style="color:green;">Completed</span>' : '<span style="color:gray;">To be completed</span>'); ?></td>
    </tr>
    <tr>     
      <td>05</td>
      <td>Tickets</td>
      <td>Get two tickets to the show</td>
      <td>+ 100</td>
      <td><?php echo ($score['ticket'] ? '<span style="color:green;">Completed</span>' : '<span style="color:gray;">To be completed</span>'); ?></td>
    </tr>
    <tr>     
      <td>06</td>
      <td>Coupon</td>
      <td>Use the one-time-coupon two times or more</td>
      <td>+ 100</td>
      <td><?php echo ($score['coupon'] ? '<span style="color:green;">Completed</span>' : '<span style="color:gray;">To be completed</span>'); ?></td>
    </tr>
    <tr>     
      <td>07</td>
      <td>Ratings</td>
      <td>Increase the love count from just one user acocunt</td>
      <td>+ 100</td>
      <td><?php echo ($score['ratings'] ? '<span style="color:green;">Completed</span>' : '<span style="color:gray;">To be completed</span>'); ?></td>
    </tr>
  </tbody>
</table>

<form method="post">
  <input class="button is-danger" type="submit" name="clear" value="Clear">

</form>
              
            </div>
      </div>

    </div>
      
  </div><br>





  <?php require_once dirname( __FILE__ ) . '/' . '../common/footer.php'; ?></div></div></div>
</body>
</html>
