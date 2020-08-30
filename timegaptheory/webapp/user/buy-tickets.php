<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once dirname( __FILE__ ) . '/' . '../../common/common.php';
require_once dirname( __FILE__ ) . '/' . '../../common/session.php';
require_once dirname( __FILE__ ) . '/' . '../../settings/delay.php'; 

  if(!isset($_SESSION['login_user'])){
     header("location:../login.php");
     die();
  }

  

  $user_check = $_SESSION['login_user'];
  try {
      $connection = new PDO($dsn, $username, $password, $options);
      $sql = "SELECT count FROM tickets WHERE email = :email;";
      $statement = $connection->prepare($sql);
      $statement->bindParam(':email', $user_check, PDO::PARAM_STR);
      $statement->execute();
      $result = $statement->fetchAll();
      } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
      }

    if ($statement->rowCount() > 0){
      $currentbooking = $statement->rowCount();
      echo "<center><span class=\"tag is-success\">You have " . $currentbooking . " ticket(s)</span></center>";

  }else{
    echo "<center><span class=\"tag is-warning\">You have no tickets</span></center>";
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $number = 0;

      try  {
        $connection = new PDO($dsn, $username, $password, $options);
        $sql4 = "SELECT *
                FROM tickets";
        $statement4 = $connection->prepare($sql4);
        $statement4->execute();
        $result4 = $statement4->fetchAll();
        $number = count($result4);
      } catch(PDOException $error) {
          #echo $sql4 . "<br>" . $error->getMessrewards();
      }

    if ($number < 1){
      sleep($config['wait']);
        $new_ticket = array(
          "email" => $user_check,
          "count" => 1
        );

        $sql3 = sprintf(
          "INSERT INTO %s (%s) values (%s)",
          "tickets",
          implode(", ", array_keys($new_ticket)),
          ":" . implode(", :", array_keys($new_ticket))
        );

        $statement3 = $connection->prepare($sql3);

        $statement3->execute($new_ticket);

    }
}


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Buy Tickets</title>
  <link rel="icon" type="image/png" href="../../common/webapp.png">
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
            <a class="button is-danger" href="../admin/">
              Admin
            </a>
          <a class="button is-warning" href="../sign-up.php">
            Sign Up
          </a>
          <a class="button is-primary" href="logout.php">
            Logout
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>
  </div></div>

  <div class="columns">
      <div class="column is-two-fifths">
      <nav class="breadcrumb" aria-label="breadcrumbs">
              <ul>
                <li><a href="../../">OWASP TimeGap Theory</a></li>
                <li><a href="../">WebApp</a></li>
                <li><a href="index.php">User</a></li>
                <li class="is-active"><a href="#" aria-current="page">Buy Tickets</a></li>
              </ul>
            </nav>
            <img src="../../common/man-looking-at-postcards-6100.jpg" />
            <span style="font-size:0.7em;color:grey;"><a href="https://www.pexels.com/photo/man-looking-at-postcards-6100/">Photo by Kaboompics .com from Pexels</a></span>
            <br><br>
<form method="post">
<input class="button button is-primary" type="submit" value="Buy One Ticket">
</form>
</div>
      
      </div><br>
    
    
    
<?php require_once dirname( __FILE__ ) . '/' . '../../common/footer.php'; ?>
    
    
      </div>
    </body>
    </html>
