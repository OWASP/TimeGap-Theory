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
  if (empty($_SESSION['token'])) {
  $_SESSION['token'] = bin2hex(random_bytes(32));
  }


  $user_check = $_SESSION['login_user'];
  



  if (isset($_POST['token'])) {
    if (hash_equals($_SESSION['token'], $_POST['token'])) {
    $number = 0;

      try  {
        $connection = new PDO($dsn, $username, $password, $options);
        $sql4 = "SELECT id
                FROM ratings WHERE email = :email;";
        $statement4 = $connection->prepare($sql4);
        $statement4->bindParam(':email', $user_check, PDO::PARAM_STR);
        $statement4->execute();
        $result4 = $statement4->fetchAll();
        $number = count($result4);
      } catch(PDOException $error) {
          echo $sql4 . "<br>" . $error->getMessage();
      }

    if ($number < 1){
      sleep($config['wait']);
        $new_ticket = array(
          "email" => $user_check
        );

        $sql3 = sprintf(
          "INSERT INTO %s (%s) values (%s)",
          "ratings",
          implode(", ", array_keys($new_ticket)),
          ":" . implode(", :", array_keys($new_ticket))
        );

        $statement3 = $connection->prepare($sql3);

        $statement3->execute($new_ticket);

    }else if ($number ==1){
      sleep($config['wait']);

        $sql4 = "DELETE FROM ratings WHERE email = :email";

        $statement4 = $connection->prepare($sql4);
        $statement4->bindValue(':email', $user_check, PDO::PARAM_STR);
        $statement4->execute();

    }
}

  }
  
  
    try {
      $connection = new PDO($dsn, $username, $password, $options);
      $sql = "SELECT id FROM ratings WHERE email = :email;";
      $statement = $connection->prepare($sql);
      $statement->bindParam(':email', $user_check, PDO::PARAM_STR);
      $statement->execute();
      $result = $statement->fetchAll();
      } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
      }

    if ($statement->rowCount() > 0){
      $currentbooking = $statement->rowCount();
      echo "<center><span class=\"tag is-success\">You have " . $currentbooking . " ratings(s)</span></center>";

  }else if ($statement->rowCount() == 0){
    echo "<center><span class=\"tag is-warning\">You have no ratings</span></center>";
  }
  


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Rate the program</title>
  <link rel="icon" type="image/png" href="../../common/webapp.png">
  <link rel="stylesheet" href="../../common/bulma.css" id="light" title="Light">
  <link rel="stylesheet" href="../../common/bulmadark.css"  id="dark"  title="Dark" disabled>
  <meta http-equiv="expires" content="Sun, 01 Jan 2014 00:00:00 GMT"/>
<meta http-equiv="pragma" content="no-cache" />
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
        Rate the program
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
                <li class="is-active"><a href="#" aria-current="page">Rate the program</a></li>
              </ul>
            </nav>
            <img src="../../common/heart-shaped-red-neon-signage-887349.jpg" />
            <span style="font-size:0.7em;color:grey;"><a href="https://www.pexels.com/photo/heart-shaped-red-neon-signage-887349/">Photo by Designecologist from Pexels</a></span>
            <br><br>
<form method="post">
<input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
<input class="button button is-danger" type="submit" name="submit" value="Love">
</form>
</div>
      
      </div><br>
    
    
    
<?php require_once dirname( __FILE__ ) . '/' . '../../common/footer.php'; ?>
    
    
      </div>
    </body>
    </html>
